@extends('layouts.app')
@section('content')
    <div class="card push-top w-50 m-auto">
        <div class="card-header">
            Добавить запись
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('profession.store') }}">
                @csrf
                <div class="form-group mb-2">
                    <label for="title">Название</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{old('title')}}"/>
                    @error('title')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-grid gap-1">
                    <button type="submit" class="btn btn-block btn-success">Сохранить</button>
                    <a class="btn btn-danger" href="{{route('profession.index')}}">Отмена</a>
                </div>
            </form>
        </div>
    </div>
@endsection
