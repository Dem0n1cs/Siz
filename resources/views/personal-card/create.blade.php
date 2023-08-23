@extends('layouts.app')
@section('content')
    <div class="card push-top w-75 m-auto">
        <div class="card-header">
            Личная карточка учета средств индивидуальной защиты
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('personal_card.store') }}">
                @csrf
                <div class="form-group mb-2">
                    <label for="user_id">Работник</label>
                    <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                        <option value="">Выберите вариант</option>
                    </select>
                    @error('user_id')
                    <span class="invalid-feedback fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row border">
                    <div class="col-8 border">
                       Фамилия
                    </div>
                    <div class="col-2 border">
                        Пол
                    </div>
                    <div class="col-2 border">
                        Рост
                    </div>
                </div>
                <div class="row border">
                    <div class="col-8 border">
                        Собственное имя
                    </div>
                    <div class="col-4 border">
                        Размер
                    </div>
                </div>
                <div class="row border">
                    <div class="col-8 border">
                        Отчество (если таковое имеется)
                    </div>
                    <div class="col-2 border">
                        одежды
                    </div>
                    <div class="col-2 border">
                        обуви
                    </div>
                </div>
                <div class="row border">
                    <div class="col-8 border">
                        Структурное подразделение
                    </div>
                    <div class="col-2 border">
                        рукавиц
                    </div>
                    <div class="col-2 border">
                        перчаток
                    </div>
                </div>
                <div class="row border">
                    <div class="col-6 border">
                        Профессия (должность)
                    </div>
                    <div class="col-6 border">
                        Показатели коррегируюющих очков
                    </div>
                </div>
                <div class="row border">
                    <div class="col-5 border">
                        Дата приема на работу
                    </div>
                    <div class="col-7 border">
                        Дата изменения профессии рабочего (должности служащего)
                    </div>
                </div>
                <div class="row border">
                    <div class="col-12 border">
                        Предусмотрено по установленным нормам:
                    </div>
                </div>

                <div class="row border">
                    <div class="col-6 border">
                        Наименование средств индивидуальной защиты
                    </div>
                    <div class="col-4 border">
                        Классификация (маркировка) по защитным свойствам или конструктивным особенностям
                    </div>
                    <div class="col-2 border">
                        Норма выдачи (штук, пар) на год, если не установлено иное
                    </div>
                </div>
               @foreach($professions as $profession)
                   @foreach($profession->standards as $standard)
                        <div class="row border">
                    <div class="col-6 border">
                        {{$standard->ppe->title}}
                    </div>
                    <div class="col-4 border">
                        {{$standard->ppe->classification->title}}
                    </div>
                    <div class="col-2 border">
                        {{$standard->term_wear}}
                    </div>
                </div>
                    @endforeach
                @endforeach

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
                <div class="d-grid gap-1">
                    <button type="submit" class="btn btn-block btn-success">Сохранить</button>
                    <a class="btn btn-danger" href="{{route('personal_card.index')}}">Отмена</a>
                </div>
            </form>
        </div>
    </div>
@endsection
