@extends('layouts.app')
@section('content')
    <div class="card push-top w-50 m-auto mt-2">
        <div class="card-header">
            Редактировать
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('heights.update',$height->id) }}">
                @csrf
                @method('PATCH')
                <div class="form-group mb-2">
                    <label for="height_range">Рост</label>
                    <input type="text" class="form-control @error('height_range') is-invalid @enderror" name="height_range" id="height_range" value="{{old('height_range',$height->height_range)}}"/>
                    @error('height_range')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-grid gap-1">
                    <button type="submit" class="btn btn-block btn-success">Сохранить</button>
                    <a class="btn btn-danger" href="{{route('heights.index')}}">Назад</a>
                </div>
            </form>
        </div>
    </div>
@endsection
