@extends('layouts.app')
@section('content')
    <div class="card push-top w-50 m-auto mt-2">
        <div class="card-header">
            Добавить роль
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('roles.store') }}">
                @csrf
                <div class="form-group mb-2">
                    <label for="name">Название</label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name"
                           id="name"
                           value="{{old('name')}}"
                           autocomplete="off"/>
                    @error('name')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                    <th>
                        <label for="all_permission"></label>
                        <input type="checkbox" name="all_permission" id="all_permission">
                    </th>
                    <th>Название</th>
                    <th>Защитник</th>
                    </tr>
                    </thead>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <label>
                                    <input type="checkbox"
                                           name="permission[{{ $permission->name }}]"
                                           value="{{ $permission->name }}"
                                           class='permission'>
                                </label>
                            </td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                        </tr>
                    @endforeach
                </table>
                <div class="d-grid gap-1">
                    <button type="submit" class="btn btn-block btn-success">Сохранить</button>
                    <a class="btn btn-danger" href="{{route('roles.index')}}">Отмена</a>
                </div>
            </form>
        </div>
    </div>
    <script type="module">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {
                if($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',false);
                    });
                }

            });
        });
    </script>
@endsection



