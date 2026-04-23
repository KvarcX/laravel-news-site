<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $moderator = Role::create(['name' => Role::MODERATOR, 'title' => 'Модератор']);
        $reader    = Role::create(['name' => Role::READER,    'title' => 'Читатель']);

        User::create([
            'name'     => 'Модератор Иванов',
            'email'    => 'moderator@example.com',
            'password' => Hash::make('password'),
            'role_id'  => $moderator->id,
        ]);

        User::create([
            'name'     => 'Читатель Петров',
            'email'    => 'reader@example.com',
            'password' => Hash::make('password'),
            'role_id'  => $reader->id,
        ]);

        $articles = Article::factory()->count(30)->create();

        $readerId = User::where('email', 'reader@example.com')->value('id');
        $modId    = User::where('email', 'moderator@example.com')->value('id');

        $bodies = [
            'Интересная новость, спасибо!',
            'Хороший материал, добавьте ещё подробностей.',
            'Не согласен с выводами, но за статью спасибо.',
            'Очень полезно, жду продолжения.',
            'А можно ссылку на источник?',
            'Слишком коротко, хотелось бы больше деталей.',
        ];

        foreach ($articles->random(6) as $i => $article) {
            Comment::create([
                'article_id'  => $article->id,
                'user_id'     => $readerId,
                'body'        => $bodies[$i],
                'is_approved' => $i < 2,
            ]);
        }

        Comment::create([
            'article_id'  => $articles->first()->id,
            'user_id'     => $modId,
            'body'        => 'Комментарий от имени модератора — виден сразу.',
            'is_approved' => true,
        ]);
    }
}
