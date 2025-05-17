<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public function run()
    {
        $this->insertGenres();
    }

    public function insertGenres(): void
    {
        $now = now();
        $genres = [
            [1, 'Masculino'],
            [2, 'Femenino'],
            [3, 'No Binario'],
            [4, 'Otro'],
        ];
        $genres = array_map(function ($genre) use ($now) {
            return [
                'id' => $genre[0],
                'name' => $genre[1],
                'updated_at' => $now,
                'created_at' => $now,
            ];
        }, $genres);

        DB::table('genres')->insert($genres);
    }
}
