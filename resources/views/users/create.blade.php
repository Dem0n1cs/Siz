@extends('layouts.app')

@section('content')
    <div class="card push-top w-50 m-auto">
        <div class="card-header">
            Добавить пользователя
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <div class="form-group mb-2">
                    <label for="employee_number">Табельный номер</label>
                    <input type="text"
                           class="form-control @error('employee_number') is-invalid @enderror"
                           name="employee_number"
                           id="employee_number"
                           value="{{old('employee_number')}}"
                           autocomplete="off"/>
                    @error('employee_number')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="last_name">Фамилия</label>
                    <input type="text"
                           class="form-control @error('last_name') is-invalid @enderror"
                           name="last_name"
                           id="last_name"
                           value="{{old('last_name')}}"
                           autocomplete="off"/>
                    @error('last_name')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="first_name">Имя</label>
                    <input type="text"
                           class="form-control @error('first_name') is-invalid @enderror"
                           name="first_name"
                           id="first_name"
                           value="{{old('first_name')}}"
                           autocomplete="off"/>
                    @error('first_name')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="middle_name">Отчество</label>
                    <input type="text"
                           class="form-control @error('middle_name') is-invalid @enderror"
                           name="middle_name"
                           id="middle_name"
                           value="{{old('middle_name')}}"
                           autocomplete="off"/>
                    @error('middle_name')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="user_name">Логин</label>
                    <input type="text"
                           class="form-control @error('user_name') is-invalid @enderror"
                           name="user_name"
                           id="user_name"
                           value="{{old('user_name')}}"
                           autocomplete="off"/>
                    @error('user_name')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="division_id">Отдел</label>
                    <select class="form-control @error('division_id') is-invalid @enderror"
                            name="division_id"
                            id="division_id">
                        <option value="">Выберите вариант</option>
                        @foreach($divisions as $key=>$full_title)
                            <option value="{{$key}}">{{$full_title}}</option>
                        @endforeach
                    </select>
                    @error('division_id')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="profession_id">Должность</label>
                    <select class="form-control @error('profession_id') is-invalid @enderror"
                           name="profession_id"
                           id="profession_id">
                        <option value="">Выберите вариант</option>
                        @foreach($professions as $key=>$title)
                            <option value="{{$key}}">{{$title}}</option>
                        @endforeach
                    </select>
                    @error('profession_id')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="email">Email</label>
                    <input type="text"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email"
                           id="email"
                           value="{{old('email')}}"
                           autocomplete="off"/>
                    @error('email')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="employment">Дата приема на работу</label>
                    <input type="date"
                           class="form-control @error('employment') is-invalid @enderror"
                           name="employment"
                           id="employment"
                           value="{{old('employment')}}"/>
                    @error('employment')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="password">Пароль</label>
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password"
                           id="password"
                           autocomplete="off"/>
                    @error('password')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="password_confirmation">Подтверждение пароля</label>
                    <input type="password"
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           name="password_confirmation"
                           id="password_confirmation"
                           autocomplete="off"/>
                    @error('password')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="role_id">Права</label>
                    <select class="form-control @error('role_id') is-invalid @enderror"
                            name="role_id"
                            id="role_id">
                        <option value="">Выберите вариант</option>
                        @foreach($roles as $key=>$name)
                            <option value="{{$key}}">{{$name}}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>



                <div class="d-grid gap-1">
                    <button type="submit" class="btn btn-block btn-success">Сохранить</button>
                    <a class="btn btn-danger" href="{{route('users.index')}}">Назад</a>
                </div>
            </form>
        </div>

    </div>
@endsection
