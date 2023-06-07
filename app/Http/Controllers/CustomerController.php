<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View //index mostra a lista de entidades (customers)
    {
    $allCustomers = Customer::all(); //isto faz select * from tabela
    //dump($allCustomers);
    debug($allCustomers);
    Log::debug('Customers has been loaded on the controller.', ['$allCustomers' => $allCustomers]);
    return view('customers.index')->with('customers', $allCustomers);
    }
}
