<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemRequest;
use App\Models\OrderItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Price;



class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
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

        return view('orderItems.create', compact('ordemItem'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderItemRequest $request): RedirectResponse
    {
        $formData = $request->validated();

        $orderItem = DB::transaction(function () use ($formData) {
            $neworderItem = new OrderItem();
            $neworderItem->order_id = $formData['order_id'];
            $neworderItem->tshirt_image_id = $formData['tshirt_image_id'];
            $neworderItem->color_code = $formData['color_code'];
            $neworderItem->size = $formData['size'];
            $neworderItem->qty = $formData['qty'];
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
        return view('orderItems.edit', compact('orderItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderItemRequest $request, OrderItem $orderItem): RedirectResponse
    {
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
    public function destroy(string $id)
    {
        //
    }
}
