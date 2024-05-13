<div class="ibox">
    <div class="ibox-title">
        <h5>Thông tin chung</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            @if(!isset($offTitle))
            <div class="col-lg-6">
                <div class="form-row">
                    <label for="" class="control-label text-left">Tên chương trình<span
                            class="text-danger">(*)</span></label>
                    <input type="text" name="name" value="{{ old('name', ($model->name) ?? '' ) }}"
                        class="form-control" placeholder="Nhập vào tên chương trình..."
                        autocomplete="off">
                </div>
            </div>
            @endif
            <div class="col-lg-6">
                <div class="form-row">
                    <label for="" class="control-label text-left">Mã khuyến mại</label>
                    <input type="text" name="code" value="{{ old('code', ($model->code) ?? '' ) }}"
                        class="form-control" placeholder="Nếu mã khuyến mãi để trống hệ thống sẽ tự tạo" autocomplete="off">
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-row mt10">
                    <label for="" class="control-label text-left">Mô tả khuyến mại<span
                            class="text-danger">(*)</span></label>
                    <textarea name="description" placeholder="nhập vào mô tả khuyến mại..."
                        class="form-control form-textarea" style="height: 100px;">
                            {{ old('description', ($model->description) ?? '') }}
                        </textarea>
                </div>
            </div>
        </div>
    </div>
</div>