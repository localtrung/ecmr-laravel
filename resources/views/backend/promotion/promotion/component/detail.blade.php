<div class="ibox">
    <div class="ibox-title">
        <h5>cài đặt thông tin chi tiết khuyến mại</h5>
    </div>
    <div class="ibox-content">
        <div class="form-row">
            <div class="fix-label" for="">Chọn hình thức khuyến mại</div>
            <select name="method" class="setupSelect2 promotionMethod" id="">
                <option value="">[Chọn hình thức khuyến mại]</option>
                @foreach (__('module.promotion') as $key => $val)
                <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
            </select>
        </div>
        <div class="promotion-container">

        </div>
    </div>
</div>