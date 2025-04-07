@foreach($reserveSideGives as $key => $reserveSideGive)
    <tr>
        <td>
            <button type="button" id="plusButton" class="btn btn-success btn-sm text-white mb-1">
                <i class="bi bi-plus" style="font-weight: bold;"></i>
            </button>
            <button type="button" id="minusButton" class="btn btn-danger btn-sm text-white">
                <i class="bi bi-dash" style="font-weight: bold;"></i>
            </button>
        </td>
        <td style="display: none" data-id="reverse_side_gives_id">
            <input type="hidden"
                   class="form-control @error('reverse_side_gives.'.$key.'.id') is-invalid @enderror"
                   name="reverse_side_gives[{{$key}}][id]"
                   id="reverse_side_gives[{{$key}}][id]"
                   value="{{old('reverse_side_gives.'.$key.'.id',$reserveSideGive->id)}}"/>
        </td>
        <td style="display: none" data-id="reverse_side_gives_sorting">
            <input type="hidden"
                   id="reverse_side_gives[{{$key}}][sorting]"
                   name="reverse_side_gives[{{$key}}][sorting]"
                   value="{{old('reverse_side_gives.'.$key.'.sorting',$reserveSideGive->sorting ?? 0)}}"/>
        </td>
        <td data-id="reverse_side_gives_ppe_id">
            <div class="input-group">
                <select
                    class="form-select form-select-sm @error('reverse_side_gives.'.$key.'.ppe_id') is-invalid @enderror"
                    id="reverse_side_gives[{{$key}}][ppe_id]"
                    name="reverse_side_gives[{{$key}}][ppe_id]" aria-label="Сиз_ид">
                    <option value="" data-classification="">-</option>
                    @foreach($personalCard->user->profession->standards as $index => $standard)
                        <option value="{{$standard->ppe->id}}"
                                data-classification="{{$standard->ppe->classification->title}}" @selected(old('department_id',$reserveSideGive->ppe_id) == $standard->ppe->id)>{{$standard->ppe->title}}</option>
                    @endforeach
                </select>
            </div>
        </td>
        <td data-id="classification">
            <span></span>
        </td>
        <td data-id="reverse_side_gives_date">
            <div class="form-group">
                <input type="date"
                       class="form-control form-control-sm @error('reverse_side_gives.'.$key.'.date') is-invalid @enderror"
                       name="reverse_side_gives[{{$key}}][date]"
                       id="reverse_side_gives[{{$key}}][date]"
                       value="{{old('reverse_side_gives.'.$key.'.date',$reserveSideGive->date)}}"
                       aria-label="Дата выдачи"/>
            </div>
        </td>
        <td data-id="reverse_side_gives_quantity">
            <div class="form-group">
                <input type="text"
                       class="form-control form-control-sm @error('reverse_side_gives.'.$key.'.quantity') is-invalid @enderror"
                       name="reverse_side_gives[{{$key}}][quantity]"
                       id="reverse_side_gives[{{$key}}][quantity]"
                       value="{{old('reverse_side_gives.'.$key.'.quantity',$reserveSideGive->quantity)}}"
                       aria-label="Количество выданного"/>
            </div>
        </td>
        <td data-id="reverse_side_gives_percentage_wear">
            <div class="form-group">
                <input type="text"
                       class="form-control form-control-sm @error('reverse_side_gives.'.$key.'.percentage_wear') is-invalid @enderror"
                       name="reverse_side_gives[{{$key}}][percentage_wear]"
                       id="reverse_side_gives[{{$key}}][percentage_wear]"
                       value="{{old('reverse_side_gives.'.$key.'.percentage_wear',$reserveSideGive->percentage_wear)}}"
                       aria-label="Процент износа на дату выдачи"/>
            </div>
        </td>
        <td data-id="reverse_side_gives_percentage_cost">
            <div class="form-group">
                <input type="text"
                       class="form-control form-control-sm @error('reverse_side_gives.'.$key.'.cost') is-invalid @enderror"
                       name="reverse_side_gives[{{$key}}][cost]"
                       id="reverse_side_gives[{{$key}}][cost]"
                       value="{{ old('reverse_side_gives.'.$key.'.cost', $reserveSideGive->cost) }}"
                       aria-label="Стоимость"
                       inputmode="decimal">
            </div>
        </td>
        <td data-id="reverse_side_gives_signature">
            <div class="form-group">
                <div class="d-flex justify-content-center align-items-center gap-2 mb-2">
                    @if($reserveSideGive->signature)
                        <a href="{{ asset('storage/' . $reserveSideGive->signature) }}"
                           class="btn btn-success btn-sm"
                           target="_blank">
                            <i class="bi bi-eye"></i>
                        </a>
                    @else
                        <button type="button"
                                class="btn btn-danger btn-sm"
                                disabled
                                title="Файла нет">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    @endif

                    <button type="button" class="btn btn-primary btn-sm upload-btn">
                        <i class="bi bi-upload"></i>
                    </button>
                    <input type="file"
                           name="reverse_side_gives[{{$key}}][signature]"
                           id="reverse_side_gives[{{$key}}][signature]"
                           style="display: none;">
                </div>
                <input type="hidden"
                       name="reverse_side_gives[{{$key}}][existing_signature]"
                       value="{{ $reserveSideGive->signature }}">

                <div class="d-flex justify-content-center">
                    <input type="text"
                           name="reverse_side_gives[{{$key}}][signature_note]"
                           class="form-control form-control-sm text-field"
                           value="{{ old('reverse_side_gives.'.$key.'.signature_note', $reserveSideGive->signature_note) }}">
                </div>
            </div>
        </td>
        <td style="display: none" data-id="reverse_side_returns_id">
            <input type="hidden"
                   class="form-control @error('reverse_side_returns.'.$key.'.id') is-invalid @enderror"
                   name="reverse_side_returns[{{$key}}][id]"
                   id="reverse_side_returns[{{$key}}][id]"
                   value="{{old('reverse_side_returns.'.$key.'.id',$reserveSideGive->reverseSideReturn->id)}}"/>
        </td>
        <td data-id="reverse_side_returns_date">
            <div class="form-group">
                <input type="date"
                       class="form-control form-control-sm @error('reverse_side_returns.'.$key.'.date') is-invalid @enderror"
                       name="reverse_side_returns[{{$key}}][date]"
                       id="reverse_side_returns[{{$key}}][date]"
                       value="{{old('reverse_side_returns.'.$key.'.date',$reserveSideGive->reverseSideReturn->date)}}"
                       aria-label="Дата выдачи"/>
            </div>
        </td>
        <td data-id="reverse_side_returns_quantity">
            <div class="form-group ">
                <input type="text"
                       class="form-control form-control-sm @error('reverse_side_returns.'.$key.'.quantity') is-invalid @enderror"
                       name="reverse_side_returns[{{$key}}][quantity]"
                       id="reverse_side_returns[{{$key}}][quantity]"
                       value="{{old('reverse_side_returns.'.$key.'.quantity',$reserveSideGive->reverseSideReturn->quantity)}}"
                       aria-label="Количество выданного"/>
            </div>
        </td>
        <td data-id="reverse_side_returns_percentage_wear">
            <div class="form-group">
                <input type="text"
                       class="form-control form-control-sm @error('reverse_side_returns.'.$key.'.percentage_wear') is-invalid @enderror"
                       name="reverse_side_returns[{{$key}}][percentage_wear]"
                       id="reverse_side_returns[{{$key}}][percentage_wear]"
                       value="{{old('reverse_side_returns.'.$key.'.percentage_wear',$reserveSideGive->reverseSideReturn->percentage_wear)}}"
                       aria-label="Процент износа на дату выдачи"/>
            </div>
        </td>
        <td data-id="reverse_side_returns_cost">
            <div class="form-group">
                <input type="text"
                       class="form-control form-control-sm @error('reverse_side_returns.'.$key.'.cost') is-invalid @enderror"
                       name="reverse_side_returns[{{$key}}][cost]"
                       id="reverse_side_returns[{{$key}}][cost]"
                       value="{{old('reverse_side_returns.'.$key.'.cost',$reserveSideGive->reverseSideReturn->cost)}}"
                       aria-label="Стоимость"/>
            </div>
        </td>
        <td data-id="reverse_side_returns_signatures">
            <div class="form-group">
                <div class="d-flex justify-content-center align-items-center gap-2 mb-2">
                    @if($reserveSideGive->reverseSideReturn->signatures)
                        <a href="{{ asset('storage/' . $reserveSideGive->reverseSideReturn->signatures) }}"
                           class="btn btn-success btn-sm"
                           target="_blank">
                            <i class="bi bi-eye"></i>
                        </a>
                    @else
                        <button type="button"
                                class="btn btn-danger btn-sm"
                                disabled
                                title="Файла нет">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    @endif

                    <button type="button" class="btn btn-primary btn-sm upload-btn">
                        <i class="bi bi-upload"></i>
                    </button>
                    <input type="file"
                           name="reverse_side_returns[{{$key}}][signatures]"
                           id="reverse_side_returns[{{$key}}][signatures]"
                           style="display: none;">
                </div>
                <input type="hidden"
                       name="reverse_side_returns[{{$key}}][existing_signatures]"
                       value="{{ $reserveSideGive->reverseSideReturn->signatures }}">
                <div class="d-flex justify-content-center">
                    <input type="text"
                           name="reverse_side_returns[{{$key}}][signatures_note]"
                           class="form-control form-control-sm text-field"
                           value="{{ old('reverse_side_returns.'.$key.'.signatures_note', $reserveSideGive->reverseSideReturn->signatures_note) }}">
                </div>
            </div>
        </td>
    </tr>
@endforeach

