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
        .news-table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        .news-table th, .news-table td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; vertical-align: top; }
        .news-table th { background: #ecf0f1; font-weight: bold; }
        .news-preview { width: 120px; height: 80px; object-fit: cover; border-radius: 4px; display: block; }
        .news-preview:hover { opacity: 0.85; }
        .news-summary { color: #666; font-size: 14px; margin-top: 6px; }
        .news-full { width: 100%; max-width: 900px; height: auto; border-radius: 6px; }
        .signin-form .form-row { margin-bottom: 14px; }
        .signin-form label { display: block; margin-bottom: 4px; font-weight: bold; }
        .signin-form input { width: 100%; padding: 8px 10px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; }
        .btn-primary { background: #2c3e50; color: #fff; border: none; padding: 10px 18px; font-size: 14px; border-radius: 4px; cursor: pointer; }
        .btn-primary:hover { background: #34495e; }
        .form-errors { background: #ffeaea; border: 1px solid #e57373; padding: 12px 16px; border-radius: 4px; margin-bottom: 16px; color: #b71c1c; }
        .form-errors ul { margin-top: 8px; padding-left: 20px; }
        .articles-list { display: flex; flex-direction: column; gap: 16px; margin-top: 16px; }
        .article-card { background: #fff; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,.1); display: flex; overflow: hidden; }
        .article-card__img { width: 200px; height: 140px; object-fit: cover; flex-shrink: 0; }
        .article-card__body { padding: 16px 20px; }
        .article-card__title { font-size: 18px; margin-bottom: 4px; }
        .article-card__meta { color: #888; font-size: 13px; margin-bottom: 8px; }
        .article-card__excerpt { color: #444; font-size: 14px; margin-bottom: 10px; }
        .article-card__actions { display: flex; gap: 14px; align-items: center; font-size: 14px; }
        .article-card__actions a { color: #2c3e50; text-decoration: none; }
        .article-card__actions a:hover { text-decoration: underline; }
        .articles-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
        .inline-form { display: inline; margin: 0; }
        .link-danger { background: none; border: none; color: #c0392b; cursor: pointer; padding: 0; font-size: 14px; font-family: inherit; }
        .link-danger:hover { text-decoration: underline; }
        .flash-success { background: #e8f5e9; border: 1px solid #81c784; color: #2e7d32; padding: 10px 14px; border-radius: 4px; margin-bottom: 14px; }
        .pagination { display: flex; gap: 4px; margin-top: 20px; flex-wrap: wrap; }
        .pagination a, .pagination span { padding: 6px 12px; border: 1px solid #ccc; border-radius: 4px; text-decoration: none; color: #2c3e50; background: #fff; font-size: 14px; }
        .pagination a:hover { background: #ecf0f1; }
        .pagination .active { background: #2c3e50; color: #fff; border-color: #2c3e50; }
        .pagination .disabled { color: #aaa; background: #f5f5f5; }
        .article-full { background: #fff; padding: 24px 28px; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,.1); }
        .article-full__img { width: 100%; max-height: 360px; object-fit: cover; border-radius: 6px; margin-bottom: 16px; }
        .article-full__excerpt { color: #555; margin: 10px 0 16px; }
        .article-full__body p { margin-bottom: 12px; }
        textarea { width: 100%; padding: 8px 10px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; font-family: inherit; }
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
                    <li><a href="{{ route('articles.index') }}">Новости</a></li>
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
