@extends('layouts.app')
@section('content')
    <div class="push-top w-50 m-auto mt-2">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
        <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('clothing_sizes.create') }}">Добавить</a>
        </div>
        <table class="table">
            <thead>
            <tr class="table-warning">
                <td>ID</td>
                <td>Размер</td>
                <td class="text-center">Действия</td>
            </tr>
            </thead>
            <tbody>
            @foreach($clothingSizes as $clothingSize)
                <tr>
                    <td>{{$clothingSize->id}}</td>
                    <td>{{$clothingSize->size_range}}</td>
                    <td class="text-center">
                        <a href="{{ route('clothing_sizes.edit',$clothingSize->id)}}" class="btn btn-primary btn-sm">Редактировать</a>
                        <form action="{{ route('clothing_sizes.destroy', $clothingSize->id)}}" method="post" style="display: inline-block">
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
