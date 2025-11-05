<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Channel;

class ChannelSeeder extends Seeder
{
    public function run(): void
{
    // --- Canal Nível 1 (Admin/C-Level) ---
    Channel::firstOrCreate(
        ['name' => 'Canal da Diretoria (Nível 1)'], // O que procurar
        [ // O que criar se não encontrar
            'description' => 'Discussões estratégicas. Apenas Nível 1 pode ver.',
            'required_level' => 1
        ]
    );

    // --- Canal Nível 2 (Diretoria) ---
    Channel::firstOrCreate(
        ['name' => 'Canal de Gestores (Nível 2)'],
        [
            'description' => 'Coordenação de equipes. Níveis 1 e 2 podem ver.',
            'required_level' => 2
        ]
    );

    // --- Canal Nível 3 (Gerência) ---
    Channel::firstOrCreate(
        ['name' => 'Canal de Equipes (Nível 3)'],
        [
            'description' => 'Discussões de projetos. Níveis 1, 2 e 3 podem ver.',
            'required_level' => 3
        ]
    );

    // --- Canal Nível 4 (Colaborador) ---
    Channel::firstOrCreate(
        ['name' => 'Canal Geral (Nível 4)'],
        [
            'description' => 'Avisos e comunicados gerais. Todos podem ver.',
            'required_level' => 4
        ]
    );
}
}
