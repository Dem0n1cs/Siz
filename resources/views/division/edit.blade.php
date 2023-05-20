@extends('layouts.app')
@section('content')
    <div class="card push-top w-50 m-auto">
        <div class="card-header">
            Редактирование
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('division.update',$division->id) }}">
                <div class="form-group mb-2">
                    @csrf
                    @method('PATCH')
                    <label for="short_title">Краткое название</label>
                    <input type="text" class="form-control @error('short_title') is-invalid @enderror" name="short_title" id="short_title" value="{{old('short_title',$division->short_title)}}"/>
                    @error('short_title')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    @csrf
                    @method('PATCH')
                    <label for="full_title">Полное название</label>
                    <input type="text" class="form-control @error('full_title') is-invalid @enderror" name="full_title" id="full_title" value="{{old('full_title',$division->full_title)}}"/>
                    @error('full_title')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="department_id">МРО/Управление</label>
                    <select class="form-control @error('department_id') is-invalid @enderror" name="department_id" id="department_id">
                        <option value="">Выберите вариант</option>
                        @foreach($departments as $key=>$value)
                            <option value="{{$key}}" @selected(old('department_id',$division->department_id) == $key)>{{$value}}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-grid gap-1">
                    <button type="submit" class="btn btn-block btn-success">Cохранить</button>
                    <a class="btn btn-danger" href="{{route('division.index')}}">Назад</a>
                </div>
            </form>
        </div>
    </div>
@endsection
