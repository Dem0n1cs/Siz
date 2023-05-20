@extends('layouts.app')
@section('content')
    <div class="card push-top w-50 m-auto">
        <div class="card-header">
            Редактирование
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('equipment.store') }}">
                @csrf
                <div class="form-group mb-2">
                    <label for="title">Название</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{old('title')}}"/>
                    @error('title')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="classification_id">Класификация</label>
                    <select class="form-control @error('classification_id') is-invalid @enderror" name="classification_id" id="classification_id">
                        <option value="">Выберите вариант</option>
                        @foreach($classifications as $key=>$value)
                            <option value="{{$key}}" @selected(old('department_id') == $key)>{{$value}}</option>
                        @endforeach
                    </select>
                    @error('classification_id')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="wear_period">Срок носки</label>
                    <input type="text"  class="form-control @error('wear_period') is-invalid @enderror" name="wear_period" id="wear_period" value="{{old('wear_period')}}"/>
                    @error('wear_period')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-grid gap-1">
                    <button type="submit" class="btn btn-block btn-success">Сохранить</button>
                    <a class="btn btn-danger" href="{{route('equipment.index')}}">Назад</a>
                </div>

            </form>
        </div>
    </div>
@endsection
