<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name')}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>


<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Главная</a>
        @auth()
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                </li>
                <li class="nav-item dropdown">
                </li>
                @can('branch.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('branch.index')}}">Филиал</a>
                    </li>
                @endcan
                @can('department.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('department.index')}}">Подразделение</a>
                    </li>
                @endcan
                @can('division.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('division.index')}}">Отдел</a>
                    </li>
                @endcan
                @can('classification.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('classification.index')}}">Класификация СИЗ</a>
                    </li>
                @endcan
                @can('ppe.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('ppe.index')}}">Экипировка</a>
                    </li>
                @endcan
                @can('profession.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('profession.index')}}">Профессии</a>
                    </li>
                @endcan
                @can('personal_card.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('personal_card.index')}}">Личные карточки</a>
                    </li>
                @endcan
                @can('roles.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('roles.index')}}">Роли</a>
                    </li>
                @endcan
                @can('permissions.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('permissions.index')}}">Права</a>
                    </li>
                @endcan
                @can('users.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('users.index')}}">Пользователи</a>
                    </li>
                @endcan
                @can('heights.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('heights.index')}}">Рост</a>
                    </li>
                @endcan
                @can('clothing_sizes.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('clothing_sizes.index')}}">Размеры</a>
                    </li>
                @endcan
                @can('report.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('report.index')}}">Отчет</a>
                    </li>
                @endcan
            </ul>
    </div>
    @endauth
    @guest()
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle my-2 my-sm-0" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="{{route('login')}}">Войти</a></li>
            </ul>
        </div>
    @endguest
    @auth()
        <div class="collapse navbar-collapse d-flex justify-content-md-end" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->full_name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Выйти</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    @endauth
</nav>
<div>
    @yield('content')
</div>
</body>
</html>
