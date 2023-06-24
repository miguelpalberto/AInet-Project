<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\OrderEditRequest;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class, 'order');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        $this->authorize('userActive');//auth
        //$this->authorize('viewAny', OrderController::class);//auth

        // COrrigir vendo pelo tshirts
        // FILTROS FAZER MAIS
        $filterByCustomerID = $request->customer_id ?? '';
        $filterByNif = $request->nif ?? '';
        $filterByStatus = $request->status ?? '';
        $filterByDate = $request->date ?? '';
        $orderQuery = Order::query();

        if ($filterByCustomerID !== '') {
            $customerIds = Order::where('customer_id', 'like', "%$filterByCustomerID%")->pluck('id');
            $orderQuery->whereIntegerInRaw('id', $customerIds);
        }
        if ($filterByNif !== '') {
            $customerNif = Order::where('nif', 'like', "%$filterByNif%")->pluck('id');
            $orderQuery->whereIntegerInRaw('id', $customerNif);
        }
        if ($filterByStatus !== '') {
            $orderQuery->where('status', $filterByStatus);
        }
        if ($filterByDate !== '') {
            $orderQuery->where('date', $filterByDate);
        }



        $orders = $orderQuery->paginate(10);
        return view('orders.index', compact('orders', 'filterByCustomerID','filterByNif', 'filterByStatus','filterByDate'));

    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create(): View

    //$this->authorize('create');//auth
    // {
    //     $order = new Order();
    //     return view('orders.create', compact('order'));
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(OrderRequest $request): RedirectResponse
    // {
        // $this->authorize('create');//auth

    //     $newOrder = Order::create($request->validated());
    //     $newOrder->status = 'pending';
    //     $url = route('orders.show', ['order' => $newOrder]);
    //     $htmlMessage = "Order <a href='$url'>#{$newOrder->id}</a> foi criada com sucesso!";
    //     return redirect()->route('orders.index')
    //         ->with('alert-msg', $htmlMessage)
    //         ->with('alert-type', 'success');
    // }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): View
    {
        //$this->authorize('view');//auth

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order): View
    {

        $this->authorize('userActive');//auth
        //$this->authorize('update');//auth


        return view('orders.edit', compact('order'));
        //,

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderEditRequest $request, Order $order): RedirectResponse
    {
        $this->authorize('userActive');//auth
        //$this->authorize('update');//auth


        $order->update($request->validated());
        $url = route('orders.show', ['order' => $order]);
        $htmlMessage = "Order <a href='$url'>#{$order->id}</a> foi alterada com sucesso!";
        return redirect()->route('orders.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function minhasOrders(Request $request): View
    {
        $this->authorize('userActive');//auth
        $this->authorize('minhasOrders', Order::class);//auth

        $user = Auth::user();

        $orderQuery = Order::query();

        $orders = $orderQuery->where('customer_id', '=', $user->id)->orderBy('orders.date', 'DESC')->paginate(10);

        return view('orders.minhas', compact('orders'));
    }


    public function minhasOrdersFuncionario(Request $request): View

{
    $this->authorize('userActive');//auth
    $this->authorize('minhasOrdersFuncionario', Order::class);//auth
    $user = Auth::user();


        if ($user->user_type === 'E') {
            $orderQuery = Order::query();

            $orders = $orderQuery->whereIn('status', ['pending', 'paid'])
                ->orderBy('date', 'DESC')
                ->paginate(10);

            return view('orders.minhasFunc', compact('orders'));
        }

        // Caso o usuário atual não seja um funcionário, retorne uma resposta adequada
        abort(403, 'Acesso não autorizado.');
    }

    public function markAsPaid(Order $order): RedirectResponse
    {
        $this->authorize('markAsPaid', $order);
        $this->authorize('markAsPaid', Order::class);//auth

        if ($order->status === 'pending') {
            $order->status = 'paid';
            $order->save();


            return redirect()->route('orders.minhasFunc')
                ->with('success', 'Encomenda marcada como paga com sucesso.');
        }

        return redirect()->route('orders.minhasFunc')
            ->with('error', 'Não é possível marcar a encomenda como paga.');
    }


    public function markAsClosed(Order $order): RedirectResponse
    {
        $this->authorize('markAsClosed', $order);
        $this->authorize('markAsClosed', Order::class);//auth

        if ($order->status === 'paid') {
            $order->status = 'closed';
            $order->save();



            return redirect()->route('orders.minhasFunc')
                ->with('success', 'Encomenda marcada como fechada com sucesso.');
        }

        return redirect()->route('orders.minhasFunc')
            ->with('error', 'Não é possível marcar a encomenda como fechada.');
    }


    // public function destroy(Order $order): RedirectResponse
    // {
    //     $this->authorize('userActive');//auth

    //     try {
    //         $order->delete();
    //         // $order->status = 'canceled';
    //         // $order->save();
    //         $htmlMessage = "Order #{$order->id} foi cancelada com sucesso!";
    //         $alertType = 'success';
    //     } catch (\Exception $error) {
    //         $url = route('orders.show', ['order' => $order]);
    //         $htmlMessage = "Não foi possível cancelar a Order <a href='$url'>#{$order->id}</a> porque ocorreu um erro!";
    //         $alertType = 'danger';
    //     }
    //     return redirect()->route('orders.index')
    //         ->with('alert-msg', $htmlMessage)
    //         ->with('alert-type', $alertType);
    // }
}
