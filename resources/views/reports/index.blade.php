@extends('layouts.app')

@section('content')
    <div class="push-top w-75 m-auto mt-2">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br/>
        @endif

        @if($reports->count() > 0)
            <table class="table table-sm text-center">
                <thead class="text-center">
                <tr class="table-warning">
                    <td class="align-middle">ФИО</td>
                    <td class="align-middle">Подразделение</td>
                    <td class="align-middle">Профессия</td>
                    <td class="align-middle">СИЗ</td>
                    <td class="align-middle">Классификация</td>
                    <td class="align-middle">Количество</td>
                    <td class="align-middle">Дата выдачи</td>
                    <td class="align-middle">Срок носки</td>
                    <td class="align-middle">Рост/Размер одежды</td>
                    <td class="align-middle">Размер обуви</td>
                </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>{{ $report->last_name }} {{ $report->first_name }} {{ $report->middle_name }}</td>
                        <td>{{ $report->division_name }}</td>
                        <td>{{ $report->profession_name }}</td>
                        <td>{{ $report->ppe_name }}</td>
                        <td>{{ $report->classification_name }}</td>
                        <td>{{ $report->quantity }}</td>
                        <td>{{ $report->give_date }}</td>
                        <td>{{ $report->term_wear }}</td>
                        <td>{{ $report->height_range }}<br>{{ $report->size_range }}</td>
                        <td>{{ $report->shoe_size }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
                {{ $reports->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="alert alert-info">
                Нет записей для отображения
            </div>
        @endif
    </div>
@endsection
