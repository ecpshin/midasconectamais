<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create(['status' => 'Não Contactado']);
        Status::create(['status' => 'Não tem interesse']);
        Status::create(['status' => 'Interessado']);
        Status::create(['status' => 'Agendado']);
    }
}
