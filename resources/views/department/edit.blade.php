@extends('layouts.app')
@section('content')
    <div class="card push-top w-50 m-auto">
        <div class="card-header">
            Добавить филиал
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('department.update',$department->id) }}">
                <div class="form-group mb-2">
                    @csrf
                    @method('PATCH')
                    <label for="title">Название</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{old('title',$department->title)}}"/>
                    @error('title')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="branch_id">Филиал</label>
                    <select class="form-control @error('branch_id') is-invalid @enderror" name="branch_id" id="branch_id">
                        <option value="">Выберите филиал</option>
                        @foreach($branches as $key=>$value)
                            <option value="{{$key}}" @selected(old('branch_id',$department->branch_id) == $key)>{{$value}}</option>
                        @endforeach
                    </select>
                    @error('branch_id')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-grid gap-1">
                    <button type="submit" class="btn btn-block btn-success">Сохранить</button>
                    <a class="btn btn-danger" href="{{route('department.index')}}">Назад</a>
                </div>
            </form>
        </div>
    </div>
@endsection
