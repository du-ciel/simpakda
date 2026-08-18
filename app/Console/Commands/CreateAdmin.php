<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class CreateAdmin extends Command
{
    protected $signature = 'admin:create
                            {email : Email admin}
                            {name : Nama admin}
                            {--password= : Password (akan digenerate jika tidak diisi)}
                            {--force : Lewati konfirmasi}';

    protected $description = 'Buat user admin baru';

    public function handle(): int
    {
        $email = $this->argument('email');
        $name = $this->argument('name');

        // Validasi email format
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Format email tidak valid.');

            return Command::FAILURE;
        }

        // Cek apakah email sudah ada
        if (User::where('email', $email)->exists()) {
            $this->error("User dengan email {$email} sudah ada.");

            return Command::FAILURE;
        }

        // Password
        if ($this->option('password')) {
            $password = $this->option('password');
        } else {
            $password = $this->generatePassword();
            $this->info("Password yang digenerate: {$password}");
        }

        // Konfirmasi
        if (! $this->option('force') && ! $this->confirm("Yakin ingin membuat admin dengan email {$email}?")) {
            $this->info('Dibatalkan.');

            return Command::SUCCESS;
        }

        // Buat user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $this->info('Admin berhasil dibuat!');
        $this->info("Email: {$user->email}");
        $this->info("Nama:  {$user->name}");

        return Command::SUCCESS;
    }

    private function generatePassword(int $length = 16): string
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%';

        return substr(str_shuffle($chars), 0, $length);
    }
}
