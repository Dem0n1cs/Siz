@extends('layouts.app')

@section('content')
    <div class="push-top w-75 m-auto mt-2">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br/>
        @endif
        <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('permissions.create') }}">Добавить</a>
        </div>
        <table class="table">
            <thead>
            <tr class="table-warning">
                <th>Название</th>
                <th>Защитник</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{$permission->name}}</td>
                    <td>{{$permission->guard_name}}</td>
                    <td class="text-center">
                        <a href="{{ route('permissions.edit', $permission->id)}}" class="btn btn-primary btn-sm">Редактировать</a>
                        <form action="{{ route('permissions.destroy', $permission->id)}}" method="post"
                              style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
