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
                    <td data-name="branch" data-branch_id="{{$branch->id}}" rowspan="">{{$branch->title}}</td>
                </tr>
                @foreach($branch->departments as $department)
                    <tr>
                        <td data-name="department" data-branch_id="{{$branch->id}}" data-department_id="{{$department->id}}" rowspan="">{{$department->title}}</td>
                    </tr>
                    @foreach($department->divisions as $division)
                        <tr>
                            <td data-name="division" data-branch_id="{{$branch->id}}" data-department_id="{{$department->id}}" data-division_id="{{$division->id}}" rowspan="">{{$division->full_title}}</td>
                        </tr>
                        @foreach($division->user as $user)
                            <tr>
                                <td>
                                    {{$user->full_name}}
                                </td>
                                <td data-name="user" data-branch_id="{{$branch->id}}" data-department_id="{{$department->id}}" data-division_id="{{$division->id}}">
                                    @if(!$user->personalcard)
                                        <a href="{{ route('personal_card.create', $user->id) }}"
                                           class="btn btn-info btn-sm">Создать</a>
                                    @else
                                        <a href="{{ route('personal_card.edit', $user->personalcard->id) }}"
                                           class="btn btn-info btn-sm">Редактировать</a>
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
                    const tableTbodyTr = $('.table tbody>tr');

                    function updateRowspan(elementName) {
                        tableTbodyTr.children(`td[data-name="${elementName}"]`).each(function () {
                            const elementId = $(this).data(`${elementName}_id`);
                            const countUser = tableTbodyTr.children(`td[data-name="user"][data-${elementName}_id="${elementId}"]`).length;
                            let rowspanElement = countUser + 1;

                            if (elementName !== 'division') {
                                const countDivision = tableTbodyTr.children(`td[data-name="division"][data-${elementName}_id="${elementId}"]`).length;
                                rowspanElement += countDivision;
                            }

                            if (elementName === 'branch') {
                                const countDepartment = tableTbodyTr.children(`td[data-name="department"][data-branch_id="${elementId}"]`).length;
                                rowspanElement += countDepartment;
                            }

                            $(this).attr('rowspan', rowspanElement);
                        });
                    }

                    ['branch', 'department', 'division'].forEach(updateRowspan);
                });
            </script>
@endsection
