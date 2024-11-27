<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(25);
        return view('user/users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user/user_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users', 'email'],
            'user_type' => ['required'],
            'password' => ['required', 'min:8', 'confirmed']
        ], [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'user_type.required' => 'User type is required.',
            'email.required' => 'E-mail is required.',
            'email.email' => 'E-mail is invalid.',
            'email.unique' => 'E-mail is already taken.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must have a minimum of :min characters!',
            'password.confirmed' => 'Passwords do not match.'
        ]);

        $created = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'user_type' => $request->input('user_type'),
            'email' => $request->input('email'),
            'password' => password_hash($request->input('password'), PASSWORD_DEFAULT),
        ]);

        if ($created) {
            return redirect()->route('users.index')->with('success', 'Succesfully created!');
        }

        return redirect()->route('users.index')->with('error', 'Failed to create!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user/user_show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user/user_edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users', 'email'],
            'user_type' => ['required'],
        ], [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'user_type.required' => 'User type is required.',
            'email.required' => 'E-mail is required.',
            'email.email' => 'E-mail is invalid.',
            'email.unique' => 'E-mail is already taken.',
        ]);

        $data = $request->except(['_token', '_method']);

        $updated = User::where('id', $id)->update($data);

        if ($updated) {
            return redirect()->route('users.index')->with('success', 'Succesfully updated!');
        }

        return redirect()->route('users.index')->with('error', 'Failed to update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted!');
    }
}
