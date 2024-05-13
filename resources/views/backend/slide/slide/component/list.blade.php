<div class="ibox">
    <div class="ibox-title">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <h5>Danh sách slide</h5>
            <button type="button" class="addSlide btn btn-primary">Thêm slide</button>
        </div>
    </div>
    @php
         $slides = old('slide', ($slideItem) ?? []);
         $i = 1;
    @endphp

    <div class="ibox-content">
        <div id="sortable" class="row slide-list sortui ui-sortable">
            <div class="text-danger slide-notification {{ (count($slides) > 0 ? 'hidden' : '') }}">Chưa có hình ảnh nào được chọn....</div>
            @if(is_array($slides) && count($slides))
            @foreach ($slides['image'] as $key => $val)
            @php
                $image = $val;
                $description = $slides['description'][$key];
                $canonical =  $slides['canonical'][$key];
                $name = $slides['name'][$key];
                $alt = $slides['alt'][$key];
            @endphp
            <div class="col-lg-12 ui-state-default">
                <div class="slide-item mb20">
                    <div class="row custom-row">
                        <div class="col-sm-3">
                            <span class="slide-image img-cover">
                                <img src="{{ $val }}" alt="">
                                <input type="hidden" name="slide[image][]" id="" value="{{ $val }}">
                                <span class="deleteSlide btn btn-danger"><i class="fa fa-trash"></i></span>
                            </span>
                        </div>
                        <div class="col-sm-9">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab_{{ $i }}">Thông tin
                                            chung</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab_{{ $i + 1 }}">SEO</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab_{{ $i }}" class="tab-pane active">
                                        <div class="panel-body">
                                            <label for="" class="control-label text-left">Mô tả <span
                                                    class="text-danger">(*)</span></label>
                                            <div class="form-row mb10">
                                                <textarea name="slide[description][]" class="form-control">{{ $description }}</textarea>
                                            </div>
                                            <div class="form-row custom-form-url">
                                                <input type="text" name="slide[canonical][]" value="{{ $canonical }}" placeholder="URL"
                                                    class="form-control ">
                                                <div class="overlay">
                                                    <div class="uk-flex uk-flex-middle">
                                                        <label for="input_{{ $key }}" class="control-label text-bold">Mở
                                                            trong tab mới</label>
                                                        <input type="checkbox" name="slide[window][]" value="_blank" {{ (isset($slides['window'][$key]) && $slides['window'][$key] == '_blank') ? 'checked' : '' }}
                                                            id="input_{{ $key }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab_{{ $i + 1 }}" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="form-row custom-form-url seo-slide">
                                                <label for="" class="control-label text-left">Tiêu đề
                                                    ảnh<span class="text-danger">(*)</span></label>
                                                <input type="text" name="slide[name][]"
                                                    placeholder="Nhập tiêu đề ảnh..." class="form-control" value="{{ $name }}">
                                            </div>
                                            <div class="form-row custom-form-url mt10 seo-slide">
                                                <label for="" class="control-label text-left">Mô tả
                                                    ảnh<span class="text-danger">(*)</span></label>
                                                <input type="text" name="slide[alt][]" placeholder="Nhập mô tả ảnh..."
                                                    class="form-control " value="{{ $alt }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>       
            @php
             $i += 2;
            @endphp                    
            @endforeach
            @endif
        </div>
    </div>
</div>