<div class="ibox slide-setting slide-normal">
    <div class="ibox-title uk-flex uk-flex-middle uk-flex-space-between">
        <h5>Cài đặt cơ bản</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content">
        <div class="row mb15">
            <div class="col-lg-12 mb10">
                <div class="form-row">
                    <label for="" class="control-label text-left">Tên slide <span class="text-danger">(*)</span></label>
                    <input type="text" name="name" value="{{ old('name', ($slide->name) ?? '' ) }}" class="form-control"
                        placeholder="" autocomplete="off">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-row">
                    <label for="" class="control-label text-left">Từ khóa <span class="text-danger">(*)</span></label>
                    <input type="text" name="keyword" value="{{ old('keyword', ($slide->keyword) ?? '' ) }}"
                        class="form-control" placeholder="" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="slide-setting">
                    <div class="setting-item">
                        <div class="uk-flex uk-flex-middle">
                            <span class="setting-text">Chiều rộng</span>
                            <div class="setting-value">
                                <input type="text" name="setting[width]" value="{{ old('setting.width' ,($slide ->setting['width']) ?? null ) }}" class="form-control int">
                                <span class="px">px</span>
                            </div>
                        </div>
                    </div>
                    <div class="setting-item">
                        <div class="uk-flex uk-flex-middle">
                            <span class="setting-text">Chiều cao</span>
                            <div class="setting-value">
                                <input type="text" name="setting[height]" value="{{ old('setting.height',($slide ->setting['height']) ?? null) }}" class="form-control int">
                                <span class="px">px</span>
                            </div>
                        </div>
                    </div>
                    <div class="setting-item">
                        <div class="uk-flex uk-flex-middle">
                            <span class="setting-text">Hiệu ứng</span>
                            <div class="setting-value">
                                <select name="setting[animation]" id="" class="form-control setupSelect2">
                                    @foreach (__('module.effect') as $key => $val)
                                    <option {{ $key == old('setting.animation', ($slide->setting['animation']) ?? null ) ? 'selected' : '' }}
                                        value="{{ $key }}">{{ $val }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="setting-item">
                        <div class="uk-flex uk-flex-middle">
                            <span class="setting-text">Mũi tên</span>
                            <div class="setting-value">
                                <input 
                                    type="checkbox" 
                                    value="accept" 
                                    name="setting[arrow]" 
                                    class="form-control" 
                                    @if(!old() || old('setting.arrow', ($slide->setting['arrow']) ?? null) == 'accept')
                                    checked="checked"
                                    @endif
                                    >
                            </div>
                        </div>
                    </div>
                    <div class="setting-item">
                        <div class="uk-flex uk-flex-middle">
                            <span class="setting-text">Điều hướng</span>
                            <div class="setting-value">
                                @foreach(__('module.navigate') as $key => $val)
                                <div class="nav-setting-item uk-flex uk-flex-middle">
                                    <input type="radio" name="setting[navigate]" value="{{ $key }}"
                                        id="navigate_{{ $key }}" {{ old('setting[navigate]', (!old()) ? 'dots' : ($slide->setting['navigate']) ?? null ) === $key ? 'checked'
                                        : '' }}>
                                    <label for="navigate_{{ $key }}">{{ $val }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ibox slide-setting slide-advance">
    <div class="ibox-title uk-flex uk-flex-middle uk-flex-space-between">
        <h5>Cài đặt nâng cao</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content">
        <div class="setting-item">
            <div class="uk-flex uk-flex-middle">
                <span class="setting-text">Tự động chạy</span>
                <div class="setting-value">
                    <input 
                        type="checkbox" 
                        value="accept" 
                        name="setting[autoplay]" 
                        class="form-control"
                        @if(!old() || old('setting.autoplay', ($slide->setting['autoplay']) ?? null) == 'accept')
                        checked="checked"
                        @endif
                        >
                </div>
            </div>
        </div>
        <div class="setting-item">
            <div class="uk-flex uk-flex-middle">
                <span class="setting-text">Dừng khi di chuột</span>
                <div class="setting-value">
                    <input 
                        type="checkbox" 
                        value="accept" 
                        name="setting[pauseHover]" 
                        class="form-control"
                        @if(!old() || old('setting.pauseHover', ($slide->setting['pauseHover']) ?? null) == 'accept')
                        checked="checked"
                        @endif
                        >
                </div>
            </div>
        </div>
        <div class="setting-item">
            <div class="uk-flex uk-flex-middle">
                <span class="setting-text">Chuyển ảnh</span>
                <div class="setting-value">
                    <input 
                        type="text" 
                        value="{{ old('setting.animationDelay', ($slide->setting['animationDelay']) ?? null ) }}" 
                        name="setting[animationDelay]" 
                        class="form-control int">
                    <span class="ms">ms</span>

                </div>
            </div>
        </div>
        <div class="setting-item">
            <div class="uk-flex uk-flex-middle">
                <span class="setting-text">Tốc độ <br> Hiệu ứng</span>
                <div class="setting-value">
                    <input 
                        type="text" 
                        value="{{ old('setting.animationSpeed', ($slide->setting['animationSpeed']) ?? null )}}" 
                        name="setting[animationSpeed]" 
                        class="form-control int">
                    <span class="ms">ms</span>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="ibox short-code">
    <div class="ibox-title uk-flex uk-flex-middle uk-flex-space-between">
        <h5>Short Code</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content">
        <textarea name="short_code" class="form-control textarea">{{ old('short_code', ($slide->short_code) ?? null ) }}</textarea>
    </div>
</div>