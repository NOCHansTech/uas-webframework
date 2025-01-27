<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsermanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->input('q');
        if ($search) {
            $users = User::where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('username', 'like', '%' . $search . '%')
                ->paginate(20);
        } else {
            $users = User::paginate(20);
        }
        return view('admin.userman.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create($validatedData + [
            'role' => 'user',
            'password' => bcrypt($validatedData['password'])
        ]);

        return redirect()->route('userman.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $passwordReset = $user->username . '-reset-' . date('d-m');
        return view('admin.userman.show', compact('user', 'passwordReset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $passwordReset = $user->username . '-reset-' . date('d-m');
        $user->password = bcrypt($passwordReset);
        $user->save();
        return redirect()->back()->with('success', 'Password reset successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('userman.index')->with('success', 'User deleted successfully!');
    }
}
