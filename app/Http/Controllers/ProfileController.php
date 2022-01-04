<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
   
    public function index()
    {
        return view('admin.profile');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

       public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => ['required','unique:users'],
            'name' => ['required'],
            'email' => ['required', 'unique:users'],
            'password' => ['required','string', 'min:8']
        ]);

        $user->update($request->all());
      dd($user);
        return redirect()->route('profile.index')
            ->with('success', 'Profile successfully updated!');
    }

    public function destroy($id)
    {
        //
    }
}
