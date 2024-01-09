@extends('themes::layout')

@php
    $menu = \Ophim\Core\Models\Menu::getTree();
    $tops = Cache::remember('site.movies.tops', setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('hotest'));
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $sortKey, $alg, $limit, $template] = array_merge($list, ['Phim hot', '', 'type', 'series', 'view_total', 'desc', 4, 'top_thumb']);
                try {
                    $data[] = [
                        'label' => $label,
                        'template' => $template,
                        'data' => \Ophim\Core\Models\Movie::when($relation, function ($query) use ($relation, $field, $val) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where($field, $val);
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where($field, $val);
                            })
                            ->orderBy($sortKey, $alg)
                            ->limit($limit)
                            ->get(),
                    ];
                } catch (\Exception $e) {
                    # code
                }
            }
        }

        return $data;
    });
@endphp

@push('header')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/bptv/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/bptv/css/fonts.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/bptv/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/bptv/css/customyou
        .css') }}" />
    <script type="text/javascript">
        function hide_catfish() {
            var content = document.getElementById('catfish_content');
            var hide = document.getElementById('hide_catfish');
            if (content.style.display == "none") {
                content.style.display = "block";
                hide.innerHTML = '';
            } else {
                content.style.display = "none";
                hide.innerHTML = '';
            }
        }
    </script>
@endpush

@section('body')
    <div class="Tp-Wp" id="Tp-Wp">
        @include('themes::themebptv.inc.header')
        @if (get_theme_option('ads_header'))
            <div class="ad-container">
                {!! get_theme_option('ads_header') !!}
            </div>
        @endif
        <div class="Body Container">
            <div class="Content">
                <div class="content">
                    @yield('slider_recommended')
                    @yield('breadcrumb')
                    @yield('catalog_filter')
                    <div class="TpRwCont">
                        @yield('content')
                        @include('themes::themebptv.inc.aside')
                    </div>
                </div>
            </div>
        </div>
        @include('themes::themebptv.inc.footer')
    </div>
@endsection


@section('footer')
    @if (get_theme_option('ads_catfish'))
        <div id="catfish" style="width: 100%;position:fixed;bottom:0;left:0;z-index:222" class="mp-adz">
            <div style="margin:0 auto;text-align: center;overflow: visible;" id="container-ads">
                <div id="hide_catfish"><a
                        style="font-size:12px; font-weight:bold;background: #ff8a00; padding: 2px; color: #000;display: inline-block;padding: 3px 6px;color: #FFF;background-color: rgba(0,0,0,0.7);border: .1px solid #FFF;"
                        href="javascript:hide_catfish();">Đóng quảng cáo</a></div>
                <div id="catfish_content" style="z-index:999999;">
                    {!! get_theme_option('ads_catfish') !!}
                </div>
            </div>
        </div>
    @endif

    <script type="text/javascript">
        function JS_Load(u) {
            var d = document,
                p = d.getElementsByTagName('HEAD')[0],
                c = d.createElement('script');
            c.type = 'text/javascript';
            c.src = u;
            p.appendChild(c);
        }
    </script>
    <script type="text/javascript">
        JS_Load('/themes/bptv/js/default.include-footer.js');
    </script>

    <script type="text/javascript" src="{{ asset('/themes/bptv/js/jquery-2.1.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/themes/bptv/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/themes/bptv/js/fx/util.js') }}"></script>
    <script>
        jQuery(document).ready(function(t) {
            $(".AAIco-arrow_upward").click(function() {
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");
                return false;
            });
        })
    </script>
    <script type="text/javascript" src="{{ asset('/themes/bptv/js/bootstrap1.min.js') }}"></script>
    {!! setting('site_scripts_google_analytics') !!}
@endsection

@push('scripts')
@endpush
