<?php

namespace Ophim\ThemeBptv;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ThemeBptvServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupDefaultThemeCustomizer();
    }

    public function boot()
    {
        try {
            foreach (glob(__DIR__ . '/Helpers/*.php') as $filename) {
                require_once $filename;
            }
        } catch (\Exception $e) {
            //throw $e;
        }
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'themes');

        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('themes/bptv')
        ], 'bptv-assets');
    }

    protected function setupDefaultThemeCustomizer()
    {
        config(['themes' => array_merge(config('themes', []), [
            'bptv' => [
                'name' => 'AnimeSuborg',
                'author' => 'contact.animehay@gmail.com',
                'package_name' => 'ggg3/theme-bptv',
                'publishes' => ['bptv-assets'],
                'preview_image' => '',
                'options' => [
                    [
                        'name' => 'recommendations_limit',
                        'label' => 'Recommended movies limit',
                        'type' => 'number',
                        'value' => 10,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'per_page_limit',
                        'label' => 'Pages limit',
                        'type' => 'number',
                        'value' => 20,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'movie_related_limit',
                        'label' => 'Movies related limit',
                        'type' => 'number',
                        'value' => 10,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'latest',
                        'label' => 'Home Page',
                        'type' => 'code',
                        'hint' => 'display_label|relation|find_by_field|value|limit|show_more_url|show_template (slider_poster|section_thumb)',
                        'value' => "Phim chiếu rạp||is_shown_in_theater|1|6|/danh-sach/phim-bo|slider_poster\r\nPhim bộ mới||type|series|10|/danh-sach/phim-bo|section_thumb\r\nPhim lẻ mới||type|single|10|/danh-sach/phim-le|section_thumb",
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'hotest',
                        'label' => 'Danh sách hot',
                        'type' => 'code',
                        'hint' => 'Label|relation|find_by_field|value|sort_by_field|sort_algo|limit|show_template (top_text|top_thumb|top_poster)',
                        'value' => "Phim sắp chiếu||status|trailer|publish_year|desc|4|top_poster\r\nTop phim lẻ||type|single|view_total|desc|9|top_text\r\nTop phim bộ||type|series|view_total|desc|9|top_thumb",
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'additional_css',
                        'label' => 'Additional CSS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'body_attributes',
                        'label' => 'Body attributes',
                        'type' => 'text',
                        'value' => "class='home blog wp-custom-logo NoBrdRa' style='background-image: url(/themes/bptv/images/background.png);'",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'additional_header_js',
                        'label' => 'Header JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_body_js',
                        'label' => 'Body JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_footer_js',
                        'label' => 'Footer JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'footer',
                        'label' => 'Footer',
                        'type' => 'code',
                        'value' => <<<EOT
                        <footer class="Footer">
                            <div class="Container">
                                <div class="MnBrCn BgA">
                                    <div class="MnBr EcBgA">
                                        <div class="Container">
                                            <figure class="Logo">
                                                <a href="/" title="Xem anime online" rel="home">
                                                    <img src="https://cdn.animevietsub.io/data/logo/logoz.png" alt="logo"/>
                                                </a>
                                            </figure>
                                            <div class="Rght">
                                                <nav class="Menu">
                                                    <ul>
                                                        <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-490">
                                                            <a href="/">XEM PHIM</a>
                                                        </li>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-493">
                                                            <a href="/discord.html">Chat Anime/Discord</a>
                                                        </li>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-493">
                                                            <a href="/thuat-ngu.html">THUẬT NGỮ</a>
                                                        </li>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-493">
                                                            <a href="https://discord.com/invite/cFWrdat2rB">GROUP THẢO LUẬN</a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                                <ul class="ListSocial">
                                                    <li>
                                                        <a target="_blank" href="https://www.facebook.com/animehay.fanpage/" class="fa fa-facebook"></a>
                                                    </li>
                                                    <li>
                                                        <a target="_blank" href="https://t.me/+B-Vh8f4e55VhMzg1" class="fa fa-telegram"></a>
                                                    </li>
                                                    <li>
                                                        <a target="_blank" href="#" class="fa-twitter"></a>
                                                    </li>
                                                    <li>
                                                        <a target="_blank" href="#" class="fa-youtube-play"></a>
                                                    </li>
                                                    <li>
                                                        <a href="#Tp-Wp" class="Up AAIco-arrow_upward"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="WebDescription">
                                    <p>
                                        <a href="http://www.kanefusafs.net/" rel="dofollow" target="_blank" title="Kanefusa Fansub">Kanefusa Fansub </a>&nbsp;
                                        <a href="https://animesub.org/phim/dao-hai-tac-a1" target="_blank" title="One Piece - Đảo Hải Tặc" >One Piece, Vua Hải Tặc&nbsp;Đảo Hải Tặc</a>&nbsp;
                                        <a href="https://animesub.org/phim/tham-tu-lung-danh-conan-r3-a3" target="_blank" title="Thám Tử Lừng Danh Conan" >Thám Tử Lừng Danh Conan</a>&nbsp;
                                        <ahref="/quoc-gia/trung-quoc"target="_blank"title="Hoạt Hình Trung Quốc">Hoạt Hình Trung Quốc</a>
                                    </p>
                                </div>
                                <div class="WebDescription">Liên Hệ Quảng Cáo: <b>contact.animehay@gmail.com</b></div>
                                <p class="Copy">
                                    <a target="_blank" href="https://animesub.org">© Copyright 2024 AnimeVietSub.TV. All rights reserved.</a>
                                </p>
                            </div>
                        </footer>
                        EOT,
                        'tab' => 'Custom HTML'
                    ],
                    [
                        'name' => 'ads_header',
                        'label' => 'Ads header',
                        'type' => 'code',
                        'value' => <<<EOT
                        <a href="https://www.i9bet162.com/Register?a=714234"><img src="/ads/i9gif.gif" alt=""></a>
                        EOT,
                        'tab' => 'Ads'
                    ],
                    [
                        'name' => 'ads_catfish',
                        'label' => 'Ads catfish',
                        'type' => 'code',
                        'value' => <<<EOT
                        <a href="https://www.i9bet162.com/Register?a=714234"><img src="/ads/i9gif.gif" alt=""></a>
                        EOT,
                        'tab' => 'Ads'
                    ]
                ],
            ]
        ])]);
    }
}
