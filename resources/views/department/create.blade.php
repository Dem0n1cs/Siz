@extends('layouts.app')
@section('content')
    <div class="card push-top w-50 m-auto">
        <div class="card-header">
            Добавить филиал
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('department.store') }}">
                @csrf
                <div class="form-group mb-2">
                    <label for="title">Название</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{old('title')}}"/>
                    @error('title')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    @csrf
                    <label for="branch_id">Название</label>
                    <select class="form-control @error('title') is-invalid @enderror" name="branch_id" id="branch_id">
                        <option>Выберите филиал</option>
                        @foreach($branches as $key=>$value)
                            <option value="{{$key}} @selected(old('branch_id') == $key)">{{$value}}</option>
                        @endforeach
                    </select>
                    @error('branch_id')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-grid gap-1">
                    <button type="submit" class="btn btn-block btn-success">Cохранить</button>
                    <a class="btn btn-danger" href="{{route('department.index')}}">Назад</a>
                </div>
            </form>
        </div>
    </div>
@endsection
