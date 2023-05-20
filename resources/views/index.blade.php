@extends('layouts.app')
@section('content')
    <div class="container">
        @if($errors->any())
            <div class="card text-white bg-danger mb-3 mx-auto" style="max-width: 40rem;">
                <div class="card-header align-content-center">Ошибка</div>
                <div class="card-body">
                    <p class="card-text">{{$errors->first()}}</p>
                </div>
            </div>
        @endif
    </div>
@endsection
