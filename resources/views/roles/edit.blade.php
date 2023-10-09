@extends('layouts.app')
@section('content')
    <div class="card push-top w-50 m-auto mt-2">
        <div class="card-header">
            Редактировать
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('roles.update', $role->id) }}">
                <div class="form-group mb-2">
                    @csrf
                    @method('PATCH')
                    <label for="name">Название</label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name"
                           id="name"
                           value="{{old('name',$role->name)}}"/>
                    @error('name')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <label for="permissions" class="form-label">Разрешения</label>

                <table class="table table-striped">
                    <thead>
                    <tr>
                    <th><label for="all_permission"></label>
                            <input type="checkbox" name="all_permission" id="all_permission">
                    </th>
                    <th>Имя</th>
                    <th>Защитник</th>
                    </tr>
                    </thead>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox"
                                       name="permission[{{ $permission->name }}]"
                                       value="{{ $permission->name }}"
                                       class='permission'
                                    {{ in_array($permission->name, $rolePermissions)
                                        ? 'checked'
                                        : '' }}>
                            </td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                        </tr>
                    @endforeach
                </table>
                <div class="d-grid gap-1">
                    <button type="submit" class="btn btn-block btn-success">Сохранить</button>
                    <a class="btn btn-danger" href="{{route('permissions.index')}}">Назад</a>
                </div>
            </form>
        </div>
    </div>
@endsection




