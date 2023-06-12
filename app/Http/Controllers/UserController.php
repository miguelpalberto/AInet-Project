<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserRequest;
use App\Http\Requests\CustomerRequest;



class UserController extends Controller
{
    public function index(): View //index mostra a lista de entidades (customers)
    {
        //$allUsers = User::all(); //isto faz select * from tabela
        $allUsers = User::paginate(10);
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

    public function store(UserRequest $request): RedirectResponse
    {
        $newUser = User::create($request->validated());
        //Flash Message:
        $url = route('users.show', ['user' => $newUser]);
        $htmlMessage = "User <a href='$url'>#{$newUser->id}</a> <strong>\"{$newUser->name}\"</strong> foi criado com sucesso!";
        // return redirect('/users');
        return redirect()->route('users.index')
            //Flash Message:
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function edit(User $user): View
    {
        return view('users.edit')->withUser($user);
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        //$user->update($request->all());
        // return redirect('/users');
        // $validated = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|string|max:50',
        // ]);
        $user->update($request->validated()); //$user->update($validated);//aqui valida
        //Flash Message:
        $url = route('users.show', ['user' => $user]);
        $htmlMessage = "User <a href='$url'>#{$user->id}</a> <strong>\"{$user->name}\"</strong> foi alterado com sucesso!";
        return redirect()->route('users.index') //redireta para pagina de novo
            //Flash Message:
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function destroy(User $user): RedirectResponse
    {
        // $user->delete();
        // return redirect()->route('users.index');
        try {
            $user->delete();
            $htmlMessage = "User #{$user->id} <strong>\"{$user->name}\"</strong> foi apagada com sucesso!";
            $alertType = 'success';
        } catch (\Exception $error) {
            $url = route('users.show', ['user' => $user]);
            $htmlMessage = "Não foi possível apagar o user <a href='$url'>#{$user->id}</a><strong>\"{$user->name}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return redirect()->route('users.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

    public function show(User $user): View
    {
        return view('users.show')->withUser($user);
    }
}
