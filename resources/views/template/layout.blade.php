<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ImageShirt</title>
    @vite('resources/sass/app.scss')
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" style="height: 65px;>
        <!-- Navbar Brand-->
        <a class=" navbar-brand " href=" {{ route('home') }}">
        <img src="/img/logoimagineshirt.png" alt="Logo" class="bg-dark" width="200" height="60">
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-3 me-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        @guest
        <ul class="navbar-nav ms-auto me-1 me-lg-3">
            @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                    {{ __('Login') }}
                </a>
            </li>
            @endif
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">
                    {{ __('Registar') }}
                </a>
            </li>
            @endif
        </ul>
        @else
        <div class="ms-auto me-0 me-md-2 my-2 my-md-0 navbar-text">
            {{ Auth::user()->name }}
        </div>
        <!-- Navbar-->
        <ul class="navbar-nav me-1 me-lg-3">
            <li class="nav-item dropdown">
                
            
                
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ Auth::user()->fullPhotoUrl }}" alt="Avatar" class="bg-dark rounded-circle" width="45" height="45">
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">





                    {{-- Auth --}}
                    {{-- <li><a class="dropdown-item" href="#">Perfil</a></li> --}}
                    @if ((Auth::user()->user_type ?? '') == 'A')
                    <li><a class="dropdown-item" href="{{ route('users.show', ['user' => Auth::user()]) }}">Perfil</a></li>
                    @elseif ((Auth::user()->user_type ?? '') == 'E')
                    <li><a class="dropdown-item" href="{{ route('users.show', ['user' => Auth::user()]) }}">Perfil</a>
                    </li>
                    @elseif ((Auth::user()->user_type ?? '') == 'C')
                    <li><a class="dropdown-item" href="{{ route('customers.show', ['customer' => Auth::user()->customer]) }}">Perfil</a>
                    </li>
                    @endif
                    <li>
                        {{-- <a class="dropdown-item" href="#">Alterar Senha</a> --}}
                        <a class="dropdown-item" href="{{ route('password.change.show') }}">Alterar Senha</a>
                    </li>








                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="dropdown-item" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            Sair
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
        @endguest

        <!-- Side bar-->
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <!-- TODO  -->
                        {{-- <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Dashboard
                        </a> --}}
                        <br>

                        <a class="nav-link {{ Route::currentRouteName() == 'tshirtImages.index' ? 'active' : '' }}" href="{{ route('tshirtImages.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-shirt"></i></div>
                            Imagens Tshirt
                        </a>



      

                        

                        <a class="nav-link {{ Route::currentRouteName() == 'cart.show' ? 'active' : '' }}" href="{{ route('cart.show') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-cart-shopping"></i></div>Carrinho Compras
                        </a>

                   @can('viewAny', \App\Models\Customer::class)<!--Auth-->
                        <div class="sb-sidenav-menu-heading">Gestão Pessoas</div>

                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link {{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}" href="{{ route('users.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users-gear"></i></div>
                                Users
                            </a>
                        </nav>

                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link {{ Route::currentRouteName() == 'customers.index' ? 'active' : '' }}" href="{{ route('customers.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Clientes
                            </a>
                        </nav>
                        @endcan

                        <nav class="sb-sidenav-menu-nested nav">
                            <br>
                        </nav>

                        @can('viewAny', \App\Models\Order::class)<!--Auth-->
                        <div class="sb-sidenav-menu-heading">Gestão Encomendas</div>

                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link {{ Route::currentRouteName() == 'orders.index' ? 'active' : '' }}" href="{{ route('orders.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-box-open"></i></div>
                                Encomendas
                            </a>
                        </nav>
                        @endcan
                        <nav class="sb-sidenav-menu-nested nav">

                            @can('viewAny', \App\Models\Category::class)<!--Auth-->
                        </nav>
                        <br>
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link {{ Route::currentRouteName() == 'prices.index' ? 'active' : '' }}" href="{{ route('prices.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-dollar-sign"></i></div>
                                Preços
                            </a>
                        </nav>

                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link {{ Route::currentRouteName() == 'categories.index' ? 'active' : '' }}" href="{{ route('categories.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-border-all"></i></div>
                                Categorias
                            </a>
                        </nav>


                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link {{ Route::currentRouteName() == 'colors.index' ? 'active' : '' }}" href="{{ route('colors.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-palette"></i></div>
                                Cores
                            </a>
                        </nav>
                        @endcan

                        <!-- TODO  -->
                        <div class="sb-sidenav-menu-heading">Espaço Privado</div>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-text"></i></div>
                            Minhas Encomendas
                        </a>

                        {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRecursosHumanos" aria-expanded="false" aria-controls="collapseRecursosHumanos">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Recursos Humanosssssss
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseRecursosHumanos" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="#">Departamentosssssss</a>
                                <a class="nav-link" href="#">Docentesssss</a>
                            </nav>
                        </div> --}}

                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <!--Flash Messages:-->
                    @if (session('alert-msg'))
                    @include('shared.messages')
                    @endif
                    @if ($errors->any())
                    @include('shared.alertValidation')
                    @endif
                    <h1 class="mt-4">@yield('titulo', 'ImagineShirt')</h1>
                    @yield('subtitulo')
                    <div class="mt-4">
                        @yield('main')
                    </div>
                </div>
            </main>
            <footer class="py-2 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy;ImageShirt 2023</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @vite('resources/js/app.js')
</body>

</html>