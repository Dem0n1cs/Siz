@extends('layouts.app')

@section('content')
    <div class="push-top w-75 m-auto mt-2">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br/>
        @endif

        <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('roles.create') }}">Добавить</a>
        </div>

        <table class="table">
            <thead>
            <tr class="table-warning">
                <th>ID</th>
                <th>Название</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($roles as $key => $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td class="text-center">
                        <a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}">Просмотр</a>
                        <a href="{{ route('roles.edit', $role->id)}}" class="btn btn-primary btn-sm">Редактировать</a>
                        <form action="{{ route('roles.destroy', $role->id)}}" method="post"
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
        <div class="d-flex">
            {!! $roles->links() !!}
        </div>
        <div>
@endsection
