<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // COrrigir vendo pelo tshirts
        // FILTROS FAZER MAIS
        $filterByCustomerID = $request->customer_id ?? '';
        $filterByNif = $request->nif ?? '';
        $userQuery = Order::query();

        if ($filterByCustomerID !== '') {
            $customerIds = Order::where('customer_id', 'like', "%$filterByCustomerID%")->pluck('id');
            $userQuery->whereIntegerInRaw('id', $customerIds);
        }
        if ($filterByNif !== '') {
            $customerNif = Order::where('nif', 'like', "%$filterByNif%")->pluck('id');
            $userQuery->whereIntegerInRaw('id', $customerNif);
        }


        $orders = $userQuery->paginate(10);
        return view('orders.index', compact('orders', 'filterByCustomerID','filterByNif'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $order = new Order();
        return view('orders.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request): RedirectResponse
    {
        $newOrder = Order::create($request->validated());
        $url = route('orders.show', ['order' => $newOrder]);
        $htmlMessage = "Order <a href='$url'>#{$newOrder->id}</a> foi criada com sucesso!";
        return redirect()->route('orders.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): View
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order): View
    {
        return view('orders.edit', compact('order'));
            //,

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order): RedirectResponse
    {
        $order->update($request->validated());
        $url = route('orders.show', ['order' => $order]);
        $htmlMessage = "Order <a href='$url'>#{$order->id}</a> foi alterada com sucesso!";
        return redirect()->route('orders.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): RedirectResponse
    {
        try {
            $order->delete();
            $htmlMessage = "Order #{$order->id}foi apagada com sucesso!";
            $alertType = 'success';
        } catch (\Exception $error) {
            $url = route('orders.show', ['order' => $order]);
            $htmlMessage = "Não foi possível apagar a Order <a href='$url'>#{$order->id}</a> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return redirect()->route('orders.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}

