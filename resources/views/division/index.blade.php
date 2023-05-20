@extends('layouts.app')
@section('content')
    <div class="push-top">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
        <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('division.create') }}">Добавить</a>
        </div>
        <table class="table">
            <thead>
            <tr class="table-warning">
                <td>ID</td>
                <td>Полное Название</td>
                <td>Краткое Название</td>
                <td class="text-center">Действия</td>
            </tr>
            </thead>
            <tbody>
            @foreach($divisions as $division)
                <tr>
                    <td>{{$division->id}}</td>
                    <td>{{$division->short_title}}</td>
                    <td>{{$division->full_title}}</td>
                    <td class="text-center">
                        <a href="{{ route('division.edit', $division->id)}}" class="btn btn-primary btn-sm">Редактировать</a>
                        <form action="{{ route('division.destroy', $division->id)}}" method="post" style="display: inline-block">
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
