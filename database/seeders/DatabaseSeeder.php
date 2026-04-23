<?php

namespace Database\Seeders;

use App\Models\Article;
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

        Article::factory()->count(30)->create();
    }
}
