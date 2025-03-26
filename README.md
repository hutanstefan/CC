### CC - Hutan Stefan

## Homework 1

The script for this project can be found in the following location:  
`public/js/script.js`

---

## Homework 2 – Laravel + API Integration

În această temă am realizat o aplicație Laravel care combină mai multe funcționalități într-o singură pagină (`resources/views/homework2.blade.php`):

### 🔢 1. Random Number Generator (API: Random.org)
- Utilizatorul poate introduce un interval (Min, Max)
- Se generează un număr aleatoriu folosind [random.org API](https://api.random.org)
- Este folosit un controller dedicat: `RandomNumberController.php`

### 📰 2. Căutare știri (API: NewsAPI.org)
- Utilizatorul poate introduce un cuvânt cheie
- Sunt afișate cele mai noi 5 știri relevante
- API folosit: [https://newsapi.org](https://newsapi.org)
- Controller dedicat: `NewsController.php`

### 🔧 3. Conectare cu server Node.js custom (CRUD API)
- Am construit un server `Node.js` cu `http` + `fs`, fără Express
- Operații suportate:
  - `GET /items` – Afișare toate itemele
  - `GET /item/:id` – Afișare item după ID
  - `POST /item` – Adăugare item nou
  - `PUT /item/:id` – Modificare item
  - `DELETE /item/:id` – Ștergere item
- În frontend, există câte un **buton pentru fiecare acțiune**, cu inputuri dedicate
- Răspunsurile sunt afișate în format JSON (`<pre>`)

> ⚠️ A fost nevoie să adaug suport CORS în serverul Node.js pentru a permite request-uri cross-origin din Laravel (port 8000).

---

### 📁 Structură fișiere relevante

- `resources/views/homework2.blade.php` – Interfața principală
- `routes/web.php` – Rutele pentru controlerele Laravel
- `app/Http/Controllers/RandomNumberController.php` – API Random.org
- `app/Http/Controllers/NewsController.php` – API NewsAPI
- `server.js` – Server Node.js custom cu logică CRUD și JSON file storage

---

### 🧪 Tehnologii folosite

- Laravel 10+
- Blade
- jQuery (pentru AJAX)
- Node.js (fără Express)
- API-uri externe: random.org, newsapi.org

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

