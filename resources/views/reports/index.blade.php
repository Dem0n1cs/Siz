@extends('layouts.app')

@section('content')
    <div class="container-fluid p-0"> <!-- Убрали отступы у контейнера -->
        @if(session()->get('success'))
            <div class="toast-container position-fixed top-0 end-0 p-3">
                <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true"
                     data-bs-autohide="true" data-bs-delay="5000">
                    <div class="toast-header bg-success text-white">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong class="me-auto">Успешно!</strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"
                                aria-label="Закрыть"></button>
                    </div>
                    <div class="toast-body bg-light">
                        {{ session()->get('success') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="mb-4 p-3"> <!-- Добавили отступы внутри блока -->
            <h2 class="fw-bold text-primary mb-3">
                <i class="bi bi-clipboard-data me-2"></i>Отчет по выданным СИЗ
            </h2>
        </div>

        @if($reports->isNotEmpty())
            <div class="card shadow-sm border-0 rounded-0"> <!-- Убрали скругления у карточки -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped m-0 table-sm">
                            <thead class="table-light">
                            <tr>
                                <th class="text-center align-middle"><i class="bi bi-person me-2"></i>ФИО</th>
                                <th class="text-center align-middle"><i class="bi bi-diagram-3 me-2"></i>Подразделение</th>
                                <th class="text-center align-middle"><i class="bi bi-person-badge me-2"></i>Профессия</th>
                                <th class="text-center align-middle"><i class="bi bi-shield-check me-2"></i>СИЗ</th>
                                <th class="text-center align-middle"><i class="bi bi-tags me-2"></i>Классификация</th>
                                <th class="text-center align-middle"><i class="bi bi-box-seam me-2"></i>Количество</th>
                                <th class="text-center align-middle"><i class="bi bi-calendar-check me-2"></i>Дата выдачи</th>
                                <th class="text-center align-middle"><i class="bi bi-calendar-range me-2"></i>Срок носки</th>
                                <th class="text-center align-middle"><i class="bi bi-calendar-x me-2"></i>Срок окончен</th>
                                <th class="text-center align-middle"><i class="bi bi-rulers me-2"></i>Рост/Размер одежды</th>
                                <th class="text-center align-middle"><i class="bi bi-shoe-prints me-2"></i>Размер обуви</th>
                                <th class="text-center align-middle"><i class="bi bi-gear me-2"></i>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reports as $report)
                                <tr>
                                    <td class="align-middle text-center">{{ $report->last_name }} {{ $report->first_name }} {{ $report->middle_name }}</td>
                                    <td class="align-middle text-center">{{ $report->division_name }}</td>
                                    <td class="align-middle text-center">{{ $report->profession_name }}</td>
                                    <td class="align-middle text-center">{{ $report->ppe_name }}</td>
                                    <td class="align-middle text-center">{{ $report->classification_name }}</td>
                                    <td class="align-middle text-center">{{ $report->quantity }}</td>
                                    <td class="align-middle text-center">{{ $report->give_date }}</td>
                                    <td class="align-middle text-center">{{ $report->term_wear }}</td>
                                    <td class="align-middle text-center">{{ $report->wear_end_date }}</td>
                                    <td class="align-middle text-center">{{ $report->height_range }}<br>{{ $report->size_range }}</td>
                                    <td class="align-middle text-center">{{ $report->shoe_size }}</td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('personal_card.edit', $report->personal_card_id) }}"
                                           class="btn btn-primary btn-sm"
                                           title="Редактировать"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-3 p-3"> <!-- Добавили отступы для пагинации -->
                {{ $reports->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="alert alert-info m-3"> <!-- Добавили отступы для сообщения -->
                <i class="bi bi-info-circle me-2"></i>Нет записей для отображения
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Инициализация тоста
                const toastEl = document.getElementById('successToast');
                if (toastEl) {
                    new bootstrap.Toast(toastEl).show();
                }

                // Инициализация тултипов
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(t => new bootstrap.Tooltip(t));
            });
        </script>
    @endpush
@endsection
