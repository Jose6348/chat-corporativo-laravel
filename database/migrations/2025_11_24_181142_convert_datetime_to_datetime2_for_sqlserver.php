<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Apenas para SQL Server - converter datetime para datetime2
        if (DB::getDriverName() === 'sqlsrv') {
            // Remover constraints default se existirem e alterar colunas
            $this->alterColumnWithConstraint('users', 'created_at');
            $this->alterColumnWithConstraint('users', 'updated_at');
            $this->alterColumnWithConstraint('users', 'email_verified_at');
            $this->alterColumnWithConstraint('users', 'two_factor_expires_at');
            
            $this->alterColumnWithConstraint('channels', 'created_at');
            $this->alterColumnWithConstraint('channels', 'updated_at');
            
            $this->alterColumnWithConstraint('messages', 'created_at');
            $this->alterColumnWithConstraint('messages', 'updated_at');
            
            $this->alterColumnWithConstraint('password_reset_tokens', 'created_at');
            $this->alterColumnWithConstraint('failed_jobs', 'failed_at');
        }
    }
    
    private function alterColumnWithConstraint(string $table, string $column): void
    {
        // Buscar constraints default
        $constraints = DB::select("
            SELECT name 
            FROM sys.default_constraints 
            WHERE parent_object_id = OBJECT_ID('{$table}') 
            AND parent_column_id = COLUMNPROPERTY(OBJECT_ID('{$table}'), '{$column}', 'ColumnId')
        ");
        
        // Remover constraints
        foreach ($constraints as $constraint) {
            DB::statement("ALTER TABLE {$table} DROP CONSTRAINT {$constraint->name}");
        }
        
        // Alterar coluna
        DB::statement("ALTER TABLE {$table} ALTER COLUMN {$column} datetime2");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverter para datetime (sem microsegundos)
        if (DB::getDriverName() === 'sqlsrv') {
            DB::statement('ALTER TABLE users ALTER COLUMN created_at datetime');
            DB::statement('ALTER TABLE users ALTER COLUMN updated_at datetime');
            DB::statement('ALTER TABLE users ALTER COLUMN email_verified_at datetime');
            DB::statement('ALTER TABLE users ALTER COLUMN two_factor_expires_at datetime');
            
            DB::statement('ALTER TABLE channels ALTER COLUMN created_at datetime');
            DB::statement('ALTER TABLE channels ALTER COLUMN updated_at datetime');
            
            DB::statement('ALTER TABLE messages ALTER COLUMN created_at datetime');
            DB::statement('ALTER TABLE messages ALTER COLUMN updated_at datetime');
            
            DB::statement('ALTER TABLE password_reset_tokens ALTER COLUMN created_at datetime');
            
            DB::statement('ALTER TABLE failed_jobs ALTER COLUMN failed_at datetime');
        }
    }
};
