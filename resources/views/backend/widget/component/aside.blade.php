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
                    <label for="" class="control-label text-left">Tên widget <span class="text-danger">(*)</span></label>
                    <input type="text" name="name" value="{{ old('name', ($widget->name) ?? '' ) }}" class="form-control"
                        placeholder="" autocomplete="off">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-row">
                    <label for="" class="control-label text-left">Từ khóa Widget<span class="text-danger">(*)</span></label>
                    <input type="text" name="keyword" value="{{ old('keyword', ($widget->keyword) ?? '' ) }}"
                        class="form-control" placeholder="" autocomplete="off">
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
        <textarea name="short_code" class="form-control textarea">{{ old('short_code', ($widget->short_code) ?? null ) }}</textarea>
    </div>
</div>