<div class="col-lg-4">
    <div class="ibox">
        <div class="ibox-title">
            <h5>Thời gian áp dụng chương trình</h5>
        </div>
        <div class="ibox-content">
            <div class="form-row mb20">
                <label for="" class="control-label text-left">Ngày bắt đầu</label>
                <div class="form-date">
                    <input type="text" name="startDate" value="{{ old('startDate', isset($model) ? (convertDateTime($model->startDate)) : '' ) }}"
                        class="form-control datepicker" placeholder="Nhập vào ngày bắt đầu..." autocomplete="off">
                    <span><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="form-row mb20">
                <label for="" class="control-label text-left">Ngày kết thúc</label>
                <div class="form-date">
                    <input type="text" name="endDate" value="{{ old('endDate', isset($model) ? (convertDateTime($model->endDate)) : '' ) }}"
                        class="form-control datepicker" placeholder="Nhập vào ngày kết thúc..." autocomplete="off"
                        @if((old ('neverEndDate', ($model->neverEndDate ?? null)) == 'accept'))
                    disabled
                    @endif
                    >
                    <span><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="form-row">
                <div class="uk-flex uk-flex-middle">
                    <input type="checkbox" name="neverEndDate" value="accept" class="" id="neverEnd" @if((old
                        ('neverEndDate', ($model->neverEndDate ?? null)) ==
                    'accept'))
                    checked="checked"
                    @endif
                    >
                    <label class="fix-label ml5" for="neverEnd">Không có ngày kết thúc</label>
                </div>
            </div>
        </div>
    </div>
    <div class="ibox">
        <div class="ibox-title">
            <h5>Nguồn khách hàng áp dụng</h5>
        </div>
        @php
        $sourceStatus = old('source', ($model->discountInformation['source']['status']) ?? null)
        @endphp
        <div class="ibox-content">
            <div class="setting-value">
                <div class="nav-setting-item uk-flex uk-flex-middle">
                    <input type="radio" name="source" value="all" id="allSource" class="chooseSource" checked="" {{
                        (old('source', $model->discountInformation['source']['status'] ?? '') ==='all' ||
                    !old('source')) ? 'checked' : '' }}
                    >
                    <label class="fix-label ml5" for="allSource">Áp dụng cho toàn bộ nguồn khách
                        hàng</label>
                </div>
                <div class="nav-setting-item uk-flex uk-flex-middle">
                    <input type="radio" name="source" value="choose" id="chooseSource" class="chooseSource" {{
                        (old('source', $model->discountInformation['source']['status'] ?? '') ==='choose') ? 'checked' : '' }}
                    >
                    <label class="fix-label ml5" for="chooseSource">Chọn nguồn khách áp dụng</label>
                </div>
            </div>
            @if($sourceStatus)
            @php
            $sourceValue = old('sourceValue', ($model->discountInformation['source']['data']) ?? [])
            @endphp
            <div class="source-wrapper">
                <select name="sourceValue[]" class="multipleSelect2" multiple id="">
                    @foreach($sources as $key => $val)
                    <option value="{{ $val->id }}" {{ (in_array($val -> id, $sourceValue)) ? 'selected' : ''
                        }}
                        >{{ $val -> name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
        </div>
    </div>
    <div class="ibox">
        <div class="ibox-title">
            <h5>Đối tượng áp dụng</h5>
        </div>   
        <div class="ibox-content">
            <div class="setting-value">
                <div class="nav-setting-item uk-flex uk-flex-middle">
                    <input class="chosseApply" type="radio" name="applyStatus" value="all" id="allApply" checked {{
                        (old('applyStatus', $model->discountInformation['apply']['status'] ?? '') ==='all'
                    || !old('applyStatus')) ? 'checked' : '' }}
                    >
                    <label class="fix-label ml5" for="allApply">Áp dụng cho toàn bộ đối tượng</label>
                </div>
                <div class="nav-setting-item uk-flex uk-flex-middle">
                    <input class="chosseApply" type="radio" name="applyStatus" value="choose" id="chooseApply" 
                    {{ (old('applyStatus', $model->discountInformation['apply']['status'] ?? '') ==='choose') ? 'checked' : '' }}
                    >
                    <label class="fix-label ml5" for="chooseApply">Chọn nguồn khách áp dụng</label>
                </div>
            </div>
        </div>
        @php
        $applyStatus = old('applySatus', ($model->discountInformation['apply']['status']) ?? null);
        $applyValue = old('applyValue', ($model->discountInformation['apply']['data']) ?? [])
        @endphp
        @if($applyStatus)
        <div class="apply-wrapper">
            <select name="applyValue[]" class="multipleSelect2 conditionItem" multiple>
                @foreach(__('module.applyStatus') as $key => $val)
                <option value="{{ $val['id'] }}">{{ $val['name'] }}</option>
                @endforeach
            </select>
            <div class="wrapper-condition">

            </div>
        </div>
        @endif
    </div>
</div>

<input type="hidden" class="input-product-and-quantity" value="{{ json_encode(__('module.item')) }}">
<input type="hidden" class="applyStatusList" value="{{ json_encode(__('module.applyStatus')) }}">
<input type="hidden" class="conditionItemSelected" value="{{ json_encode($applyValue) }}">

@if(count($applyValue))
@foreach($applyValue as $key => $val)
<input 
    type="hidden" 
    class="condition_input_{{ $val }}" 
    value="{{ json_encode(old($val, ($model->discountInformation['apply']['condition'][$val]) ?? null)) }}"
>
@endforeach
@endif