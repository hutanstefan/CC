<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Număr + Știri</title>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h1>Generează un număr aleatoriu</h1>

<form id="random-number-form">
    <label for="min">Min:</label>
    <input type="number" id="min" name="min" value="1" required>

    <label for="max">Max:</label>
    <input type="number" id="max" name="max" value="100" required>

    <button type="submit" style="padding: 10px 20px; font-size: 16px;">Generează</button>
</form>

<p id="random-number" style="font-size: 24px; font-weight: bold; margin-top: 20px;"></p>

<hr style="margin: 40px 0;">

<h1>Vezi ultimele știri</h1>

<form id="news-form">
    <label for="query">Caută știri despre:</label>
    <input type="text" id="query" name="query" value="tehnologie" required>

    <button type="submit" style="padding: 10px 20px; font-size: 16px;">Caută</button>
</form>

<ul id="news-list" style="margin-top: 20px; font-size: 18px;"></ul>

<hr style="margin: 40px 0;">
<h1>Testează Node.js API (Iteme)</h1>

<div style="margin-bottom: 20px;">
    <button id="get-all">GET /items</button>
    <br><br>

    <input type="text" id="get-id" placeholder="ID item">
    <button id="get-one">GET /item/:id</button>
    <br><br>

    <input type="text" id="post-name" placeholder="Nume nou">
    <button id="post-item">POST /item</button>
    <br><br>

    <input type="text" id="put-id" placeholder="ID item">
    <input type="text" id="put-name" placeholder="Nume nou">
    <button id="put-item">PUT /item/:id</button>
    <br><br>

    <input type="text" id="delete-id" placeholder="ID item">
    <button id="delete-item">DELETE /item/:id</button>
</div>

<pre id="api-response" style="background:#f5f5f5; padding:15px; font-family:monospace;"></pre>

<script>
    // Generare număr aleatoriu
    $(document).ready(function () {
        $('#random-number-form').submit(function (event) {
            event.preventDefault();

            let min = $('#min').val();
            let max = $('#max').val();

            if (parseInt(min) >= parseInt(max)) {
                $('#random-number').text("Eroare: Min trebuie să fie mai mic decât Max!");
                return;
            }

            $.ajax({
                url: '/get-random-number',
                type: 'GET',
                data: { min: min, max: max },
                success: function (response) {
                    if (response.randomNumber !== undefined) {
                        $('#random-number').text("Număr generat: " + response.randomNumber);
                    } else {
                        $('#random-number').text("Eroare: " + response.error);
                    }
                },
                error: function (xhr) {
                    $('#random-number').text("Eroare la request: " + xhr.responseJSON.error);
                }
            });
        });

        // Căutare știri
        $('#news-form').submit(function (event) {
            event.preventDefault();

            const query = $('#query').val();

            $.ajax({
                url: '/get-news',
                type: 'GET',
                data: { query: query },
                success: function (response) {
                    const list = $('#news-list');
                    list.empty();

                    if (response.articles && response.articles.length > 0) {
                        response.articles.forEach(article => {
                            list.append(`<li><a href="${article.url}" target="_blank">${article.title}</a></li>`);
                        });
                    } else {
                        list.append("<li>Nicio știre găsită.</li>");
                    }
                },
                error: function (xhr) {
                    $('#news-list').html(`<li>Eroare: ${xhr.responseJSON?.error ?? 'A apărut o problemă.'}</li>`);
                }
            });
        });
    });
</script>

<script>
    const apiBase = 'http://localhost:3000';

    function showResponse(data) {
        console.log(data);
        $('#api-response').text(JSON.stringify(data, null, 2));
    }

    $(document).ready(function () {
        $('#get-all').click(function () {
            $.get(`${apiBase}/items`, showResponse);
        });

        $('#get-one').click(function () {
            const id = $('#get-id').val();
            if (!id) return alert("Introdu un ID!");
            $.get(`${apiBase}/item/${id}`, showResponse).fail(err => {
                showResponse(err.responseJSON);
            });
        });

        $('#post-item').click(function () {
            const name = $('#post-name').val();
            if (!name) return alert("Introdu un nume!");
            $.ajax({
                url: `${apiBase}/item`,
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ name }),
                success: showResponse,
                error: (xhr) => showResponse(xhr.responseJSON)
            });
        });

        $('#put-item').click(function () {
            const id = $('#put-id').val();
            const name = $('#put-name').val();
            if (!id || !name) return alert("Completează ID și nume!");
            $.ajax({
                url: `${apiBase}/item/${id}`,
                type: 'PUT',
                contentType: 'application/json',
                data: JSON.stringify({ name }),
                success: showResponse,
                error: (xhr) => showResponse(xhr.responseJSON)
            });
        });

        $('#delete-item').click(function () {
            const id = $('#delete-id').val();
            if (!id) return alert("Introdu un ID!");
            $.ajax({
                url: `${apiBase}/item/${id}`,
                type: 'DELETE',
                success: showResponse,
                error: (xhr) => showResponse(xhr.responseJSON)
            });
        });
    });
</script>

</body>
</html>
