@extends('layouts.app')

@section('content')
    <div class="push-top w-75 m-auto mt-2">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br/>
        @endif

        @if($reports->isNotEmpty())
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
                    <td class="align-middle">Срок окончен</td>
                    <td class="align-middle">Рост/Размер одежды</td>
                    <td class="align-middle">Размер обуви</td>
                    <td class="align-middle">Действия</td>
                </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td class="align-middle">{{ $report->last_name }} {{ $report->first_name }} {{ $report->middle_name }}</td>
                        <td class="align-middle">{{ $report->division_name }}</td>
                        <td class="align-middle">{{ $report->profession_name }}</td>
                        <td class="align-middle">{{ $report->ppe_name }}</td>
                        <td class="align-middle">{{ $report->classification_name }}</td>
                        <td class="align-middle">{{ $report->quantity }}</td>
                        <td class="align-middle">{{ $report->give_date }}</td>
                        <td class="align-middle">{{ $report->term_wear }}</td>
                        <td class="align-middle">{{ $report->wear_end_date }}</td>
                        <td class="align-middle">{{ $report->height_range }}<br>{{ $report->size_range }}</td>
                        <td class="align-middle">{{ $report->shoe_size }}</td>
                        <td class="align-middle">
                            <a href="{{ route('personal_card.edit', $report->personal_card_id) }}" class="btn btn-primary btn-sm" title="Редактировать">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
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
