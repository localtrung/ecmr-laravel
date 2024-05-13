<div class="row">
    <div class="col-lg-5">
        <div class="ibox">
            <div class="ibox-content">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Liên kết tự
                                    tạo</a>
                            </h5>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="panel-tilte">Tạo menu</div>
                                <div class="panel-description">
                                    <p>+ Cài đặt menu mà bạn muốn hiển thị.</p>
                                    <p><small class="text-danger">* Khi khởi tạo bạn phải chắc chắn rằng đường dẫn menu
                                            có hoạt động. Đường dẫn trên website được khởi tạo tại các module: Bài viết,
                                            sản phẩm,...</small></p>
                                    <p><small class="text-danger">* Tiêu đề đường dẫn không được bỏ trống.</small></p>
                                    <p><small class="text-danger">* Hệ thống chỉ hỗ trợ 5 cấp menu.</small></p>
                                    <a href="" class="btn btn-default add-menu m-b m-r right">Thêm đường dẫn</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach (__('module.model') as $key => $val)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" class="clollapse menu-module" data-parent="#accordion"
                                    data-model="{{ $key }}" href="#{{ $key }}">{{ $val }}</a>
                            </h4>
                        </div>
                        <div id="{{ $key }}" class="panel-collapse collapse {{ $key == 'PostCatalogue' ? 'in' : '' }}">
                            <div class="panel-body">
                                <form action="" method="get" data-model="{{ $key }}" class="searchModel">
                                    <div class="form-row">
                                        <input type="text" name="keyword" id="" class="form-control search-menu"
                                            placeholder="Nhập 2 ký tự để tìm kiếm..." autocomplete="off">
                                    </div>
                                </form>
                                <div class="menu-list mt20">

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="ibox">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-4">
                        <label for="">Tên menu</label>
                    </div>
                    <div class="col-lg-4">
                        <label for="">Đường dẫn</label>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Vị trí</label>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Xóa</label>
                    </div>
                </div>
                <div class="hr-line-dashed" style="margin: 10px 0;"></div>
                @php
                $menu = old('menu', ($menuList) ?? null)
                @endphp
                <div class="menu-wrapper">
                    <div class="notification text-center {{ (is_array($menu) && count($menu) ? 'none' : '' ) }} ">
                        <h4>Danh sách này chưa có đường dẫn nào</h4>
                        <p>Hãy nhấn vào <span class="text-blue"><strong>"Thêm đường dẫn"</strong></span> để bắt đầu
                            thêm.</p>
                    </div>
                    @if(is_array( $menu) && count ( $menu))
                    @foreach( $menu['name'] as $key => $val)
                    <div class="row mb10 menu-item">
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="menu[name][]" value="{{ $val }}">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="menu[canonical][]"
                                value="{{  $menu['canonical'][$key] }}">
                        </div>
                        <div class="col-lg-2">
                            <input type="text" class="form-control int text-right" name="menu[order][]"
                                value="{{  $menu['order'][$key] }}">
                        </div>
                        <div class="col-lg-2 text-center">
                            <div class="form-row text-center">
                                <a class="delete-menu">
                                    <i class="fa fa-minus"></i>
                                </a>
                            </div>
                        </div>
                        <input type="text" name="menu[id][]" value="{{ $menu['id'][$key] }}" class="hidden">
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>