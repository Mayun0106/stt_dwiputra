<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\User;

$currentSessionUserId = DB::table('sessions')->orderByDesc('last_activity')->value('user_id');
$user = $currentSessionUserId ? User::find($currentSessionUserId) : User::first();

if (! $user) {
    echo "No user found\n";
    exit(1);
}

echo "Using user id: {$user->id}\n";
echo "Email: {$user->email}\n";
echo "Role: " . ($user->role ?? 'NULL') . "\n";
echo "Email Verified At: " . ($user->email_verified_at ?? 'NULL') . "\n";
echo "Status: " . ($user->status ?? 'NULL') . "\n";
echo "All attributes:\n";
print_r($user->getAttributes());

$user->role = 'pengurus';
$user->email_verified_at = now();
$user->save();

echo "\nUpdated user saved.\n";
echo "New role: {$user->role}\n";
echo "New email_verified_at: {$user->email_verified_at}\n";
