<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <title>
        Laravel
    </title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

        <!-- Nucleo Icons -->
    <link href="{{ asset('assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/nucleo-svg.css" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('css/theme/css/material-dashboard-admin.css') }}" rel="stylesheet" />
    {{-- <link id="pagestyle" href="{{ asset('css/style.css') }}" rel="stylesheet" /> --}}

    @yield('style')

</head>
<body class="g-sidenav-show bg-gray-200">
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        {{-- CONTENT --}}
        <div class="container-fluid py-4" style="min-height: calc(100vh - 148px);">

            <div class="py-3">
                {{-- Retorno dos controllers --}}
                @if(session()->get('message') && session()->get('type') )
                    <div class="alert {{ session()->get('type') }} alert-dismissible fade show text-white" role="alert">
                        <span class="alert-text">{!! session()->get('message')!!}</span>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                {{-- Erros retornados pelas validações de request --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            @yield('content')
        </div>
        <x-footer></x-footer>
    </main>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
