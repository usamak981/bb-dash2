<div id="newProjekt" class="d-none">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('locale.Projekt')</h4>
            <div class="d-flex align-items-center align-content-center"><a href="#" class="delProject"><i class="fa fa-trash"></i></a></div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="row bg-dark p-25 image-upload-div">
                        <div class="col-sm-9 p-25">
                            <img class="image-upload-lg" src="{{ asset('images/default/no-preview-available.png') }}">
                            <input type="file" accept="image/*" class="d-none" name="projekt_image">
                        </div>
                        <div class="col-sm-3 p-25">
                            <div class="mb-50">
                                <img class="image-upload-sm" src="{{ asset('images/default/no-preview-available.png') }}">
                                <input type="file" accept="image/*" class="d-none" name="projekt_image">
                            </div>
                            <div class="mb-50">
                                <img class="image-upload-sm" src="{{ asset('images/default/no-preview-available.png') }}">
                                <input type="file" accept="image/*" class="d-none" name="projekt_image">
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
                                    name="construction"
                                >
                                    @foreach($projektConstructionTypes as $code =>  $name)
                                        <option value="{{ $code }}">@lang('locale.'.$name)</option>
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
                                    name="competence"
                                >
                                    @foreach($projektCompetenceTypes as $code =>  $name)
                                        <option value="{{ $code }}">@lang('locale.'.$name)</option>
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
                                    name="projekt_type_code"
                                >
                                    @foreach($projektTypes as $code =>  $name)
                                        <option value="{{ $code }}">@lang('locale.'.$name)</option>
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
                                    name="total_pools"
                                    value="{{ old('total_pools') }}"
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
                                                {{ $loop->first ? "checked" : "" }}
                                                type="radio"
                                                class="form-check-input"
                                                name="material"
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
                                        name="depth_min"
                                        placeholder="@lang('locale.Min')"
                                        value="{{ old('depth_min') }}"
                                    />
                                </div>
                                <div class="col-2 text-center">-</div>
                                <div class="col-5 p-0">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="depth_max"
                                        placeholder="@lang('locale.Max')"
                                        value="{{ old('depth_max') }}"
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
                                    name="length"
                                    min="0"
                                    value="{{ old('length') }}"
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
                                    name="width"
                                    min="0"
                                    value="{{ old('width') }}"
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
                                    min="0"
                                    placeholder="@lang('locale.Surface')"
                                    name="surface"
                                    value="{{ old('surface') }}"
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
                                            name="sports_pool"
                                            value="1"
                                        />
                                        @lang('locale.Yes')</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input
                                            type="radio"
                                            class="form-check-input"
                                            name="sports_pool"
                                            value="0"
                                            checked
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
                                            name="arge"
                                            value="1"
                                        />
                                        @lang('locale.Yes')</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input
                                            type="radio"
                                            class="form-check-input"
                                            name="arge"
                                            value="0"
                                            checked
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
                                            name="ppp"
                                            value="1"
                                        />
                                        @lang('locale.Yes')</label>
                                </div>
                                <div class="form-check form-check-inline">

                                    <label class="form-check-label">
                                        <input
                                            type="radio"
                                            class="form-check-input"
                                            name="ppp"
                                            value="0"
                                            checked
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
                                name="period"
                                class="form-control flatpickr-range"
                                placeholder="MM-DD to MM-DD"
                                value=""
                            />
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="note-column">@lang('locale.Internal notes (not visible)')</label>
                                <textarea
                                    id="note-column"
                                    class="form-control"
                                    placeholder="@lang('locale.Internal notes (not visible)')"
                                    name="projekt_note"
                                ></textarea>
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
</div>
