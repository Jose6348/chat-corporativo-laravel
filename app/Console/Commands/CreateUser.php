<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create 
                            {--name= : Nome do usuário}
                            {--email= : Email do usuário}
                            {--password= : Senha do usuário}
                            {--level=4 : Nível de acesso (1=Admin, 2=Diretoria, 3=Gerência, 4=Colaborador)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria um novo usuário com nível de acesso específico';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = $this->option('name') ?? $this->ask('Nome do usuário');
        $email = $this->option('email') ?? $this->ask('Email do usuário');
        $password = $this->option('password') ?? $this->secret('Senha do usuário');
        
        if ($this->option('level')) {
            $level = (int) $this->option('level');
        } else {
            $levelChoice = $this->choice(
                'Nível de acesso',
                [
                    'Nível 1 - Admin/C-Level (Acesso a todos os canais)',
                    'Nível 2 - Diretoria (Acesso a canais nível 2, 3 e 4)',
                    'Nível 3 - Gerência (Acesso a canais nível 3 e 4)',
                    'Nível 4 - Colaborador (Acesso apenas a canais nível 4)',
                ],
                3
            );
            $level = (int) substr($levelChoice, 6, 1); // Extrai o número do nível
        }

        // Validação
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'access_level' => $level,
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'access_level' => ['required', 'integer', 'in:1,2,3,4'],
        ]);

        if ($validator->fails()) {
            $this->error('Erros de validação:');
            foreach ($validator->errors()->all() as $error) {
                $this->error("  - {$error}");
            }
            return Command::FAILURE;
        }

        // Criar usuário
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'access_level' => $level,
            'email_verified_at' => now(),
        ]);

        $levelNames = [
            1 => 'Admin/C-Level',
            2 => 'Diretoria',
            3 => 'Gerência',
            4 => 'Colaborador',
        ];

        $this->info("✅ Usuário criado com sucesso!");
        $this->table(
            ['Campo', 'Valor'],
            [
                ['ID', $user->id],
                ['Nome', $user->name],
                ['Email', $user->email],
                ['Nível de Acesso', "Nível {$level} - {$levelNames[$level]}"],
            ]
        );

        return Command::SUCCESS;
    }
}
