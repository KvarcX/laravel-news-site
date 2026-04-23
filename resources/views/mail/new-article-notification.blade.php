<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Новая новость</title>
</head>
<body style="font-family: Arial, sans-serif; color: #222; background: #f5f5f5; padding: 20px;">
    <div style="max-width: 640px; margin: 0 auto; background: #fff; padding: 24px 28px; border-radius: 6px; box-shadow: 0 1px 4px rgba(0,0,0,.08);">
        <h2 style="color: #2c3e50; margin: 0 0 16px;">На сайте опубликована новая новость</h2>

        <p style="font-size: 18px; font-weight: bold; margin: 0 0 6px;">
            {{ $article->title }}
        </p>
        <p style="color: #888; font-size: 13px; margin: 0 0 16px;">
            Опубликовано {{ $article->created_at->format('d.m.Y H:i') }}
        </p>

        <p style="margin: 0 0 18px;">{{ $article->excerpt }}</p>

        <p style="margin: 0 0 22px;">
            <a href="{{ route('articles.show', $article) }}"
               style="display: inline-block; background: #2c3e50; color: #fff;
                      padding: 10px 18px; border-radius: 4px; text-decoration: none;">
                Читать на сайте
            </a>
        </p>

        <hr style="border: none; border-top: 1px solid #eee; margin: 18px 0;">
        <p style="color: #999; font-size: 12px; margin: 0;">
            Это автоматическое уведомление с новостного сайта «Laravel News».<br>
            Вы получаете его как модератор сайта. Если это было ошибкой — сообщите администратору.
        </p>
    </div>
</body>
</html>
