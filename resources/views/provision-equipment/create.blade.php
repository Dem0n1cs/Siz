@extends('layouts.app')
@section('content')
    <div class="card push-top w-50 m-auto">
        <div class="card-header">
            Добавить запись
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('provision-equipment.store') }}">
                @csrf
                <div class="form-group mb-2">
                    <label for="profession_id">Профессия</label>
                    <select class="form-control @error('profession_id') is-invalid @enderror" name="profession_id" id="profession_id">
                        <option value="">Выберите вариант</option>
                        @foreach($professions as $key=>$value)
                            <option value="{{$key}}" @selected(old('profession_id') == $key)>{{$value}}</option>
                        @endforeach
                    </select>
                    @error('profession_id')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-grid gap-1">
                    <button type="submit" class="btn btn-block btn-success">Сохранить</button>
                    <a class="btn btn-danger" href="{{route('provision-equipment.index')}}">Отмена</a>
                </div>
            </form>
        </div>
    </div>
@endsection
