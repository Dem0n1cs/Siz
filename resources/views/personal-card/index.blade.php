@extends('layouts.app')
@section('content')
    <div class="push-top w-75 m-auto mt-2">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br/>
        @endif
  {{--      <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('personal_card.create') }}">Добавить</a>
        </div>--}}
        <table class="table">
            <thead>
            <tr class="table-warning">
                <td>Филиал</td>
                <td>Подразделение</td>
                <td>Отдел</td>
                <td>Сотрудник</td>
                <td class="text-center">Действия</td>
            </tr>
            </thead>
            <tbody>

            @foreach($personalCards as $branch)
                <tr>
                    <td data-name="branch" data-id="{{$branch->id}}" rowspan="">{{$branch->title}}</td>
                </tr>
                @foreach($branch->departments as $department)
                    <tr>
                        <td data-name="department" data-id="{{$branch->id}}" rowspan="">{{$department->title}}</td>
                    </tr>
                    @foreach($department->divisions as $division)
                        <tr>
                            <td data-name="division" data-id="{{$branch->id}}" rowspan="">{{$division->full_title}}</td>
                        </tr>
                        @foreach($division->user as $user)
                            <tr>
                                <td>
                                    {{$user->full_name}}
                                </td>
                                <td data-name="user" data-id="{{$branch->id}}">
                                    @if(!$user->personalcard)
                                    <a href="{{ route('personal_card.create', $user->id) }}" class="btn btn-info btn-sm">Создать</a>
                                    @else
                                        <a href="{{ route('personal_card.edit', $user->personalcard->id) }}" class="btn btn-info btn-sm">Редактировать</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
            </tbody>
        </table>
        <div>
            <script type="module">
                $(document).ready(function () {
                    $('.table tbody>tr').children('td[data-name="branch"]').each(function () {
                        const id = $(this).data('id');
                        const countUser = parseInt($('.table tbody>tr').children(`td[data-name="user"][data-id=${id}]`).length)
                        $(`td[data-name="branch"][data-id=${id}]`).prop('rowspan', countUser + 3)
                        $(`td[data-name="department"][data-id=${id}]`).prop('rowspan', countUser + 2)
                        $(`td[data-name="division"][data-id=${id}]`).prop('rowspan', countUser + 1)
                    })
                });
            </script>
@endsection
