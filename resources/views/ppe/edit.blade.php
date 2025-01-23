@extends('layouts.app')
@section('content')
    <div class="card push-top w-50 m-auto mt-2">
        <div class="card-header">
            Редактирование
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('ppe.update',$ppe->id) }}">
                @csrf
                @method('PATCH')
                <div class="form-group mb-2">
                    <label for="title">Название</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{old('title',$ppe->title)}}"/>
                    @error('title')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="short_title">Название</label>
                    <input type="text" class="form-control @error('short_title') is-invalid @enderror" name="short_title" id="short_title" value="{{old('short_title',$ppe->short_title)}}"/>
                    @error('short_title')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="classification_id">Класификация</label>
                    <select class="form-control @error('classification_id') is-invalid @enderror" name="classification_id" id="classification_id">
                        <option value="">Выберите вариант</option>
                        @foreach($classifications as $key=>$value)
                            <option value="{{$key}}" @selected(old('classification_id',$ppe->classification_id) == $key)>{{$value}}</option>
                        @endforeach
                    </select>
                    @error('classification_id')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-grid gap-1">
                    <button type="submit" class="btn btn-block btn-success">Сохранить</button>
                    <a class="btn btn-danger" href="{{route('ppe.index')}}">Назад</a>
                </div>
            </form>
        </div>
    </div>
@endsection
