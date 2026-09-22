<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Auth;

$user = new User(['name' => 'x', 'email' => 'x@example.com', 'password' => bcrypt('password'), 'role' => 'anggota']);
$user->save();
Auth::login($user);
var_dump(Auth::check());
var_dump(Auth::id());
