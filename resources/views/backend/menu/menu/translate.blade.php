@php
$title = str_replace('{language}', $language->name, $config['seo']['translate']['title']).' '.
$menuCatalogue->name
@endphp
@include('backend.dashboard.component.breadcrumb', ['title' => $title])
<form action="{{ route('menu.translate.save', ['languageId' => $languageId]) }}" method="POST">
    @csrf
    <div class="warraper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-4">

                <div class="panel-title">Thông tin chung</div>
                <div class="panel-description">
                    <p>+ Hệ thống sẽ tự động lấy ra các bản dịch của Menu <span class="text-success">nếu có</span> </p>
                    <p>+ Cập nhật các thông tin về bản dịch cho các Menu của bạn phía bên phải</p>
                    <p><span class="text-danger">Lưu ý cập nhật đầy đủ thông tin</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-title">
                        <div class=" uk-flex uk-flex-middle uk-flex-space-between">
                            <h5>Danh sách bản dịch</h5>
                        </div>
                    </div>
                    <div class="ibox-content">
                        @if(count($menus))
                        @foreach($menus as $key => $val)
                        @php
                        $name = $val->languages->first()->pivot->name;
                        $canonical = $val->languages->first()->pivot->canonical;
                        @endphp
                        <div class="menu-translate-item">
                            <div class="row">
                                <div class="col-lg-12 mb10">
                                    <span class="text-danger text-bold">Menu: {{ $val->position }}</span>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <div class="uk-flex uk-flex-middle">
                                            <div class="menu-name">Tên Menu</div>
                                            <input type="text" value="{{ $name }}" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="uk-flex uk-flex-middle">
                                            <div class="menu-name">Đường dẫn</div>
                                            <input type="text" name="" value="{{ $canonical }}" class="form-control"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <div class="uk-flex uk-flex-middle">
                                            <input type="text" name="translate[name][]"
                                                value="{{ ($val->translate_name) ?? '' }}" class="form-control"
                                                placeholder="Nhập vào bản dịch của bạn...">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="uk-flex uk-flex-middle">
                                            <input type="text" name="translate[canonical][]"
                                                value="{{ ($val->translate_canonical) ?? '' }}" class="form-control"
                                                placeholder="Nhập vào bản dịch của bạn...">
                                            <input type="hidden" name="translate[id][]"
                                                value="{{ ($val->id) ?? '' }}" class="form-control"
                                                placeholder="Nhập vào bản dịch của bạn...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>