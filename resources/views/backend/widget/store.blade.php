@include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])
@include('backend.dashboard.component.formError')
@php
$url = ($config['method'] == 'create') ? route('widget.store') : route('widget.update', $widget->id);
@endphp
<form action="{{ $url }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>thông tin widget</h5>
                    </div>
                    <div class="ibox-content custom-content">
                        @include('backend.dashboard.component.content', ['offTitle' => true, 'offContent' => true, 'model' => ($widget) ?? null])
                    </div>
                </div>
                @include('backend.dashboard.component.album', ['model' => ($widget) ?? null])
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>cấu hình nội dung widget</h5>
                    </div>
                    <div class="ibox-content module-list">
                        <div class="labelText">Chọn Module</div>
                        @foreach (__('module.model') as $key => $val)
                        <div class="model-item uk-flex uk-flex-middle">
                            <input 
                                type="radio" 
                                name="model" 
                                class="input-radio" 
                                id="{{ $key }}" 
                                value="{{ $key }}" 
                                {{ (old('model', ($widget->model) ?? null) == $key) ? 'checked' : '' }}>
                            <label for="{{ $key }}">{{ $val }}</label>
                        </div>
                        @endforeach

                        <div class="search-module-box">
                            <i class="fa fa-search"></i>
                            <input type="text" class="form-control search-model">
                            <div class="ajax-search-result">

                            </div>
                        </div>
                        @php
                            $modelItem = old('modelItem', ($widgetItem) ?? null);
                        @endphp
                        <div class="search-model-result">
                            @if(!is_null($modelItem) && count($modelItem) )
                            @foreach($modelItem['id'] as $key => $val)
                            <div class="search-result-item" id="model-{{ $val }}" data-modeId="{{ $val }}">
                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                    <div class="uk-flex uk-flex-middle">
                                        <span class="image img-cover">
                                            <img src="{{ $modelItem['image'][$key] }}" alt="">
                                        </span>
                                        <span class="name">{{ $modelItem['name'][$key] }}</span>
                                    </div>
                                    <div class="hidden">
                                        <input type="text" name="modelItem[id][]" value="{{ $val }}">
                                        <input type="text" name="modelItem[name][]" value="{{ $modelItem['name'][$key] }}">
                                        <input type="text" name="modelItem[image][]" value="{{ $modelItem['image'][$key] }}">
                                    </div>
                                    <div class="deleted">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M 4.9902344 3.9902344 A 1.0001 1.0001 0 0 0 4.2929688 5.7070312 L 10.585938 12 L 4.2929688 18.292969 A 1.0001 1.0001 0 1 0 5.7070312 19.707031 L 12 13.414062 L 18.292969 19.707031 A 1.0001 1.0001 0 1 0 19.707031 18.292969 L 13.414062 12 L 19.707031 5.7070312 A 1.0001 1.0001 0 0 0 18.980469 3.9902344 A 1.0001 1.0001 0 0 0 18.292969 4.2929688 L 12 10.585938 L 5.7070312 4.2929688 A 1.0001 1.0001 0 0 0 4.9902344 3.9902344 z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                @include('backend.widget.component.aside')
            </div>
        </div>

        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>