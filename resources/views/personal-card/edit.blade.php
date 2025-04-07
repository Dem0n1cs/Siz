@extends('layouts.app')
@section('content')
    <style>
        .span {
            text-align: center;
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            overflow-wrap: break-word;
            height: 180px;
        }
    </style>
    <form method="post" action="{{route('personal_card.update',$personalCard->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="card push-top w-50 m-auto mt-2">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-header">
                Личная карточка учета средств индивидуальной защиты(лицевая сторона)
            </div>
            <div class="card-body">
                <input type="hidden" id="user_id" name="user_id" value="{{$personalCard->user->id}}">
                <div class="row border">
                    <div class="col-6 border">
                        Фамилия
                        <span id="last_name" class="text-decoration-underline">{{$personalCard->user->last_name}}</span>
                    </div>

                    <div class="col-3 border">
                        <div class="input-group input-group-sm">
                            <label class="input-group-text" for="front_side[gender]">Пол</label>
                            <select class="form-select @error('front_side.gender') is-invalid @enderror"
                                    id="front_side[gender]"
                                    name="front_side[gender]">
                                <option value="">-</option>
                                <option
                                    value="муж" @selected(old('front_side.gender',$personalCard->frontside->gender) === 'муж')>
                                    муж
                                </option>
                                <option
                                    value="жен" @selected(old('front_side.gender',$personalCard->frontside->gender) === 'жен')>
                                    жен
                                </option>
                            </select>
                            @error('front_side.gender')
                            <span class="invalid-feedback fs-6">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3 border">
                        <div class="input-group input-group-sm">
                            <label class="input-group-text" for="front_side[height_id]">Рост</label>
                            <select class="form-select @error('front_side.height_id') is-invalid @enderror"
                                    id="front_side[height_id]" name="front_side[height_id]">
                                <option value="">-</option>
                                @foreach($heights as $key => $height)
                                    <option
                                        value="{{$key}}" @selected((int)old('front_side.height_id',$personalCard->frontside->height_id) === $key)>{{$height}}</option>
                                @endforeach
                            </select>
                            @error('front_side.height_id')
                            <span class="invalid-feedback fs-6">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row border">
                    <div class="col-6 border">
                        Собственное имя
                        <span id="first_name"
                              class="text-decoration-underline">{{$personalCard->user->first_name}}</span>
                    </div>
                    <div class="col-6 border">
                        Размер
                    </div>
                </div>
                <div class="row border">
                    <div class="col-6 border">
                        Отчество (если таковое имеется)
                        <span id="middle_name"
                              class="text-decoration-underline">{{$personalCard->user->middle_name}}</span>
                    </div>
                    <div class="col-3 border">
                        <div class="input-group input-group-sm">
                            <label class="input-group-text" for="front_side[clothing_size_id]">Одежды</label>
                            <select class="form-select @error('front_side.clothing_size_id') is-invalid @enderror"
                                    id="front_side[clothing_size_id]" name="front_side[clothing_size_id]">
                                <option value="">-</option>
                                @foreach($clothingSizes as $key => $clothingSize)
                                    <option
                                        value="{{$key}}" @selected((int)old('front_side.clothing_size_id',$personalCard->frontside->clothing_size_id) === $key)>{{$clothingSize}}</option>
                                @endforeach
                            </select>
                            @error('clothing_size')
                            <span class="invalid-feedback fs-6">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3 border">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" id="growth">Обуви</span>
                            <input type="text" class="form-control @error('shoe_size') is-invalid @enderror"
                                   aria-label="Обуви" aria-describedby="Обуви" id="front_side[shoe_size]"
                                   name="front_side[shoe_size]"
                                   value="{{old('front_side.shoe_size',$personalCard->frontside->shoe_size)}}">
                            @error('shoe_size')
                            <span class="invalid-feedback fs-6">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row border">
                    <div class="col-8 border">
                        Структурное подразделение
                        <span id="division_short_title"
                              class="text-decoration-underline">{{$personalCard->user->division->full_name_work}}</span>
                    </div>
                    <div class="col-4 border">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" id="glove_size">Рукавиц/перчаток</span>
                            <select class="form-select @error('glove_size') is-invalid @enderror"
                                    id="front_side[glove_size]"
                                    name="front_side[glove_size]" aria-label="Рукавиц/перчаток">
                                <option value="-">-</option>
                                <option
                                    value="XS" @selected(old('front_side.glove_size',$personalCard->frontside->glove_size) === 'XS')>
                                    XS
                                </option>
                                <option
                                    value="S" @selected(old('front_side.glove_size',$personalCard->frontside->glove_size) === 'S')>
                                    S
                                </option>
                                <option
                                    value="M" @selected(old('front_side.glove_size',$personalCard->frontside->glove_size) === 'M')>
                                    M
                                </option>
                                <option
                                    value="L" @selected(old('front_side.glove_size',$personalCard->frontside->glove_size) === 'L')>
                                    L
                                </option>
                                <option
                                    value="XL" @selected(old('front_side.glove_size',$personalCard->frontside->glove_size) === 'XL')>
                                    XL
                                </option>
                                <option
                                    value="XXL" @selected(old('front_side.glove_size',$personalCard->frontside->glove_size) === 'XXL')>
                                    XXL
                                </option>
                            </select>
                            @error('glove_size')
                            <span class="invalid-feedback fs-6">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row border">
                    <div class="col-6 border">
                        Профессия (должность)
                        <span id="profession_title"
                              class="text-decoration-underline">{{$personalCard->user->profession->title}}</span>
                    </div>
                    <div class="col-6 border">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" id="growth">Показатели коррегируюющих очков</span>
                            <input type="text" class="form-control @error('corrective_glasses') is-invalid @enderror"
                                   aria-label="Показатели коррегируюющих очков"
                                   aria-describedby="Показатели коррегируюющих очков"
                                   id="front_side[corrective_glasses]"
                                   name="front_side[corrective_glasses]"
                                   value="{{old('front_side.corrective_glasses',$personalCard->frontside->corrective_glasses)}}">
                            @error('corrective_glasses')
                            <span class="invalid-feedback fs-6">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row border">
                    <div class="col-5 border">
                        Дата приема на работу
                        <span id="employment"
                              class="text-decoration-underline">{{$personalCard->user->employment_human}}</span>
                    </div>
                    <div class="col-7 border">
                        Дата изменения профессии рабочего (должности служащего)
                        <span id="employment"
                              @isset($user->dismissal)class="text-decoration-underline"@endisset >{{$personalCard->user->dismissal ?? '-'}}</span>
                    </div>
                </div>

                <table class="table table-bordered text-center">
                    <thead class="align-middle">
                    <tr>
                        <th colspan="3" class="text-start">
                            Предусмотрено по установленным нормам:
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Наименование средств индивидуальной защиты
                        </th>
                        <th>
                            Классификация (маркировка) по защитным свойствам или конструктивным особенностям
                        </th>
                        <th>
                            Норма выдачи (штук, пар) на год, если не установлено иное
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($personalCard->user->profession->standards as $index => $standard)
                        <tr>
                            <td class="col-md-8 text-start">
                                {{$standard->ppe->title}}
                            </td>
                            <td class="col-md-2">
                                {{$standard->ppe->classification->title}}
                            </td>
                            <td class="col-md-2">
                                {{$standard->term_wear}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


                <div class="row border">
                    <div class="col-12 border">
                        Достоверность подтверждаю:
                    </div>
                </div>

                <div class="row border">
                    <div class="col-5 border">
                        Начальник УБУПиО
                    </div>
                    <div class="col-7 border text-center">
                        Москалева Ю.Н.
                    </div>
                </div>
                <div class="row border">
                    <div class="col-12 border">
                        Согласовано:
                    </div>
                </div>

                <div class="row border">
                    <div class="col-5 border">
                        Начальник ОПОиКР
                    </div>
                    <div class="col-7 border text-center">
                        Марченко О.Н.
                    </div>
                </div>

                <div class="row border">
                    <div class="col-5 border">
                        {{optional($personalCard->user->boss)->boss_position ?? 'Не указан'}}
                    </div>
                    <div class="col-7 border text-center">
                        {{optional($personalCard->user->boss)->full_name ?? 'Не указан'}}
                    </div>
                </div>

                <div class="row border">
                    <div class="col-5 border">
                        Ведущий инженер по охране труда
                    </div>
                    <div class="col-7 border text-center">
                        Веретенникова Ж.А.
                    </div>
                </div>

                <div class="row border">
                    <div class="col-5 border">
                        Экономист по МТС
                    </div>
                    <div class="col-7 border text-center">
                        Галанченко Е.А.
                    </div>
                </div>

                <div class="row border">
                    <div class="col-12 border">
                        Ознакомлен:
                    </div>
                </div>

                <div class="row border">
                    <div class="col-5 border">
                        Работник
                    </div>
                    <div class="col-7 border text-center">
                        {{$personalCard->user->full_name}}
                    </div>
                </div>
            </div>
        </div>

        <div class="card push-top w-100 m-auto">
            <div class="card-body">
                <div class="card-header">
                    Личная карточка учета средств индивидуальной защиты(обратная сторона)
                </div>
                <table class="table text-center align-middle align-items-center small">
                    <thead>
                    <tr>
                        <th rowspan="2">
                            <span class="span">
                                Действия
                            </span>
                        </th>
                        <th rowspan="2">
                            Наименование средств индивидуальной защиты
                        </th>
                        <th rowspan="2">
                            <span>Классификация<br> (маркировка)<br> по защитным свойствам<br> или конструктивным особенностям</span>
                        </th>
                        <th colspan="5">
                            Выдано
                        </th>
                        <th colspan="6">
                            Возвращено
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <span class="span">дата</span>
                        </th>
                        <th style="width:4%">
                            <span class="span">количество</span>
                        </th>
                        <th style="width:4%">
                            <span class="span">процент износа на дату выдачи</span>
                        </th>
                        <th>
                            <span class="span">стоимость</span>
                        </th>
                        <th>
                            <span class="span">подпись работника</span>
                        </th>
                        <th>
                            <span class="span">дата</span>
                        </th>
                        <th>
                            <span class="span">количество</span>
                        </th>
                        <th>
                            <span class="span">процент износа</span>
                        </th>
                        <th>
                            <span class="span">стоимость</span>
                        </th>
                        <th>
                            <span class="span">подпись сдавшего средство индивидуальной защиты</span>
                        </th>
                        <th>
                            <span class="span">подпись получающего средство индивидуальной защиты</span>
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            1
                        </td>
                        <td>
                            2
                        </td>
                        <td>
                            3
                        </td>
                        <td>
                            4
                        </td>
                        <td>
                            5
                        </td>
                        <td>
                            6
                        </td>
                        <td>
                            7
                        </td>
                        <td>
                            8
                        </td>
                        <td>
                            9
                        </td>
                        <td>
                            10
                        </td>
                        <td>
                            11
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            13
                        </td>
                    </tr>
                    </thead>
                    <tbody id="reverse_side">
                    @if(!empty(old('reverse_side_gives')))
                        @php $count = !empty(old('reverse_side_gives')) ? count(old('reverse_side_gives')) : 1; @endphp
                        @php $standards = $personalCard->user->profession->standards @endphp
                        @include('personal-card.components.reverse-side-tr-old', compact('count','standards'))
                    @else
                        @php $reserveSideGives =$personalCard->reserveSideGives @endphp
                        @include('personal-card.components.reverse-side-tr', compact('reserveSideGives'))
                    @endif
                    </tbody>
                </table>
            </div>

            <div class="d-grid gap-1">
                <button type="submit" class="btn btn-block btn-success">Сохранить</button>
                <a class="btn btn-danger" href="{{route('personal_card.index')}}">Отмена</a>
            </div>
        </div>
    </form>

    <script type="module">
        function change_sorting() {
            let value = 1;
            const currentElement = $('#reverse_side').children('tr');
            currentElement.children('td[data-id="reverse_side_gives_sorting"]').children('input[type=hidden]').each(function () {
                $(this).val(value);
                value++;
            })
        }

        $(document).ready(function () {
            change_sorting();
        });

        function select_classification(select) {
            const classification = $(select).find('option:selected').data('classification');
            if (classification !== '') {
                $(select).closest('tr').find('td[data-id="classification"]>span').text(classification)
            } else if (classification === '') {
                $(select).closest('tr').find('td[data-id="classification"]>span').text('')
            }
        }

        function change_index() {
            let index = 0;
            $('#reverse_side').children('tr').each(function () {
                $(this).find('td[data-id^="reverse_side_"]').each(function () {
                    $(this).find('input, select').each(function () {
                        let name = $(this).prop('name').replace(/\[(\d+)\]/g, '[' + index + ']');
                        $(this).prop({ name: name, id: name });
                    });
                    $(this).find('label').each(function () {
                        let forAttr = $(this).prop('for').replace(/\[(\d+)\]/g, '[' + index + ']');
                        $(this).prop('for', forAttr);
                    });
                });
                index++;
            });
        }

        $(document).ready(function () {
            $('#reverse_side').on('change', 'select', function () {
                select_classification($(this));
            })
        });

        $(document).ready(function () {
            $('td[data-id="reverse_side_gives_ppe_id"]').find('select').each(function () {
                select_classification($(this));
            })
        });

        $(document).on('click', '#plusButton', function () {
            let clone = $(this).closest('tr').clone();
            $(clone).find('select').prop('class', 'form-select form-select-sm ').val('');
            $(clone).find('input').prop('class', 'form-control form-control-sm text-field').val('');
            $(clone).find('label').html('');
            $(clone).find('td[data-id="classification"]>span').text('');

            // Сброс кнопки загрузки
            $(clone).find('.upload-btn')
                .removeClass('btn-success file-loaded')
                .addClass('btn-primary btn-sm')
                .attr('title', 'Загрузить файл')
                .html('<i class="bi bi-upload"></i>');

            // Сброс индикатора состояния
            $(clone).find('td[data-id="reverse_side_gives_signature"] .btn-success, td[data-id="reverse_side_returns_signatures"] .btn-success')
                .replaceWith(
                    '<button type="button" class="btn btn-danger btn-sm" disabled title="Файла нет">' +
                    '<i class="bi bi-x-lg"></i>' +
                    '</button>'
                );

            $(this).closest('tr').after(clone);
            change_index();
            change_sorting();
        });

        $(document).on('click', '#minusButton', function () {
            $(this).closest('tr').remove();
            change_index();
            change_sorting();
        });

        $(document).ready(function () {
            // Активация input при клике на кнопку
            $(document).on('click', '.upload-btn', function (e) {
                e.preventDefault();
                $(this).siblings('input[type="file"]').trigger('click');
            });

            // Обновление состояния кнопки при выборе файла
            $(document).on('change', 'input[type="file"]', function () {
                const $button = $(this).siblings('.upload-btn');
                if (this.files.length > 0) {
                    // Файл прикреплен в форме
                    $button.removeClass('btn-primary').addClass('btn-success');
                    $button.find('i').removeClass('bi-upload').addClass('bi-check-lg');
                    $button.attr('title', 'Файл прикреплен');
                } else {
                    // Файл не выбран
                    $button.removeClass('btn-success').addClass('btn-primary');
                    $button.find('i').removeClass('bi-check-lg').addClass('bi-upload');
                    $button.attr('title', 'Загрузить файл');
                }
            });
        });
    </script>
@endsection

