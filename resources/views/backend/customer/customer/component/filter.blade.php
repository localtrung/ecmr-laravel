<form action="{{ route('customer.index') }}">
    <div class="filter-wrapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            @include('backend.dashboard.component.perpage')
            <div class="action">
                <div class="uk-flex uk-flex-middle">
                   @include('backend.dashboard.component.filterPublish')
                    <select name="customer_catalogue_id" class="form-control mr10 setupSelect2">
                        <option selected="selected">[Chọn nhóm khách hàng]</option>
                        @foreach ($customerCatalogue as $key => $val)                           
                        <option value="{{ $key }}">{{ $val -> name }}</option>
                        @endforeach
                    </select>
                    @include('backend.dashboard.component.keyword')
                    <a href="{{ route('customer.create') }}" class="btn btn-danger"><i class="fa fa-plus mr5"></i>Thêm mới thành viên</a>
                </div>
            </div>
        </div>
    </div>
</form>