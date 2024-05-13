<form action="{{ route('user.catalogue.index') }}">
    <div class="filter-wrapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            @include('backend.dashboard.component.perpage')
            <div class="action">
                <div class="uk-flex uk-flex-middle">
                    @include('backend.dashboard.component.filterPublish')
                    @include('backend.dashboard.component.keyword')
                    <div class="uk-flex uk-flex-middle">
                        <a href="{{ route('customer.catalogue.create') }}" class="btn btn-danger"><i class="fa fa-plus mr5"></i>Thêm mới nhóm khách hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>