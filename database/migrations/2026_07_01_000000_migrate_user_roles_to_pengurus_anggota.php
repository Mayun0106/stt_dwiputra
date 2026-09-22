<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::transaction(function () {
            if (Schema::getConnection()->getDriverName() === 'sqlite') {
                DB::statement(<<<'SQL'
CREATE TABLE users_new (
    id integer primary key autoincrement not null,
    name varchar not null,
    email varchar not null,
    email_verified_at datetime,
    password varchar not null,
    remember_token varchar,
    created_at datetime,
    updated_at datetime,
    role varchar not null default 'anggota' check (role in ('pengurus', 'anggota')),
    avatar varchar,
    username varchar,
    UNIQUE(email),
    UNIQUE(username)
);
SQL
                );

                DB::statement("INSERT INTO users_new SELECT id, name, email, email_verified_at, password, remember_token, created_at, updated_at, CASE role WHEN 'admin' THEN 'pengurus' WHEN 'user' THEN 'anggota' ELSE 'anggota' END AS role, avatar, username FROM users;");
                DB::statement('DROP TABLE users;');
                DB::statement('ALTER TABLE users_new RENAME TO users;');
            } else {
                DB::table('users')->where('role', 'admin')->update(['role' => 'pengurus']);
                DB::table('users')->where('role', 'user')->update(['role' => 'anggota']);
                DB::table('users')->whereNull('role')->update(['role' => 'anggota']);

                Schema::table('users', function (Blueprint $table) {
                    $table->enum('role', ['pengurus', 'anggota'])->default('anggota')->change();
                });
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::transaction(function () {
            DB::table('users')->where('role', 'pengurus')->update(['role' => 'admin']);
            DB::table('users')->where('role', 'anggota')->update(['role' => 'user']);

            if (Schema::getConnection()->getDriverName() === 'sqlite') {
                DB::statement(<<<'SQL'
CREATE TABLE users_old (
    id integer primary key autoincrement not null,
    name varchar not null,
    email varchar not null,
    email_verified_at datetime,
    password varchar not null,
    remember_token varchar,
    created_at datetime,
    updated_at datetime,
    role varchar not null default 'user' check (role in ('admin', 'user')),
    avatar varchar,
    username varchar,
    UNIQUE(email),
    UNIQUE(username)
);
SQL
                );

                DB::statement('INSERT INTO users_old SELECT id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role, avatar, username FROM users;');
                DB::statement('DROP TABLE users;');
                DB::statement('ALTER TABLE users_old RENAME TO users;');
            } else {
                Schema::table('users', function (Blueprint $table) {
                    $table->enum('role', ['admin', 'user'])->default('user')->change();
                });
            }
        });
    }
};
