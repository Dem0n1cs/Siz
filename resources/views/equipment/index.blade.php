@extends('layouts.app')
@section('content')
    <div class="push-top">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
        <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('equipment.create') }}">Добавить</a>
        </div>
        <table class="table">
            <thead>
            <tr class="table-warning">
                <td>ID</td>
                <td>Название</td>
                <td>Класификация</td>
                <td>Срок носки</td>
                <td class="text-center">Действия</td>
            </tr>
            </thead>
            <tbody>
            @foreach($equipments as $equipment)
                <tr>
                    <td>{{$equipment->id}}</td>
                    <td>{{$equipment->title}}</td>
                    <td>{{$equipment->classification->title}}</td>
                    <td>{{$equipment->wear_period}}</td>
                    <td class="text-center">
                        <a href="{{ route('equipment.edit', $equipment->id)}}" class="btn btn-primary btn-sm">Редактировать</a>
                        <form action="{{ route('equipment.destroy', $equipment->id)}}" method="post" style="display: inline-block">
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
