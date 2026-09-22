<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $users = User::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('users.index', compact('users', 'search'));
    }

    public function create()
    {
        abort_unless(Gate::allows('manage-users'), 403);

        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        abort_unless(Gate::allows('manage-users'), 403);

        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        $currentUser = auth()->user();
        abort_unless($currentUser?->isPengurus() || ($currentUser && $user->is($currentUser)), 403);

        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        abort_unless(Gate::allows('manage-users'), 403);

        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        abort_unless(Gate::allows('manage-users'), 403);

        $data = $request->validated();
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        abort_unless(Gate::allows('manage-users'), 403);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
