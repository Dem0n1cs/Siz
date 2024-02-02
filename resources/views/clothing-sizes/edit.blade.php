@extends('layouts.app')
@section('content')
    <div class="card push-top w-50 m-auto mt-2">
        <div class="card-header">
            Редактировать
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('clothing_sizes.update',$clothingSize->id) }}">
                @csrf
                @method('PATCH')
                <div class="form-group mb-2">
                    <label for="size_range">Размер</label>
                    <input type="text" class="form-control @error('size_range') is-invalid @enderror" name="size_range" id="size_range" value="{{old('size_range',$clothingSize->size_range)}}"/>
                    @error('size_range')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-grid gap-1">
                    <button type="submit" class="btn btn-block btn-success">Сохранить</button>
                    <a class="btn btn-danger" href="{{route('clothing_sizes.index')}}">Назад</a>
                </div>
            </form>
        </div>
    </div>
@endsection
