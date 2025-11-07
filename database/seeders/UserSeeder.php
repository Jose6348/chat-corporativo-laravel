<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Senhas padrão por nível (pode ser alterado)
        $passwords = [
            1 => 'admin123',      // Nível 1 - Admin
            2 => 'diretor123',    // Nível 2 - Diretoria
            3 => 'gerente123',    // Nível 3 - Gerência
            4 => 'colab123',      // Nível 4 - Colaborador
        ];

        // Nível 1 - Admin/C-Level
        User::firstOrCreate(
            ['email' => 'admin@chat.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make($passwords[1]),
                'access_level' => 1,
                'email_verified_at' => now(),
            ]
        );

        // Nível 2 - Diretoria
        User::firstOrCreate(
            ['email' => 'diretor@chat.com'],
            [
                'name' => 'Diretor Geral',
                'password' => Hash::make($passwords[2]),
                'access_level' => 2,
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'gestor@chat.com'],
            [
                'name' => 'Gestor de Projetos',
                'password' => Hash::make($passwords[2]),
                'access_level' => 2,
                'email_verified_at' => now(),
            ]
        );

        // Nível 3 - Gerência
        User::firstOrCreate(
            ['email' => 'gerente@chat.com'],
            [
                'name' => 'Gerente de Equipe',
                'password' => Hash::make($passwords[3]),
                'access_level' => 3,
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'supervisor@chat.com'],
            [
                'name' => 'Supervisor',
                'password' => Hash::make($passwords[3]),
                'access_level' => 3,
                'email_verified_at' => now(),
            ]
        );

        // Nível 4 - Colaborador (padrão)
        User::firstOrCreate(
            ['email' => 'colaborador1@chat.com'],
            [
                'name' => 'Colaborador 1',
                'password' => Hash::make($passwords[4]),
                'access_level' => 4,
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'colaborador2@chat.com'],
            [
                'name' => 'Colaborador 2',
                'password' => Hash::make($passwords[4]),
                'access_level' => 4,
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'colaborador3@chat.com'],
            [
                'name' => 'Colaborador 3',
                'password' => Hash::make($passwords[4]),
                'access_level' => 4,
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✅ Usuários criados com sucesso!');
        $this->command->info('');
        $this->command->info('📋 Credenciais de acesso:');
        $this->command->info('');
        $this->command->info('Nível 1 (Admin):');
        $this->command->info("  - admin@chat.com / {$passwords[1]}");
        $this->command->info('');
        $this->command->info('Nível 2 (Diretoria):');
        $this->command->info("  - diretor@chat.com / {$passwords[2]}");
        $this->command->info("  - gestor@chat.com / {$passwords[2]}");
        $this->command->info('');
        $this->command->info('Nível 3 (Gerência):');
        $this->command->info("  - gerente@chat.com / {$passwords[3]}");
        $this->command->info("  - supervisor@chat.com / {$passwords[3]}");
        $this->command->info('');
        $this->command->info('Nível 4 (Colaborador):');
        $this->command->info("  - colaborador1@chat.com / {$passwords[4]}");
        $this->command->info("  - colaborador2@chat.com / {$passwords[4]}");
        $this->command->info("  - colaborador3@chat.com / {$passwords[4]}");
        $this->command->info('');
        $this->command->warn('⚠️  IMPORTANTE: Altere essas senhas em produção!');
    }
}

