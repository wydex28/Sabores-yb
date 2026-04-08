<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DbBackup extends Command
{
    protected $signature = 'db:backup';
    protected $description = 'Crea un respaldo de la base de datos actual en la carpeta database/backups';

    public function handle()
    {
        $databasePath = database_path('database.sqlite');
        $backupDir = database_path('backups');

        if (!File::exists($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }

        if (File::exists($databasePath)) {
            $timestamp = date('Y-m-d_H-i-s');
            $backupPath = $backupDir . DIRECTORY_SEPARATOR . "backup_{$timestamp}.sqlite";
            
            if (File::copy($databasePath, $backupPath)) {
                $this->info("Respaldo creado con éxito: backup_{$timestamp}.sqlite");
            } else {
                $this->error("Error al crear el respaldo.");
            }
        } else {
            $this->error("No se encontró el archivo database.sqlite para respaldar.");
        }
    }
}
