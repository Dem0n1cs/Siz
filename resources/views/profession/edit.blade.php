@extends('layouts.app')
@section('content')
    <div class="card push-top w-50 m-auto mt-2">
        <div class="card-header">
            Редактирование
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        <li>Проверьте заполнение формы (поля помечены красным)</li>
                    </ul>
                </div>
            @endif
            <form method="post" action="{{route('profession.update',$profession->id)}}">
                @csrf
                @method('PATCH')
                <div class="form-group mb-2">
                    <label for="title">Профессия</label>
                    <input type="text" class="form-control @error('professions.title') is-invalid @enderror"
                           name="professions[title]" id="title" value="{{old('professions.title',$profession->title)}}">
                    @error('professions.title')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>

                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Нормы выдачи</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                @if ($errors->has('standards'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{$errors->first('standards')}}</li>
                                        </ul>
                                    </div>
                                @endif
                                @php $index_arr = 1; @endphp
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="col-1 align-middle text-center">Выбор</th>
                                        <th scope="col" class="col-8 align-middle text-center">Название</th>
                                        <th scope="col" class="col-1 align-middle text-center">Норма выдачи</th>
                                        <th scope="col" class="col-2 align-middle text-center">Срок носки</th>
                                        <th scope="col" class="col-1 align-middle text-center">Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ppes as $ppe)
                                        <tr>
                                            <td class="col-1 align-middle text-center">
                                                <input type="hidden"
                                                       class="form-control @error('standards.'.$index_arr.'.quantity')is-invalid @enderror"
                                                       data-key="{{$ppe->equipment_id}}"
                                                       data-id="id" name="standards[{{$index_arr}}][id]"
                                                       value="{{old('standards.'.$index_arr.'.id',$ppe->id)}}"
                                                       placeholder="Идшник"
                                                       aria-label="id"
                                                       disabled/>
                                                <input type="checkbox" class="form-check-input"
                                                       data-key="{{$ppe->equipment_id}}"
                                                       data-id="ppe_id"
                                                       name="standards[{{$index_arr}}][ppe_id]"
                                                       value="{{$ppe->id}}"
                                                       @checked(old('standards.'.$index_arr.'.ppe_id',$ppe->ppe_id)) aria-label="ppe_id"/>
                                            </td>
                                            <td class="col-8 align-middle text-wrap">{{$ppe->title_classification}}</td>
                                            <td class="col-1 align-middle text-center">
                                                <input type="text"
                                                       class="form-control @error('standards.'.$index_arr.'.quantity')is-invalid @enderror"
                                                       data-key="{{$ppe->equipment_id}}" data-id="quantity"
                                                       name="standards[{{$index_arr}}][quantity]"
                                                       value="{{old('standards.'.$index_arr.'.quantity',$ppe->quantity)}}"
                                                       aria-label="quantity"
                                                       autocomplete="off"
                                                       disabled/></td>
                                            <td class="col-2 align-middle text-center">
                                                <input type="text"
                                                       class="form-control @error('standards.'.$index_arr.'.term_wear')is-invalid @enderror"
                                                       data-key="{{$ppe->equipment_id}}" data-id="term_wear"
                                                       name="standards[{{$index_arr}}][term_wear]"
                                                       value="{{old('standards.'.$index_arr.'.term_wear',$ppe->term_wear)}}"
                                                       aria-label="term_wear"
                                                       autocomplete="off"
                                                       @readonly($ppe->term_wear === 'До износа' || $ppe->term_wear === 'Дежурный')
                                                       disabled/></td>
                                            <td class="col-1">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input"
                                                           data-id="before_wear"
                                                           data-key="{{$ppe->equipment_id}}"
                                                           data-text="До износа"
                                                           aria-label="before_wear"
                                                           @checked(old('standards.'.$index_arr.'.term_wear',$ppe->term_wear) === 'До износа')
                                                           disabled>
                                                    <label class="form-check-label" for="before_wear">До Износа</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input"
                                                           data-id="duty_wear"
                                                           data-key="{{$ppe->equipment_id}}"
                                                           data-text="Дежурный"
                                                           aria-label="duty_wear"
                                                           @checked(old('standards.'.$index_arr.'.term_wear',$ppe->term_wear) === 'Дежурный')
                                                           disabled>
                                                    <label class="form-check-label" for="duty_wear">Дежурный</label>
                                                </div>
                                            </td>
                                        </tr>
                                        @php $index_arr++; @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-1 ">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">Нормы выдачи
                    </button>
                    <hr/>
                    <button type="submit" class="btn btn-block btn-success">Сохранить</button>
                    <a class="btn btn-danger" href="{{route('profession.index')}}">Назад</a>
                </div>

            </form>
        </div>
    </div>

    <script type="module">
        function checkbox(key) {
            const ppe_id = $('input[data-key=' + key + ']input[data-id="ppe_id"]');
            const element = $('input[data-key=' + key + ']');
            const checkbox = $('input[data-key=' + key + ']:checkbox');
            const text = $('input[data-key=' + key + ']:text');
            if (ppe_id.is(':checked')) {
                element.not(ppe_id).prop('disabled', false);
                checkbox.val(key)
            } else {
                element.not(ppe_id).prop('disabled', true);
                checkbox.prop('checked', false);
                text.val('').prop('readonly', false);
            }
        }

        $(document).ready(function () {
            $('input[data-id="ppe_id"]').on('change', function () {
                checkbox($(this).data('key'));
            });
        });
        $(document).ready(function () {
            $('input[data-id="ppe_id"]').each(function () {
                checkbox($(this).data('key'));
            });
        });

        $(document).ready(function () {
            $('input[data-id="before_wear"],input[data-id="duty_wear"]').on('change', function () {
                const key = $(this).data('key')
                const text = $(this).data('text')
                if ($(this).is(':checked')) {
                    $('input[data-id="before_wear"][data-key=' + key + '],input[data-id="duty_wear"][data-key=' + key + ']').not($(this)).prop('checked', false);
                    $('input[data-id="term_wear"][data-key=' + key + ']')
                        .prop('readonly', true)
                        .val(text)
                } else {
                    $('input[data-id="term_wear"][data-key=' + key + ']')
                        .prop('readonly', false)
                        .val('')
                }
            });
        });

    </script>
@endsection
