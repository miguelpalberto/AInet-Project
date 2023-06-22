<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Price;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\OrderItemRequest;



class OrderItemController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(OrderItem::class, 'orderItem');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('userActive'); //auth

        $useQuery = OrderItem::query();

        $orderItems = $useQuery->paginate(10);
        return view('orderItems', compact('orderItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $orderItem = new OrderItem();

        //return view('orderItems.create', compact('ordemItem'));
        $colors = Color::all();
        $price = Price::first();
        //  return view('order_items.create')
        //      ->withOrderItem($orderItem)
        //      ->withColor($color);
        //return view('order_items.create', ['color' => $color]);
        return view('order_items.create', compact('orderItem', 'colors', 'price'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderItemRequest $request): RedirectResponse
    {
        $formData = $request->validated();

        $orderItem = DB::transaction(function () use ($formData) { //TODO Rever acho que nao é form
            $newOrderItem = new OrderItem();
            $newOrderItem->order_id = $formData['order_id'];
            $newOrderItem->tshirt_image_id = $formData['tshirt_image_id'];
            $newOrderItem->color_code = $formData['color_code'];
            $newOrderItem->size = $formData['size'];
            $newOrderItem->qty = $formData['qty'];
        });
        // Obter o preço unitário da t-shirt com base na configuração atual
        $price = Price::getCurrentPrice();
        $orderItem->unit_price = $price->amount;

        $orderItem->sub_total = $orderItem->unit_price * $orderItem->qty;

        $orderItem->save();

        // Redirecionar para a página de detalhes da encomenda
        $url = route('orders.show', ['order' => $orderItem->order_id]);
        $htmlMessage = "Item de encomenda <a href='$url'> #{$orderItem->id} </a> adicionado com sucesso!";

        return redirect()->route('orders.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItem $orderItem): View
    {
        return view('orderItems.show', compact('ordemItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderItem $orderItem): View
    {
        $this->authorize('userActive'); //auth

        return view('orderItems.edit', compact('orderItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderItemRequest $request, OrderItem $orderItem): RedirectResponse
    {
        $this->authorize('userActive'); //auth

        $formData = $request->validated();

        $orderItem->tshirt_image_id = $formData['tshirt_image_id'];
        $orderItem->color_code = $formData['color_code'];
        $orderItem->size = $formData['size'];
        $orderItem->qty = $formData['qty'];
        $orderItem->unit_price = $formData['unit_price'];
        $orderItem->sub_total = $formData['qty'] * $formData['unit_price'];
        $orderItem->save();

        // Optionally, you can perform additional logic or update related models here

        $url = route('orderItems.show', ['order_item' => $orderItem]);
        $htmlMessage = "Item de encomenda <a href='$url'>#{$orderItem->id}</a> foi atualizado com sucesso!";

        return redirect()->route('orderItems.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItem $orderItem)
    {
        $this->authorize('userActive'); //auth

        try {
            $orderItem->delete();
            $htmlMessage = "Item #{$orderItem->id}foi apagado com sucesso!";
            $alertType = 'success';
        } catch (\Exception $error) {
            $url = route('order_items.show', ['orderItem' => $orderItem]);
            $htmlMessage = "Não foi possível apagar o Item <a href='$url'>#{$orderItem->id}</a> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return redirect()->route('order_items.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}
