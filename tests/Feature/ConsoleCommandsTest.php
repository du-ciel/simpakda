<?php

use App\Models\User;

test('admin:create command creates a new verified admin user', function () {
    $email = 'newadmin@simpakda.test';
    $name = 'New Admin';

    $this->artisan('admin:create', [
        'email' => $email,
        'name' => $name,
        '--password' => 'SecurePass123!@#',
        '--force' => true,
    ])->assertSuccessful();

    $user = User::where('email', $email)->first();
    expect($user)->not->toBeNull();
    expect($user->name)->toBe($name);
    expect($user->email_verified_at)->not->toBeNull();
});

test('admin:create command fails on invalid email or duplicate email', function () {
    $this->artisan('admin:create', [
        'email' => 'invalid-email',
        'name' => 'Invalid',
        '--force' => true,
    ])->assertFailed();

    $existing = User::factory()->create();

    $this->artisan('admin:create', [
        'email' => $existing->email,
        'name' => 'Duplicate',
        '--force' => true,
    ])->assertFailed();
});

test('db:export command exports tables to sql file', function () {
    $tempFile = storage_path('app/test_export.sql');

    $this->artisan('db:export', [
        'filename' => $tempFile,
    ])->assertSuccessful();

    expect(file_exists($tempFile))->toBeTrue();

    $content = file_get_contents($tempFile);
    expect($content)->toContain('-- Simpakda Database Export');

    @unlink($tempFile);
});

