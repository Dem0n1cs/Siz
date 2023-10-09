@extends('layouts.app')
@section('content')
    <div class="push-top w-75 m-auto mt-2">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br/>
        @endif
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('department.create') }}">Добавить</a>
            </div>
        <table class="table">
            <thead>
            <tr class="table-warning">
                <td>ID</td>
                <td>Название</td>
                <td>Название филиала</td>
                <td class="text-center">Действия</td>
            </tr>
            </thead>
            <tbody>
            @foreach($departments as $department)
                <tr>
                    <td>{{$department->id}}</td>
                    <td>{{$department->title}}</td>
                    <td>{{$department->branch->title}}</td>
                    <td class="text-center">
                        <a href="{{ route('department.edit', $department->id)}}" class="btn btn-primary btn-sm">Редактировать</a>
                            <form action="{{ route('department.destroy', $department->id)}}" method="post" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
@endsection
