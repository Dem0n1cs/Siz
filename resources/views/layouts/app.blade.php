<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name')}}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="d-flex">
<!-- Боковое меню -->
<div class="d-flex flex-column flex-shrink-0 p-3 bg-light border-end position-fixed vh-100 overflow-auto" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
        <span class="fs-4 fw-bold text-center">{{ config('app.name') }}</span>
    </a>

    <ul class="nav nav-pills flex-column mb-auto">
        @auth
            @can('branch.index')
                <li class="nav-item">
                    <a href="{{route('branch.index')}}" class="nav-link link-dark">
                        <i class="bi bi-building me-2"></i> Филиал
                    </a>
                </li>
            @endcan

            @can('department.index')
                <li class="nav-item">
                    <a href="{{route('department.index')}}" class="nav-link link-dark">
                        <i class="bi bi-diagram-3 me-2"></i> Подразделение
                    </a>
                </li>
            @endcan

            @can('division.index')
                <li class="nav-item">
                    <a href="{{route('division.index')}}" class="nav-link link-dark">
                        <i class="bi bi-columns me-2"></i> Отдел
                    </a>
                </li>
            @endcan

            @can('classification.index')
                <li class="nav-item">
                    <a href="{{route('classification.index')}}" class="nav-link link-dark">
                        <i class="bi bi-tags me-2"></i> Классификация СИЗ
                    </a>
                </li>
            @endcan

            @can('ppe.index')
                <li class="nav-item">
                    <a href="{{route('ppe.index')}}" class="nav-link link-dark">
                        <i class="bi bi-shield-check me-2"></i> Экипировка
                    </a>
                </li>
            @endcan

            @can('profession.index')
                <li class="nav-item">
                    <a href="{{route('profession.index')}}" class="nav-link link-dark">
                        <i class="bi bi-person-badge me-2"></i> Профессии
                    </a>
                </li>
            @endcan

            @can('personal_card.index')
                <li class="nav-item">
                    <a href="{{route('personal_card.index')}}" class="nav-link link-dark">
                        <i class="bi bi-person-lines-fill me-2"></i> Личные карточки СИЗ
                    </a>
                </li>
            @endcan

            @can('report.index')
                <li class="nav-item">
                    <a href="{{route('report.index')}}" class="nav-link link-dark">
                        <i class="bi bi-clipboard-data me-2"></i> Отчет
                    </a>
                </li>
            @endcan
            @can('users.index')
                <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link link-dark">
                        <i class="bi bi-people me-2"></i> Пользователи
                    </a>
                </li>
            @endcan
            @can('roles.index')
                <li class="nav-item">
                    <a href="{{route('roles.index')}}" class="nav-link link-dark">
                        <i class="bi bi-person-gear me-2"></i> Роли
                    </a>
                </li>
            @endcan
            @can('permissions.index')
                <li class="nav-item">
                    <a href="{{route('permissions.index')}}" class="nav-link link-dark">
                        <i class="bi bi-key me-2"></i> Права
                    </a>
                </li>
            @endcan
        @endauth
    </ul>

    <div class="mt-auto border-top pt-3 sticky-bottom bg-light">
        @auth
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <i class="bi bi-person-circle me-2"></i>
                    <span class="fw-bold">{{ Auth::user()->full_name }}</span>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="w-100">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100">
                    <i class="bi bi-box-arrow-right me-2"></i> Выйти
                </button>
            </form>
        @endauth

        @guest
            <a href="{{route('login')}}" class="btn btn-primary w-100">
                <i class="bi bi-box-arrow-in-right me-2"></i> Войти
            </a>
        @endguest
    </div>
</div>

<!-- Основной контент -->
<main class="flex-grow-1 p-4 bg-white" style="margin-left: 280px;">
    @yield('content')
</main>
</body>
</html>
