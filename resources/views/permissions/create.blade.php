@extends('layouts.app')

@section('content')
    <div class="card push-top w-50 m-auto mt-2">
        <div class="card-header">
            Добавить
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('permissions.store') }}">
                @csrf
                <div class="form-group mb-2">
                    <label for="name">Имя</label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name"
                           id="name"
                           value="{{old('name')}}"/>
                    @error('name')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-grid gap-1">
                    <button type="submit" class="btn btn-block btn-success">Сохранить</button>
                    <a class="btn btn-danger" href="{{route('permissions.index')}}">Отмена</a>
                </div>
            </form>
        </div>
    </div>
@endsection

