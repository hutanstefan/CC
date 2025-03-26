import http from 'http';
import fs from 'fs';
import url from 'url';

const DATA_FILE = 'data.json';
const message = 'Available routes are: GET /items , GET /item/:id , POST /item , PUT /item/:id , DELETE /item/:id';

function readData() {
    if (!fs.existsSync(DATA_FILE)) return [];
    return JSON.parse(fs.readFileSync(DATA_FILE, 'utf8'));
}

function writeData(data) {
    fs.writeFileSync(DATA_FILE, JSON.stringify(data, null, 2));
}

const server = http.createServer((req, res) => {

    res.setHeader('Access-Control-Allow-Origin', '*');
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    res.setHeader('Access-Control-Allow-Headers', 'Content-Type');

    // Răspunde direct la cererile OPTIONS (preflight)
    if (req.method === 'OPTIONS') {
        res.writeHead(204);
        res.end();
        return;
    }

    const parsedUrl = url.parse(req.url, true);
    const { pathname, query } = parsedUrl;
    const method = req.method;
    let data = readData();

    if (pathname === '/' && method === 'GET') {
        res.writeHead(200, {'Content-Type': 'application/json'});
        res.end(JSON.stringify({ message }));
    } else if (pathname === '/items' && method === 'GET') {
        res.writeHead(200, { 'Content-Type': 'application/json' });
        res.end(JSON.stringify(data));
    } else if (pathname.startsWith('/item/') && method === 'GET') {
        const id = pathname.split('/')[2];
        const item = data.find(i => i.id === id);
        if (item) {
            res.writeHead(200, { 'Content-Type': 'application/json' });
            res.end(JSON.stringify(item));
        } else {
            res.writeHead(404, { 'Content-Type': 'application/json' });
            res.end(JSON.stringify({ message: 'Item not found' }));
        }
    } else if (pathname === '/item' && method === 'POST') {
        let body = '';
        req.on('data', chunk => body += chunk.toString());
        req.on('end', () => {
            if (!body) {
                res.writeHead(400, { 'Content-Type': 'application/json' });
                res.end(JSON.stringify({ message: "Request body is empty. Please send valid JSON." }));
                return;
            }
            try {
                const newItem = JSON.parse(body);
                newItem.id = Date.now().toString();
                data.push(newItem);
                writeData(data);
                res.writeHead(201, { 'Content-Type': 'application/json' });
                res.end(JSON.stringify(newItem));
            } catch (error) {
                res.writeHead(400, { 'Content-Type': 'application/json' });
                res.end(JSON.stringify({ message: "Invalid JSON format." }));
            }
        });
    }
    else if (pathname.startsWith('/item/') && method === 'PUT') {
        const id = pathname.split('/')[2];
        let body = '';
        req.on('data', chunk => body += chunk.toString());
        req.on('end', () => {
            const updatedItem = JSON.parse(body);
            const index = data.findIndex(i => i.id === id);
            if (index !== -1) {
                data[index] = { ...data[index], ...updatedItem };
                writeData(data);
                res.writeHead(200, { 'Content-Type': 'application/json' });
                res.end(JSON.stringify(data[index]));
            } else {
                res.writeHead(404, { 'Content-Type': 'application/json' });
                res.end(JSON.stringify({ message: 'Item not found' }));
            }
        });
    } else if (pathname.startsWith('/item/') && method === 'DELETE') {
        const id = pathname.split('/')[2];
        const filteredData = data.filter(i => i.id !== id);
        if (filteredData.length !== data.length) {
            writeData(filteredData);
            res.writeHead(200, { 'Content-Type': 'application/json' });
            res.end(JSON.stringify({ message: 'Item deleted' }));
        } else {
            res.writeHead(404, { 'Content-Type': 'application/json' });
            res.end(JSON.stringify({ message: 'Item not found' }));
        }
    } else {
        res.writeHead(404, { 'Content-Type': 'application/json' });
        res.end(JSON.stringify({ message: 'Route not found' }));
    }
});

server.listen(3000, () => console.log('Server running on port 3000'));
