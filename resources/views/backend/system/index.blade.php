@include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['index']['title']])

@php
$url = (isset($config['method']) && $config['method'] == 'translate') ? route('system.save.translate', ['languageId' => $languageId]) : route('system.store');
@endphp


<form action="{{ $url }}" method="POST" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="uk-flex uk-flex-middle">
            @foreach($languages as $language)
            <a class="image img-cover system-flag"
                href="{{ route('system.translate', ['languageId' => $language->id]) }}">
                <img src="{{ $language->image }}" alt="">
            </a>
            @endforeach
        </div>

        @foreach ($systemConfig as $key => $val)
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">{{ $val['label'] }}</div>
                    <div class="panel-description">
                        {{ $val['description'] }}
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    @if(count($val['value']))
                    <div class="ibox-content">
                        @foreach($val['value'] as $keyVal => $item)

                        @php
                        $name = $key .'_'.$keyVal;
                        @endphp

                        <div class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="uk-flex uk-flex-space-between">
                                        <span>{{ $item['label'] }} </span>
                                        {!! renderSystemLink($item) !!}
                                        {!! renderSystemTilte($item) !!}
                                    </label>
                                    @switch($item['type'])
                                    @case('text')
                                    {!! renderSystemInput($name,$systems) !!}
                                    @break
                                    @case('images')
                                    {!! renderSystemImages($name,$systems) !!}
                                    @break
                                    @case('textarea')
                                    {!! renderSystemTextarea($name,$systems) !!}
                                    @break
                                    @case('select')
                                    {!! renderSystemSelect($item, $name,$systems) !!}
                                    @break
                                    @case('editor')
                                    {!! renderSystemEditor($name,$systems) !!}
                                    @break
                                    @endswitch
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>