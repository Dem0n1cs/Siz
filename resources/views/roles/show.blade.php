@extends('layouts.app')

@section('content')
    <div class="push-top w-75 m-auto mt-2">
        <h1 class="align-items-center">{{ ucfirst($role->name) }}</h1>
        <div class="lead">
        </div>
        <div class="container mt-4">

            <h3>Разрешения</h3>

            <table class="table table-striped">
                <thead>
                <tr>
                <th>Имя</th>
                <th>Защитник</th>
                </tr>
                </thead>
                @foreach($rolePermissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->guard_name }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>
    <div class="d-grid gap-1">
        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">Редактировать</a>
        <a href="{{ route('roles.index') }}" class="btn btn-danger">На главную</a>
    </div>
@endsection
