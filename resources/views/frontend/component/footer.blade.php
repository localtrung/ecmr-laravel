<footer class="footer">
    <div class="uk-container uk-container-center">
        <div class="footer-upper">
            <div class="uk-grid uk-grid-medium">
                <div class="uk-width-large-1-5">
                    <div class="footer-contact">
                        <a href="" class="image img-scaledown"><img
                                src="{{ $system['homepage_logo_footer'] }}"
                                alt=""></a>
                        <div class="footer-slogan">Awesome grocery store website template</div>
                        <div class="company-address">
                            <div class="address">{{ $system['contact_address'] }}</div>
                            <div class="phone">Hotline: {{ $system['contact_hotline'] }}</div>
                            <div class="email">Email: {{ $system['contact_email'] }}</div>
                            <div class="hour">Giờ làm việc: 08:30 - 17:30</div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-large-3-5">
                    @if(isset($menu['footer-menu']) && count($menu['footer-menu']))
                    <div class="footer-menu">
                        <div class="uk-grid uk-grid-medium">
                            @foreach ($menu['footer-menu'] as $key => $val)
                            @php
                            $name = $val['item']->languages->first()->pivot->name;
                            $canonical = write_url($val['item']->languages->first()->pivot->canonical, true, true);
                            @endphp
                            <div class="uk-width-large-1-4">
                                <div class="ft-menu">
                                    <div class="heading">{{ $name }}</div>
                                    @if(isset($val['children']) && count($val['children']))
                                    <ul class="uk-list uk-clearfix">
                                        @foreach($val['children'] as $children)
                                        @php
                                            $childName = $children['item']->languages->first()->pivot->name;
                                            $childCanonical = write_url($children['item']->languages->first()->pivot->canonical, true,
                                            true);
                                        @endphp
                                        <li><a href="{{ $childCanonical }}" title="{{ $childName }}">{{ $childName
                                                }}</a></li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                <div class="uk-width-large-1-5">
                    <div class="fanpage-facebook">
                        <div class="ft-menu">
                            <div class="heading">Fanpage Facebook</div>
                            <div class="fanpage">
                                <div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs=""
                                    data-width="" data-height="" data-small-header="false"
                                    data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                    <blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore">
                                        <a href="https://www.facebook.com/facebook">Facebook</a>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="uk-container uk-container-center">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <div class="copyright-text">{!! $system['homepage_copyright'] !!}</div>
                <div class="copyright-contact">
                    <div class="uk-flex uk-flex-middle">
                        <div class="phone-item">
                            <div class="p">Hotline:{{ $system['contact_hotline'] }}</div>
                            <div class="worktime">Làm việc: 8:00 - 22:00</div>
                        </div>
                        <div class="phone-item">
                            <div class="p">Support: {{ $system['contact_technical_phone'] }}</div>
                            <div class="worktime">Hỗ trợ 24/7</div>
                        </div>
                    </div>
                </div>
                <div class="social">
                    <div class="uk-flex uk-flex-middle">
                        <div class="span">Follow us:</div>
                        <div class="social-list">
                            @php
                                $social = ['facebook', 'instagram', 'twitter'];
                            @endphp
                            <div class="uk-flex uk-flex-middle">
                                @foreach($social as $key => $val)
                                <a target="_blank" href="{{ $system['social_'.$val] }}" class=""><i class="fa fa-{{ $val }}"></i></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>