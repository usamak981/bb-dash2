<div class="card">
    <div class="card-header">
        <h4 class="card-title">@lang('locale.Projekt')</h4>
        <div class="d-flex align-items-center align-content-center"><a href="#" class="delProject"><i class="fa fa-trash"></i></a></div>
    </div>
    <div class="card-body">
        <input type="hidden" name="projekt_id[]" value="{{ $projekt->id }}">
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="row bg-dark p-25 image-upload-div">
                    <div class="col-sm-9 p-25">
                        <img class="image-upload-lg" src="{{ App\Helpers\Helpers::getImageSrc($projekt->images->where('order',0)->first()?->web_path) }}">
                        <input type="file" accept="image/*" class="d-none" name="projekt_image[{{ $projekt->id }}][0]">
                    </div>
                    <div class="col-sm-3 p-25">
                        <div class="mb-50">
                            <img class="image-upload-sm" src="{{ App\Helpers\Helpers::getImageSrc($projekt->images->where('order',1)->first()?->web_path) }}">
                            <input type="file" accept="image/*" class="d-none" name="projekt_image[{{ $projekt->id }}][1]">
                        </div>
                        <div class="mb-50">
                            <img class="image-upload-sm" src="{{ App\Helpers\Helpers::getImageSrc($projekt->images->where('order',2)->first()?->web_path) }}">
                            <input type="file" accept="image/*" class="d-none" name="projekt_image[{{ $projekt->id }}][2]">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-12">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" >@lang('locale.Construction')</label>
                            <select
                                class="form-control"
                                name="construction[{{ $projekt->id }}]"
                            >
                                @foreach($projektConstructionTypes as $code =>  $name)
                                    <option {{ $projekt->construction == $code ? "selected" : "" }} value="{{ $code }}">@lang('locale.'.$name)</option>
                                @endforeach
                            </select>
                            @error('construction')
                            <div class="font-small-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" >@lang('locale.Competence')</label>
                            <select
                                class="form-control"
                                name="competence[{{ $projekt->id }}]"
                            >
                                @foreach($projektCompetenceTypes as $code =>  $name)
                                    <option {{ $projekt->competence == $code ? "selected" : "" }} value="{{ $code }}">@lang('locale.'.$name)</option>
                                @endforeach
                            </select>
                            @error('competence')
                            <div class="font-small-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label">@lang('locale.Project Type')</label>
                            <select
                                class="form-control"
                                name="projekt_type_code[{{ $projekt->id }}]"
                            >
                                @foreach($projektTypes as $code =>  $name)
                                    <option {{ $projekt->projekt_type_code == $code ? "selected" : "" }} value="{{ $code }}">@lang('locale.'.$name)</option>
                                @endforeach
                            </select>
                            @error('projekt_type_code')
                            <div class="font-small-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label">@lang('locale.No of Pools')</label>
                            <input
                                type="number"
                                class="form-control"
                                placeholder="@lang('locale.No of Pools')"
                                name="total_pools[{{ $projekt->id }}]"
                                value="{{ old('total_pools', $projekt->total_pools) }}"
                            />
                            @error('total_pools')
                            <div class="font-small-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="mb-1 ">
                            <label class="form-label d-block" >@lang('locale.Material')</label>
                            @foreach($projektMaterialTypes as $code =>  $name)
                                <div class="form-check form-check-inline">

                                    <label class="form-check-label">
                                        <input
                                            {{ $projekt->material == $code ? "checked" : "" }}
                                            type="radio"
                                            class="form-check-input"
                                            name="material[{{ $projekt->id }}]"
                                            value="{{$code}}"
                                        />
                                        @lang('locale.'.$name)</label>
                                </div>
                            @endforeach
                            @error('material')
                            <div class="font-small-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="mb-1 row">
                            <label class="form-label">@lang('locale.Depth') (m)</label>
                            <div class="col-5 p-0">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="depth_min[{{ $projekt->id }}]"
                                    placeholder="@lang('locale.Min')"
                                    value="{{ old('depth_min', $projekt->depth_min) }}"
                                />
                            </div>
                            <div class="col-2 text-center">-</div>
                            <div class="col-5 p-0">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="depth_max[{{ $projekt->id }}]"
                                    placeholder="@lang('locale.Max')"
                                    value="{{ old('depth_max', $projekt->depth_max) }}"
                                />
                            </div>
                            @error('depth_min')
                            <div class="font-small-2 text-danger">{{ $message }}</div>
                            @enderror
                            @error('depth_max')
                            <div class="font-small-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label">@lang('locale.Length')</label>
                            <input
                                type="number"
                                class="form-control"
                                placeholder="@lang('locale.Length')"
                                name="length[{{ $projekt->id }}]"
                                value="{{ old('length', $projekt->length) }}"
                            />
                            @error('length')
                            <div class="font-small-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label">@lang('locale.Width')</label>
                            <input
                                type="number"
                                class="form-control"
                                placeholder="@lang('locale.Width')"
                                name="width[{{ $projekt->id }}]"
                                value="{{ old('width', $projekt->width) }}"
                            />
                            @error('width')
                            <div class="font-small-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label">@lang('locale.Surface')</label>
                            <input
                                type="number"
                                class="form-control"
                                placeholder="@lang('locale.Surface')"
                                name="surface[{{ $projekt->id }}]"
                                value="{{ old('surface', $projekt->surface) }}"
                            />
                            @error('surface')
                            <div class="font-small-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <div class="mb-1 ">
                            <label class="form-label d-block" >@lang('locale.Sport Pool')</label>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input
                                        type="radio"
                                        class="form-check-input"
                                        name="sports_pool[{{ $projekt->id }}]"
                                        value="1"
                                        {{ $projekt->sports_pool == 1 ? "checked" : "" }}
                                    />
                                    @lang('locale.Yes')</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input
                                        type="radio"
                                        class="form-check-input"
                                        name="sports_pool[{{ $projekt->id }}]"
                                        value="0"
                                        {{ $projekt->sports_pool == 0 ? "checked" : "" }}
                                    />
                                    @lang('locale.No')</label>
                            </div>
                            @error('sports_pool')
                            <div class="font-small-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <div class="mb-1 ">
                            <label class="form-label d-block" >@lang('locale.Arge')</label>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input
                                        type="radio"
                                        class="form-check-input"
                                        name="arge[{{ $projekt->id }}]"
                                        value="1"
                                        {{ $projekt->arge == 1 ? "checked" : "" }}
                                    />
                                    @lang('locale.Yes')</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input
                                        type="radio"
                                        class="form-check-input"
                                        name="arge[{{ $projekt->id }}]"
                                        value="0"
                                        {{ $projekt->arge == 0 ? "checked" : "" }}
                                    />
                                    @lang('locale.No')</label>
                            </div>
                            @error('arge')
                            <div class="font-small-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <div class="mb-1 ">
                            <label class="form-label d-block" >@lang('locale.PPP')</label>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input
                                        type="radio"
                                        class="form-check-input"
                                        name="ppp[{{ $projekt->id }}]"
                                        value="1"
                                        {{ $projekt->ppp == 1 ? "checked" : "" }}
                                    />
                                    @lang('locale.Yes')</label>
                            </div>
                            <div class="form-check form-check-inline">

                                <label class="form-check-label">
                                    <input
                                        type="radio"
                                        class="form-check-input"
                                        name="ppp[{{ $projekt->id }}]"
                                        value="0"
                                        {{ $projekt->ppp == 0 ? "checked" : "" }}
                                    />
                                    @lang('locale.No')</label>
                            </div>
                            @error('sports_pool')
                            <div class="font-small-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 mb-1">
                        <label class="form-label">@lang('locale.Projekt Period')</label>
                        <input
                            type="text"
                            name="period[{{ $projekt->id }}]"
                            class="form-control flatpickr-range"
                            placeholder="MM-YY - MM-YY"
                            @php $date = $projekt->start_month . "." . $projekt->start_year . " - " . $projekt->end_month . "." . $projekt->end_year; @endphp
                            value="{{ $date }}" />
                    </div>

                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="note-column">@lang('locale.Internal notes (not visible)')</label>
                            <textarea
                                id="note-column"
                                class="form-control"
                                placeholder="@lang('locale.Internal notes (not visible)')"
                                name="projekt_note[{{ $projekt->id }}]"
                            >{{ old('note', $projekt->note) }}</textarea>
                            @error('note')
                            <div class="font-small-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
