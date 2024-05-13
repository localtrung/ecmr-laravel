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
                    <label for="" class="control-label text-left">Nguồn khách<span class="text-danger">(*)</span></label>
                    <input type="text" name="name" value="{{ old('name', ($source->name) ?? '' ) }}" class="form-control"
                        placeholder="" autocomplete="off">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-row">
                    <label for="" class="control-label text-left">Từ khóa<span class="text-danger">(*)</span></label>
                    <input type="text" name="keyword" value="{{ old('keyword', ($source->keyword) ?? '' ) }}"
                        class="form-control" placeholder="" autocomplete="off">
                </div>
            </div>
        </div>
    </div>
</div>
