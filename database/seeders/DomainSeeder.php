<?php

namespace Database\Seeders;

use App\Models\Domain;
use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
{
    public function run(): void
    {
        Domain::firstOrCreate(
            ['domain' => 'orientamujer.cl'],
            [
                'tenant_id' => 'orientamujer'
            ]
        );
    }
}
