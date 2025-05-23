@for($index = 0; $index < $count; $index++)
    <tr>
        <td>
            <button type="button" id="plusButton" class="btn btn-success btn-sm text-white mb-1">
                <i class="bi bi-plus"></i>
            </button>
            <button type="button" id="minusButton" class="btn btn-danger btn-sm text-white">
                <i class="bi bi-dash"></i>
            </button>
        </td>
        <td style="display: none" data-id="reverse_side_gives_id">
            <input type="hidden"
                   class="form-control @error('reverse_side_gives.'.$index.'.id') is-invalid @enderror"
                   name="reverse_side_gives[{{$index}}][id]"
                   id="reverse_side_gives[{{$index}}][id]"
                   value="{{ old('reverse_side_gives.'.$index.'.id') }}">
        </td>
        <td style="display: none" data-id="reverse_side_gives_sorting">
            <input type="hidden"
                   id="reverse_side_gives[{{$index}}][sorting]"
                   name="reverse_side_gives[{{$index}}][sorting]"
                   value="{{ old('reverse_side_gives.'.$index.'.sorting') }}">
        </td>
        <td data-id="reverse_side_gives_ppe_id">
            <div class="input-group">
                <select
                    class="form-select form-select-sm @error('reverse_side_gives.'.$index.'.ppe_id') is-invalid @enderror"
                    id="reverse_side_gives[{{$index}}][ppe_id]"
                    name="reverse_side_gives[{{$index}}][ppe_id]"
                    aria-label="Сиз_ид">
                    <option value="" data-classification="">-</option>
                    @foreach($standards as $key => $standard)
                        <option value="{{ $standard->ppe->id }}"
                                data-classification="{{ $standard->ppe->classification->title }}"
                            @selected(old('reverse_side_gives.'.$index.'.ppe_id') == $standard->ppe->id)>
                            {{ $standard->ppe->title }}
                        </option>
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
                       class="form-control form-control-sm @error('reverse_side_gives.'.$index.'.date') is-invalid @enderror"
                       name="reverse_side_gives[{{$index}}][date]"
                       id="reverse_side_gives[{{$index}}][date]"
                       value="{{ old('reverse_side_gives.'.$index.'.date') }}"
                       aria-label="Дата выдачи">
            </div>
        </td>
        <td data-id="reverse_side_gives_quantity">
            <div class="form-group">
                <input type="text"
                       class="form-control form-control-sm @error('reverse_side_gives.'.$index.'.quantity') is-invalid @enderror"
                       name="reverse_side_gives[{{$index}}][quantity]"
                       id="reverse_side_gives[{{$index}}][quantity]"
                       value="{{ old('reverse_side_gives.'.$index.'.quantity') }}"
                       aria-label="Количество выданного">
            </div>
        </td>
        <td data-id="reverse_side_gives_percentage_wear">
            <div class="form-group">
                <input type="text"
                       class="form-control form-control-sm @error('reverse_side_gives.'.$index.'.percentage_wear') is-invalid @enderror"
                       name="reverse_side_gives[{{$index}}][percentage_wear]"
                       id="reverse_side_gives[{{$index}}][percentage_wear]"
                       value="{{ old('reverse_side_gives.'.$index.'.percentage_wear') }}"
                       aria-label="Процент износа на дату выдачи">
            </div>
        </td>
        <td data-id="reverse_side_gives_percentage_cost">
            <div class="form-group">
                <input type="text"
                       class="form-control form-control-sm @error('reverse_side_gives.'.$index.'.cost') is-invalid @enderror"
                       name="reverse_side_gives[{{$index}}][cost]"
                       id="reverse_side_gives[{{$index}}][cost]"
                       value="{{ old('reverse_side_gives.'.$index.'.cost') }}"
                       aria-label="Стоимость">
            </div>
        </td>
        <td data-id="reverse_side_gives_signature">
            <div class="form-group">
                <div class="d-flex justify-content-center align-items-center gap-2 mb-2">
                    @if(old('reverse_side_gives.'.$index.'.existing_signature'))
                        <a href="{{ asset('storage/' . old('reverse_side_gives.'.$index.'.existing_signature')) }}"
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
                           name="reverse_side_gives[{{$index}}][signature]"
                           id="reverse_side_gives[{{$index}}][signature]"
                           style="display: none;"
                           accept="application/pdf">
                </div>
                <div class="d-flex justify-content-center">
                    <input type="text"
                           name="reverse_side_gives[{{$index}}][signature_note]"
                           class="form-control form-control-sm text-field"
                           value="{{ old('reverse_side_gives.'.$index.'.signature_note') }}"
                           aria-label="Заметка">
                </div>
            </div>
        </td>
        <td style="display: none" data-id="reverse_side_returns_id">
            <input type="hidden"
                   class="form-control @error('reverse_side_returns.'.$index.'.id') is-invalid @enderror"
                   name="reverse_side_returns[{{$index}}][id]"
                   id="reverse_side_returns[{{$index}}][id]"
                   value="{{ old('reverse_side_returns.'.$index.'.id') }}">
        </td>
        <td data-id="reverse_side_returns_date">
            <div class="form-group">
                <input type="date"
                       class="form-control form-control-sm @error('reverse_side_returns.'.$index.'.date') is-invalid @enderror"
                       name="reverse_side_returns[{{$index}}][date]"
                       id="reverse_side_returns[{{$index}}][date]"
                       value="{{ old('reverse_side_returns.'.$index.'.date') }}"
                       aria-label="Дата возврата">
            </div>
        </td>
        <td data-id="reverse_side_returns_quantity">
            <div class="form-group">
                <input type="text"
                       class="form-control form-control-sm @error('reverse_side_returns.'.$index.'.quantity') is-invalid @enderror"
                       name="reverse_side_returns[{{$index}}][quantity]"
                       id="reverse_side_returns[{{$index}}][quantity]"
                       value="{{ old('reverse_side_returns.'.$index.'.quantity') }}"
                       aria-label="Количество возвращенного">
            </div>
        </td>
        <td data-id="reverse_side_returns_percentage_wear">
            <div class="form-group">
                <input type="text"
                       class="form-control form-control-sm @error('reverse_side_returns.'.$index.'.percentage_wear') is-invalid @enderror"
                       name="reverse_side_returns[{{$index}}][percentage_wear]"
                       id="reverse_side_returns[{{$index}}][percentage_wear]"
                       value="{{ old('reverse_side_returns.'.$index.'.percentage_wear') }}"
                       aria-label="Процент износа на дату возврата">
            </div>
        </td>
        <td data-id="reverse_side_returns_cost">
            <div class="form-group">
                <input type="text"
                       class="form-control form-control-sm text-end mw-100 @error('reverse_side_returns.'.$index.'.cost') is-invalid @enderror"
                       name="reverse_side_returns[{{$index}}][cost]"
                       id="reverse_side_returns[{{$index}}][cost]"
                       value="{{ old('reverse_side_returns.'.$index.'.cost') }}"
                       aria-label="Стоимость">
            </div>
        </td>
        <td data-id="reverse_side_returns_signatures" colspan="2">
            <div class="form-group">
                <div class="d-flex justify-content-center align-items-center gap-2 mb-2">
                    @if(old('reverse_side_returns.'.$index.'.signatures'))
                        <a href="{{ asset('storage/' . old('reverse_side_returns.'.$index.'.existing_signatures')) }}"
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
                           style="display: none;"
                           accept="application/pdf">
                </div>
                <div class="d-flex justify-content-center">
                    <input type="text"
                           name="reverse_side_returns[{{$index}}][signatures_note]"
                           class="form-control form-control-sm text-field"
                           value="{{ old('reverse_side_returns.'.$index.'.signatures_note') }}"
                           aria-label="Заметка">
                </div>
            </div>
        </td>
    </tr>
@endfor
