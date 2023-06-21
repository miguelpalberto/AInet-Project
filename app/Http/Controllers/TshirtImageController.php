<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use Illuminate\View\View;
use App\Models\TshirtImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TshirtImageRequest;

class TshirtImageController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TshirtImage::class, 'tshirtImage');
    }

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request): View
    {
        $categories = Category::all();
        $filterByCategory = $request->category ?? '';
        $filterByName = $request->name ?? '';
        $filterByDescription = $request->description ?? '';
        $tshirtImageQuery = TshirtImage::query();
        if ($filterByCategory !== '') {
            $tshirtImageQuery->where('category_id', $filterByCategory);
        }
        if ($filterByName !== '') {
            $tshirtImageIds = TshirtImage::where('name', 'like', "%$filterByName%")->pluck('id');
            $tshirtImageQuery->whereIntegerInRaw('id', $tshirtImageIds);
        }
        if ($filterByDescription !== '') {
            $tshirtImageIds = TshirtImage::where('description', 'like', "%$filterByDescription%")->pluck('id');
            $tshirtImageQuery->whereIntegerInRaw('id', $tshirtImageIds);
        }
        $tshirtImages = $tshirtImageQuery->with('category', 'customerT')->paginate(10);
        return view('tshirtImages.index', compact(
            'tshirtImages',
            'categories',
            'filterByCategory',
            'filterByName',
            'filterByDescription',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('userActive');//auth

        $tshirtImage = new TshirtImage();
        $categories = Category::all();
        return view('tshirtImages.create')
            ->withTshirtImage($tshirtImage)
            ->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TshirtImageRequest $request): RedirectResponse
    {
        $this->authorize('userActive');//auth

        $formData = $request->validated();
        $tshirtImage = DB::transaction(function () use ($formData) {
            $newtshirtImage = new TshirtImage();
            $newtshirtImage->customer_id = $formData['customer_id'] ?? null;
            $newtshirtImage->category_id = $formData['category_id'] ?? null;
            $newtshirtImage->name = $formData['name'];
            $newtshirtImage->description = $formData['description'] ?? null;
            //TODO: criar imagem e descomentar
            $newtshirtImage->image_url = ''; //TODO apagar e descomentar a debaixo
            //$newtshirtImage->image_url = $formData['image_url'];

            //Campo Extra-Info é com ficheiro json:
            $extraInfo = json_encode($formData['extra_info']);
            if (json_last_error() !== JSON_ERROR_NONE) {
                // Log the JSON encoding error
                Log::error('JSON encoding error: ' . json_last_error_msg());

                // Return an error response or perform any other error handling
                return redirect()->back()->withErrors(['extra_info' => 'Invalid value for extra_info']);
            }
            $newtshirtImage->extra_info = $formData['extra_info'] ?? null;

            $newtshirtImage->save();
            return $newtshirtImage;
        });


        $url = route('tshirtImages.show', ['tshirtImage' => $tshirtImage]);
        $htmlMessage = "Imagem de Tshirt <a href='$url'>#{$tshirtImage->id}</a> <strong>\"{$tshirtImage->name}\"</strong> foi criada com sucesso!";
        return redirect()->route('tshirtImages.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(TshirtImage $tshirtImage): View //Request $request,
    {
        $orders = Order::all();
        // Following line ensures that $showDetail is either alunos or docentes
        //$showDetail = $request->query('show-detail') == 'alunos' ? 'alunos' : 'docentes';
        // if ($showDetail == 'docentes') {
        //     $tshirtImage->load('docentes', 'docentes.user', 'docentes.departamentoRef');
        // } else {
        //     $tshirtImage->load('alunos', 'alunos.user', 'alunos.cursoRef');
        // }
        return view('tshirtImages.show')
            ->with('tshirtImage', $tshirtImage)
            ->with('orders', $orders)
            //->with('showDetail', $showDetail)
        ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TshirtImage $tshirtImage): View
    {
        $this->authorize('userActive');//auth

        $categories = Category::all();
        return view('tshirtImages.edit', [
            'tshirtImage' => $tshirtImage, 'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TshirtImageRequest $request, TshirtImage $tshirtImage): RedirectResponse
    {
        $this->authorize('userActive');//auth

        $formData = $request->validated();
        $tshirtImage = DB::transaction(function () use ($formData, $tshirtImage) {
            $tshirtImage->customer_id = $formData['customer_id'] ?? null;
            $tshirtImage->category_id = $formData['category_id'] ?? null;
            $tshirtImage->name = $formData['name'];
            $tshirtImage->description = $formData['description'] ?? null;
            //TODO: criar imagem e descomentar
            $tshirtImage->image_url = ''; //TODO apagar e descomentar a debaixo
            //$tshirtImage->image_url = $formData['image_url'];//editar

            $extraInfo = json_encode($formData['extra_info']);
            if (json_last_error() !== JSON_ERROR_NONE) {
                // Log the JSON encoding error
                Log::error('JSON encoding error: ' . json_last_error_msg());
                // Return an error response or perform any other error handling
                return redirect()->back()->withErrors(['extra_info' => 'Invalid value for extra_info']);
            }
            $tshirtImage->extra_info = $formData['extra_info'] ?? null;

            $tshirtImage->save();
            return $tshirtImage;
        });

        $url = route('tshirtImages.show', ['tshirtImage' => $tshirtImage]);
        $htmlMessage = "Imagem de Tshirt <a href='$url'>#{$tshirtImage->id}</a>
                        <strong>\"{$tshirtImage->name}\"</strong> foi alterada com sucesso!";
        return redirect()->route('tshirtImages.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    //TODO - adicionar condicoes e especificacoes
    public function destroy(TshirtImage $tshirtImage): RedirectResponse
    {
        $this->authorize('userActive');//auth
        
        try {
            $totalOrders = DB::scalar('select count(*) from order_items where tshirt_image_id = ?', [$tshirtImage->id]);
            if ($totalOrders == 0) {
                $tshirtImage->delete();
                $htmlMessage = "Imagem de Tshirt #{$tshirtImage->id}
                        <strong>\"{$tshirtImage->nome}\"</strong> foi apagada com sucesso!";
                return redirect()->route('tshirtImages.index')
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', 'success');
            } else {
                $url = route('tshirtImages.show', ['tshirtImage' => $tshirtImage]);
                $alertType = 'warning';
                $tshirtStr = $totalOrders > 0 ?
                    ($totalOrders == 1 ?
                        "1 encomenda(order_items) com essa imagem de tshirt" :
                        "$totalOrders encomendas(order_items) com essa imagem de tshirt") :
                    "";
                $htmlMessage = "Imagem de Tshirt <a href='$url'>#{$tshirtImage->id}</a>
                        <strong>\"{$tshirtImage->name}\"</strong>
                        não pode ser apagada porque há $tshirtStr!
                        ";
            }
        } catch (\Exception $error) {
            $url = route('tshirtImages.show', ['tshirtImage' => $tshirtImage]);
            $htmlMessage = "Não foi possível apagar a imagem de tshirt <a href='$url'>#{$tshirtImage->id}</a>
                        <strong>\"{$tshirtImage->nome}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}
