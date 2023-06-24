<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index(Request $request): View
    {

        $filterByUserType = $request->user_type ?? '';
        $filterByName = $request->name ?? '';
        $userQuery = User::query();
        if ($filterByUserType !== '') {
            $userQuery->where('user_type', $filterByUserType);
        }
        if ($filterByName !== '') {
            $userIds = User::where('name', 'like', "%$filterByName%")->pluck('id');
            $userQuery->whereIntegerInRaw('id', $userIds);
        }
        // TODO
        $users = $userQuery->paginate(10);
        //$users = $userQuery->with('customer')->paginate(10);
        return view('users.index', compact('users', 'filterByName', 'filterByUserType'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    public function create(): View
    {
        $user = new User();
        return view('users.create', compact('user'));
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store(UserRequest $request): RedirectResponse
    {
        $formData = $request->validated();
        $user = DB::transaction(function () use ($formData, $request) {
            $newUser = new User();

            if ($request->hasFile('photo_url')) {
                $path = $request->photo_url->store('public/photos');
                $newUser->photo_url = basename($path);
                $newUser->save();
            }

            $newUser->name = $formData['name'];
            $newUser->email = $formData['email'];
            $newUser->user_type = $formData['user_type'];
            $newUser->blocked = 0;
            $newUser->password = Hash::make($formData['password_inicial']);
            $newUser->save();
            return $newUser;
        });
        $url = route('users.show', ['user' => $user]);
        $htmlMessage = "User <a href='$url'>#{$user->id}</a>
                        <strong>\"{$user->name}\"</strong> foi criado com sucesso!";
        return redirect()->route('users.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    // /**
    //  * Display the specified resource.
    //  */
    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $formData = $request->validated();
        $user = DB::transaction(function () use ($formData, $user, $request) {
            $user->name = $formData['name'];
            $user->email = $formData['email'];
            $user->user_type = $formData['user_type'];




            if ($request->hasFile('file_photo')) {
                if ($user->photo_url) {
                    Storage::delete('public/photos/' . $user->photo_url);
                }
                $path = $request->file_photo->store('public/photos');
                $user->photo_url = basename($path);
                $user->save();
            }

            $user->save();
            return $user;
        });
        $url = route('users.show', ['user' => $user]);
        $htmlMessage = "User <a href='$url'>#{$user->id}</a>
                        <strong>\"{$user->name}\"</strong> foi alterado com sucesso!";
        return redirect()->route('users.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(User $user): RedirectResponse
    {
        try {
            $totalOrders = 0;
            if ($user->user_type == 'C') {
                $totalOrders = DB::scalar('select count(*) from orders where customer_id = ?', [$user->id]);
            }
            if ($totalOrders == 0) {
                DB::transaction(function () use ($user) {
                    $user->delete();
                });

                $htmlMessage = "User #{$user->id}
                        <strong>\"{$user->name}\"</strong> foi apagado com sucesso!";
                return redirect()->route('users.index')
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', 'success');
            } else {
                $url = route('users.show', ['user' => $user]);
                $alertType = 'warning';
                $ordersStr = $totalOrders > 0 ?
                    ($totalOrders == 1 ?
                        "tem 1 encomenda" :
                        "tem $totalOrders encomendas") :
                    "";
                $htmlMessage = "User <a href='$url'>#{$user->id}</a>
                    <strong>\"{$user->name}\"</strong>
                    não pode ser apagado porque $ordersStr!
                    ";
            }

            if ($user->photo_url) {
                Storage::delete('storage/photos/' . $user->photo_url);
            }

        } catch (\Exception $error) {
            $url = route('users.show', ['user' => $user]);
            $htmlMessage = "Não foi possível apagar o user <a href='$url'>#{$user->id}</a>
                        <strong>\"{$user->name}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

    public function changeBlocked(User $user): RedirectResponse
    {
        $this->authorize('changeBlocked', $user); //auth
        $strblocked = 'bloqueado';

        //$formData = $request->validated();
        //$user = DB::transaction(function () use ($formData, $user) {
        if ($user->blocked == 0) {
            $user->blocked = 1;
        } else {
            $user->blocked = 0;
            $strblocked = 'desbloqueado';
        }

        $user->save();
        //return $user;
        //});
        $url = route('users.index', ['user' => $user]);
        $htmlMessage = "User <a href='$url'>#{$user->id}</a>
                        <strong>\"{$user->name}\"</strong> foi $strblocked!";
        return redirect()->route('users.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }


    public function destroy_foto(User $user): RedirectResponse
    {
        $this->authorize('destroy_foto', $user); //auth

        if ($user->photo_url) {
            Storage::delete('storage/photos/' . $user->photo_url);
            $user->photo_url = null;
            $user->save();
        }
        return redirect()->route('users.edit', ['user' => $user])
            ->with('alert-msg', 'Foto do user "' . $user->name .
                '" foi removida!')
            ->with('alert-type', 'success');
    }
}
