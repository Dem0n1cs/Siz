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
    <form method="post" action="{{route('personal_card.store')}}" enctype="multipart/form-data">
        @csrf
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
                <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}">
                <div class="row border">
                    <div class="col-8 border">
                        Фамилия
                        <span id="last_name" class="text-decoration-underline">{{$user->last_name}}</span>
                    </div>

                    <div class="col-2 border">
                        <div class="input-group input-group-sm">
                            <label class="input-group-text" for="front_side[gender]">Пол</label>
                            <select class="form-select @error('front_side.gender') is-invalid @enderror" id="front_side[gender]"
                                    name="front_side[gender]">
                                <option value="" @selected(old('front_side.gender') === '-')>-</option>
                                <option value="муж" @selected(old('front_side.gender') === 'муж')>муж</option>
                                <option value="жен" @selected(old('front_side.gender') === 'жен')>жен</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2 border">
                        <div class="input-group input-group-sm">
                            <label class="input-group-text" for="front_side[height_id]">Рост</label>
                            <select class="form-select @error('front_side.height_id') is-invalid @enderror" id="front_side[height_id]" name="front_side[height_id]">
                                <option value="">-</option>
                                @foreach($heights as $key => $height)
                                    <option value="{{$key}}" @selected((int)old('front_side.height_id') === $key)>{{$height}}</option>
                                @endforeach
                            </select>
                            @error('front_side.height_id')
                            <span class="invalid-feedback fs-6">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row border">
                    <div class="col-8 border">
                        Собственное имя
                        <span id="first_name" class="text-decoration-underline">{{$user->first_name}}</span>
                    </div>
                    <div class="col-4 border">
                        Размер
                    </div>
                </div>
                <div class="row border">
                    <div class="col-8 border">
                        Отчество (если таковое имеется)
                        <span id="middle_name" class="text-decoration-underline">{{$user->middle_name}}</span>
                    </div>
                    <div class="col-2 border">
                        <div class="input-group input-group-sm">
                            <label class="input-group-text" for="front_side[clothing_size_id]">Одежды</label>
                            <select class="form-select @error('front_side.clothing_size_id') is-invalid @enderror" id="front_side[clothing_size_id]" name="front_side[clothing_size_id]">
                                <option value="">-</option>
                                @foreach($clothingSizes as $key => $clothingSize)
                                    <option value="{{$key}}" @selected((int)old('front_side.clothing_size_id') === $key)>{{$clothingSize}}</option>
                                @endforeach
                            </select>
                            @error('clothing_size')
                            <span class="invalid-feedback fs-6">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-2 border">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" id="growth">Обуви</span>
                            <input type="text" class="form-control @error('shoe_size') is-invalid @enderror"
                                   aria-label="Обуви" aria-describedby="Обуви" id="front_side[shoe_size]"
                                   name="front_side[shoe_size]"
                                   value="{{old('front_side.shoe_size')}}">
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
                              class="text-decoration-underline">{{$user->division->full_name_work}}</span>
                    </div>
                    <div class="col-4 border">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" id="glove_size">Рукавиц/перчаток</span>
                            <select class="form-select @error('front_side.glove_size') is-invalid @enderror"
                                    id="front_side[glove_size]"
                                    name="front_side[glove_size]" aria-label="Рукавиц/перчаток">
                                <option value="-">-</option>
                                <option value="XS">XS</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row border">
                    <div class="col-6 border">
                        Профессия (должность)
                        <span id="profession_title"
                              class="text-decoration-underline">{{$user->profession->title}}</span>
                    </div>
                    <div class="col-6 border">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" id="growth">Показатели коррегируюющих очков</span>
                            <input type="text" class="form-control @error('front_side.corrective_glasses') is-invalid @enderror"
                                   aria-label="Показатели коррегируюющих очков"
                                   aria-describedby="Показатели коррегируюющих очков"
                                   id="front_side[corrective_glasses]"
                                   name="front_side[corrective_glasses]">
                        </div>
                    </div>
                </div>
                <div class="row border">
                    <div class="col-5 border">
                        Дата приема на работу
                        <span id="employment" class="text-decoration-underline">{{$user->employment_human}}</span>
                    </div>
                    <div class="col-7 border">
                        Дата изменения профессии рабочего (должности служащего)
                        <span id="employment"
                              @isset($user->dismissal)class="text-decoration-underline"@endisset >{{$user->dismissal ?? '-'}}</span>
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
                    @foreach($user->profession->standards as $item => $standard)
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
                        Главный бухгалтер (бухгалтер)
                    </div>
                    <div class="col-7 border">

                    </div>
                </div>

                <div class="row border">
                    <div class="col-5 border">
                        Специалист отдела кадров
                    </div>
                    <div class="col-7 border">

                    </div>
                </div>

                <div class="row border">
                    <div class="col-5 border">
                        Специалист отдела кадров
                    </div>
                    <div class="col-7 border">

                    </div>
                </div>

                <div class="row border">
                    <div class="col-5 border">
                        Руководитель структурного подразделения
                    </div>
                    <div class="col-7 border">

                    </div>
                </div>

                <div class="row border">
                    <div class="col-5 border">
                        Специалист по охране труда
                    </div>
                    <div class="col-7 border">

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
                    <div class="col-7 border">

                    </div>
                </div>
            </div>
        </div>

        <div class="card push-top w-100 m-auto">
            <div class="card-body">
                <div class="card-header">
                    Личная карточка учета средств индивидуальной защиты(обратная сторона)
                </div>
                <table class="table text-center">
                    <thead class="align-middle">
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
                            <span>Классификация (маркировка)<br> по защитным свойствам или конструктивным особенностям</span>
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
                        <th colspan="2">
                            <span class="span">подпись сдавшего средство индивидуальной защиты / подпись получающего средство индивидуальной защиты</span>
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
                        <td colspan="2">
                            12
                        </td>

                    </tr>
                    </thead>
                    <tbody id="reverse_side">
                    @php $count = !empty(old('reverse_side_gives')) ? count(old('reverse_side_gives')) : 1; @endphp
                    @php $standards = $user->profession->standards @endphp
                    @include('personal-card.components.reverse-side-tr-old', compact('count','standards'))
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
                $(this).children('td[data-id="reverse_side_gives_ppe_id"],td[data-id="reverse_side_gives_date"],' +
                    'td[data-id="reverse_side_gives_quantity"],td[data-id="reverse_side_gives_percentage_wear"],' +
                    'td[data-id="reverse_side_gives_percentage_cost"],td[data-id="reverse_side_gives_signature"],' +
                    'td[data-id="reverse_side_returns_date"],td[data-id="reverse_side_returns_quantity"],' +
                    'td[data-id="reverse_side_returns_percentage_wear"],td[data-id="reverse_side_returns_cost"],' +
                    'td[data-id="reverse_side_returns_signatures"]').each(function () {
                    let name = $(this).find('select,input').prop('name').replace(/\[(\d+)\]/g, '[' + index + ']');
                    $(this).find('select,input,label')
                        .prop('name', name)
                        .prop('id', name)
                        .prop('for', name)
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
            $(clone).find('select').prop('class', 'form-select').val('')
            $(clone).find('input').prop('class', 'form-control').val('')
            $(clone).find('label').html('')
            $(clone).find('td[data-id="classification"]>span').text('')
            $(this).closest('tr').after(clone);
            change_index();
        });
        $(document).on('click', '#minusButton', function () {
            $(this).closest('tr').remove();
            change_index()
        });

        $(document).ready(function(){
            $(document).on('click','button[type="button"]',function(){
                $(this).parent().find('input[type="file"]').click();
            });

            $(document).on('change','input[type="file"]',function(){
                let fileName = $(this).val().split('\\').pop();
                $(this).parent().find(".custom-file-label").html(fileName);
            });
        });
    </script>

@endsection

