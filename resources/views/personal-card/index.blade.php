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
                <i class="bi bi-person-lines-fill me-2"></i>Персональные карточки СИЗ
            </h2>
        </div>

        <div class="card shadow-sm border-0 rounded-0"> <!-- Убрали скругления у карточки -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped m-0">
                        <thead class="table-light">
                        <tr>
                            <th>Филиал</th>
                            <th>Отдел</th>
                            <th>Подразделение</th>
                            <th>Сотрудник</th>
                            <th class="text-end" style="width: 200px;">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($personalCards as $branch)
                            @foreach($branch->departments as $department)
                                @foreach($department->divisions as $division)
                                    @foreach($division->user as $user)
                                        <tr>
                                            <td class="align-middle">{{ $branch->title }}</td>
                                            <td class="align-middle">{{ $department->title }}</td>
                                            <td class="align-middle">{{ $division->full_title }}</td>
                                            <td class="align-middle">
                                                <i class="bi bi-person-circle me-2"></i>
                                                {{ $user->full_name }}
                                            </td>
                                            <td class="text-end">
                                                <div class="d-flex gap-2 justify-content-end">
                                                    @if(!$user->personalcard)
                                                        @can('personal_card.create')
                                                            <a href="{{ route('personal_card.create', $user->id) }}"
                                                               class="btn btn-success btn-sm"
                                                               title="Создать карточку"
                                                               data-bs-toggle="tooltip">
                                                                <i class="bi bi-file-earmark-plus"></i>
                                                            </a>
                                                        @else
                                                            <button class="btn btn-warning btn-sm"
                                                                    title="Карточка не создана"
                                                                    data-bs-toggle="tooltip">
                                                                <i class="bi bi-exclamation-triangle"></i>
                                                            </button>
                                                        @endcan
                                                    @else
                                                        @if(isset($user->boss_id))
                                                            @can('personal_card.download')
                                                                <a href="{{route('personal_card.download', $user->id)}}"
                                                                   class="btn btn-info btn-sm"
                                                                   title="Скачать"
                                                                   data-bs-toggle="tooltip">
                                                                    <i class="bi bi-download"></i>
                                                                </a>
                                                            @endcan
                                                        @else
                                                            <button class="btn btn-danger btn-sm"
                                                                    title="Отсутствует руководитель"
                                                                    data-bs-toggle="tooltip">
                                                                <i class="bi bi-exclamation-triangle"></i>
                                                            </button>
                                                        @endif
                                                        @can('personal_card.edit')
                                                            <a href="{{ route('personal_card.edit', $user->personalcard->id) }}"
                                                               class="btn btn-warning btn-sm"
                                                               title="Редактировать"
                                                               data-bs-toggle="tooltip">
                                                                <i class="bi bi-pencil-fill"></i>
                                                            </a>
                                                        @endcan
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const toastEl = document.getElementById('successToast');
                if (toastEl) {
                    new bootstrap.Toast(toastEl).show();
                }

                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(t => new bootstrap.Tooltip(t));
            });
        </script>
    @endpush
@endsection
