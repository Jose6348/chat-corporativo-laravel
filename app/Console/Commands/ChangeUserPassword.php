<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ChangeUserPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:password 
                            {email : Email do usuário}
                            {--password= : Nova senha (se não informado, será solicitada)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Altera a senha de um usuário existente';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $email = $this->argument('email');
        $password = $this->option('password') ?? $this->secret('Nova senha');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("❌ Usuário com email '{$email}' não encontrado!");
            return Command::FAILURE;
        }

        if (strlen($password) < 8) {
            $this->error('❌ A senha deve ter no mínimo 8 caracteres!');
            return Command::FAILURE;
        }

        $user->password = Hash::make($password);
        $user->save();

        $this->info("✅ Senha alterada com sucesso para o usuário: {$user->name} ({$user->email})");

        return Command::SUCCESS;
    }
}
