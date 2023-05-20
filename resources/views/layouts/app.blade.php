<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name')}}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Главная</a>
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    {{--   <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                           Themes
                       </a>--}}
                    {{--       <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                               <li><a class="dropdown-item" href="#">Action</a></li>
                               <li><a class="dropdown-item" href="#">Another action</a></li>
                               <li><hr class="dropdown-divider"></li>
                               <li><a class="dropdown-item" href="#">Something else here</a></li>
                           </ul>--}}
                </li>
                <li class="nav-item dropdown">
                    {{--         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                 Download
                             </a>
                             <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                 <li><a class="dropdown-item" href="#">Action</a></li>
                                 <li><a class="dropdown-item" href="#">Another action</a></li>
                                 <li><hr class="dropdown-divider"></li>
                                 <li><a class="dropdown-item" href="#">Something else here</a></li>
                             </ul>--}}
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('branch.index')}}">Филиал</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('department.index')}}">Подразделение</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('division.index')}}">Отдел</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('classification.index')}}">Класификация СИЗ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('equipment.index')}}">Экипировка</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('profession.index')}}">Профессии</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container p-2 mw-75">
        @yield('content')
    </div>
</body>
</html>
