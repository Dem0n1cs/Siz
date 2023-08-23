@extends('layouts.app')
@section('content')
    <div class="push-top">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br/>
        @endif
        <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('personal_card.create') }}">Добавить</a>
        </div>
        <table class="table">
            <thead>
            <tr class="table-warning">
                <td>Филиал</td>
                <td>Подразделение</td>
                <td>Отдел</td>
                <td class="text-center">Действия</td>
            </tr>
            </thead>
            <tbody>
            @foreach($personalCards as $personalCard)
                <tr>
                    <td data-name="branch" rowspan="">{{$personalCard->title}}</td>
                </tr>
                @foreach($personalCard->departments as $department)
                    @php $countDivision = $department->divisions->count()+1 @endphp
                    <tr>
                        <td data-name="department" rowspan="{{$countDivision}}">{{$department->title}}</td>

                    </tr>
                    @foreach($department->divisions as $division)
                        <tr>
                            <td data-name="division">{{$division->full_title}}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
            </tbody>
        </table>
        <div>
            <script type="module">
                $(document).ready(function () {
                    const countBranch = $('.table').children('tbody>tr').length
                    $('td[data-name="branch"]').prop('rowspan', countBranch)
                });
            </script>
@endsection
