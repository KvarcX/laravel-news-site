<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Новостной сайт')</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #222; background: #f5f5f5; }
        header { background: #2c3e50; color: #fff; padding: 16px 0; }
        header .container { display: flex; justify-content: space-between; align-items: center; }
        header .logo { font-size: 20px; font-weight: bold; }
        nav ul { list-style: none; display: flex; gap: 24px; }
        nav a { color: #fff; text-decoration: none; }
        nav a:hover { color: #f1c40f; }
        .container { max-width: 960px; margin: 0 auto; padding: 0 16px; }
        main { padding: 32px 0; min-height: calc(100vh - 160px); }
        main h1 { margin-bottom: 16px; }
        main p { margin-bottom: 12px; }
        .card { background: #fff; padding: 24px; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,.1); }
        .contacts-list { list-style: none; }
        .contacts-list li { padding: 8px 0; border-bottom: 1px solid #eee; }
        .contacts-list li:last-child { border-bottom: none; }
        footer { background: #34495e; color: #bdc3c7; padding: 16px 0; text-align: center; font-size: 14px; }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">Новостной сайт</div>
            <nav>
                <ul>
                    <li><a href="{{ route('home') }}">Главная</a></li>
                    <li><a href="{{ route('about') }}">О нас</a></li>
                    <li><a href="{{ route('contacts') }}">Контакты</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer>
        <div class="container">
            Цейгалов Андрей Владимирович, группа 243-321
        </div>
    </footer>
</body>
</html>
