<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

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
}
