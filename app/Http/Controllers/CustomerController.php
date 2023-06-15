<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use App\Models\TshirtImage;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        //$customers = Customer::all();
        $filterByName = $request->name ?? '';
        $customerQuery = Customer::query();
        if ($filterByName !== '') {
            $userIds = User::where('name', 'like', "%$filterByName%")->pluck('id');
            $customerQuery->whereIntegerInRaw('id', $userIds);
        }
        // ATENÇÃO: Comparar estas 2 alternativas com Laravel Telescope
        //$customers = $customerQuery->paginate(10);
        $customers = $customerQuery->with('orders', 'user')->paginate(10);//TODO  confirmar
        return view('customers.index', compact('customers', 'filterByName'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    public function create(): View
    {
        $customer = new Customer();
        $user = new User();
        // Garante que atribute user existe (mas não grava nada na BD)
        // É necessário, para reaproveitar os forms,
        // porque o form para edit pressupoe que user existe
        $customer->user = $user;

        return view('customers.create', compact('customer'));
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store(CustomerRequest $request): RedirectResponse
    {
        $formData = $request->validated();
        $customer = DB::transaction(function () use ($formData) {
            $newUser = new User();
            $newUser->user_type = 'C';
            $newUser->name = $formData['name'];
            $newUser->email = $formData['email'];
            //TODO admin - ver docente
            $newUser->blocked = 0;
            $newUser->password = Hash::make($formData['password_inicial']);
            $newUser->save();
            $newCustomer = new Customer();
            $newCustomer->id = $newUser->id;
            $newCustomer->nif = $formData['nif'];
            $newCustomer->address = $formData['address'];
            $newCustomer->default_payment_type = $formData['default_payment_type'] ?? null;
            $newCustomer->default_payment_ref = $formData['default_payment_ref'];
            $newCustomer->save();
            //TODO foto - ver docente
            return $newCustomer;
        });
        $url = route('customers.show', ['customer' => $customer]);
        $htmlMessage = "Cliente <a href='$url'>#{$customer->id}</a>
                        <strong>\"{$customer->user->name}\"</strong> foi criado com sucesso!";
        return redirect()->route('customers.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
            //TODO redirect ver docente
    }

    // /**
    //  * Display the specified resource.
    //  */
    public function show(Customer $customer): View
    {
        $customer->load('orders', 'user');
        return view('customers.show', compact('customer'));
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit(Customer $customer): View
    {
        return view('customers.edit', compact('customer'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(CustomerRequest $request, Customer $customer): RedirectResponse
    {
        $formData = $request->validated();
        $customer = DB::transaction(function () use ($formData, $customer) {
            $customer->nif = $formData['nif'];
            $customer->address = $formData['address'];
            $customer->default_payment_type = $formData['default_payment_type'];
            $customer->default_payment_ref = $formData['default_payment_ref'];
            $customer->save();
            $user = $customer->user;
            $user->user_type = 'C';
            $user->name = $formData['name'];
            $user->email = $formData['email'];
            //TODO admin ver docente
            $user->blocked = 0;
            $user->save();
            //TODO foto ver docente
            return $customer;
        });
        $url = route('customers.show', ['customer' => $customer]);
        $htmlMessage = "Cliente <a href='$url'>#{$customer->id}</a>
                        <strong>\"{$customer->user->name}\"</strong> foi alterado com sucesso!";
        return redirect()->route('customers.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(Customer $customer): RedirectResponse
    {
        try {
            $totalOrders = DB::scalar('select count(*) from orders where customer_id = ?', [$customer->id]);
            $user = $customer->user;
            if ($totalOrders == 0) {
                DB::transaction(function () use ($customer, $user) {
                    $customer->delete();
                    $user->delete();
                });
                //TODO foto ver docente
                $htmlMessage = "Cliente #{$customer->id}
                        <strong>\"{$user->name}\"</strong> foi apagado com sucesso!";
                return redirect()->route('customers.index')
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', 'success');
            } else {
                $url = route('customers.show', ['customer' => $customer]);
                $alertType = 'warning';
                $ordersStr = $totalOrders > 0 ?
                    ($totalOrders == 1 ?
                        "tem 1 encomenda" :
                        "tem $totalOrders encomendas") :
                    "";
                $htmlMessage = "Cliente <a href='$url'>#{$customer->id}</a>
                    <strong>\"{$user->name}\"</strong>
                    não pode ser apagado porque $ordersStr!
                    ";
            }
        } catch (\Exception $error) {
            $url = route('customers.show', ['customer' => $customer]);
            $htmlMessage = "Não foi possível apagar o cliente <a href='$url'>#{$customer->id}</a>
                        <strong>\"{$user->name}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

    //TODO destroy foto ver docente

    //TODO changeadmin ver docente
}
