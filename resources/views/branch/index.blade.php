@extends('layouts.app')

@section('content')
    <div class="container-fluid p-4">
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

        <div class="mb-4">
            <h2 class="fw-bold text-primary mb-3">
                <i class="bi bi-building me-2"></i>Филиалы
            </h2>
            <a href="{{ route('branch.create') }}" class="btn btn-primary rounded-pill">
                <i class="bi bi-plus-lg me-2"></i>Добавить филиал
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped m-0">
                        <thead class="table-light">
                        <tr>
                            <th class="w-25">#ID</th>
                            <th>Название филиала</th>
                            <th class="text-end" style="width: 150px;">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($branches as $branch)
                            <tr>
                                <td class="align-middle">{{ $branch->id }}</td>
                                <td class="align-middle">{{ $branch->title }}</td>
                                <td class="text-end">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{ route('branch.edit', $branch->id)}}"
                                           class="btn btn-sm btn-primary"
                                           title="Редактировать"
                                           data-bs-toggle="tooltip">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('branch.destroy', $branch->id)}}"
                                              method="post"
                                              class="d-inline"
                                              onsubmit="return confirm('Вы уверены, что хотите удалить этот филиал?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    title="Удалить"
                                                    data-bs-toggle="tooltip">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        document.addEventListener('DOMContentLoaded', function () {
            const toastEl = document.getElementById('successToast');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl);
                toast.show();
            }

            // Инициализация тултипов
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(t => new bootstrap.Tooltip(t));
        });
    </script>
@endsection
