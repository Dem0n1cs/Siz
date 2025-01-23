@extends('layouts.app')

@section('content')

    <div class="push-top w-75 m-auto mt-2">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br/>
        @endif

            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('users.create') }}">Добавить</a>
            </div>


        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Полное имя</th>
                <th>Логин</th>
                <th>Email</th>
                <th>Роль</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th>{{ $user->id }}</th>
                    <td>{{ $user->full_name}}</td>
                    <td>{{ $user->user_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->roles as $role)
                            <span class="badge bg-danger">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    {{--<td><a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm">Просмотр</a></td>--}}
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Редактирование</a>
                        <form action="{{ route('users.destroy', $user->id)}}" method="post"
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
            {!! $users->links('pagination::bootstrap-5') !!}
    </div>
@endsection
