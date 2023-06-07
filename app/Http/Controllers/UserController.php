<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): View //index mostra a lista de entidades (customers)
    {
        $allUsers = User::all(); //isto faz select * from tabela
        //dump($allUsers);
        debug($allUsers);
        Log::debug('Users has been loaded on the controller.', ['$allUsers' => $allUsers]);
        return view('users.index')->with('users', $allUsers);
    }

    public function create(): View
    {
        // return view('users.create');
        $newUser = new User();
        return view('users.create')->withUser($newUser);
    }

    public function store(Request $request): RedirectResponse
    {
        User::create($request->all());
        // return redirect('/users');
        return redirect()->route('users.index');
    }

    public function edit(User $user): View
    {
        return view('users.edit')->withUser($user);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $user->update($request->all());
        // return redirect('/users');
        return redirect()->route('users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.index');
    }

    public function show(User $user): View
    {
        return view('users.show')->withUser($user);
    }
}
