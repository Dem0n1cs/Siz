@extends('layouts.app')
@section('content')
    <div class="push-top w-75 m-auto mt-2">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br/>
        @endif
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('branch.create') }}">Добавить</a>
            </div>
        <table class="table">
            <thead>
            <tr class="table-warning">
                <td>ID</td>
                <td>Название филиала</td>
                <td class="text-center">Действия</td>
            </tr>
            </thead>
            <tbody>
            @foreach($branches as $branch)
                <tr>
                    <td>{{$branch->id}}</td>
                    <td>{{$branch->title}}</td>
                    <td class="text-center">
                        <a href="{{ route('branch.edit', $branch->id)}}" class="btn btn-primary btn-sm">Редактировать</a>
                            <form action="{{ route('branch.destroy', $branch->id)}}" method="post" style="display: inline-block">
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
