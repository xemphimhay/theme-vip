@extends('themes::themebptv.layout')

@section('breadcrumb')
    <ol class="breadcrumb" itemScope itemType="https://schema.org/BreadcrumbList">
        <li itemProp="itemListElement" itemScope itemType="http://schema.org/ListItem">
            <a class="" itemProp="item" title="Xem Phim" href="/">
                <span class="" itemProp="name">
                    <i class="fa fa-home"></i> Trang chủ
                </span>
            </a>
            <meta itemProp="position" content="1" />
        </li>
        @foreach ($currentMovie->regions as $region)
            <li itemProp="itemListElement" itemScope="" itemType="http://schema.org/ListItem">
                <a class="" itemProp="item" href="{{ $region->getUrl() }}" title="{{ $region->name }}">
                    <span itemProp="name">
                        {{ $region->name }}
                    </span>
                </a>
                <meta itemProp="position" content="3" />
            </li>
        @endforeach
        @foreach ($currentMovie->categories as $category)
            <li itemProp="itemListElement" itemScope="" itemType="http://schema.org/ListItem">
                <a class="" itemProp="item" href="{{ $category->getUrl() }}" title="{{ $category->name }}">
                    <span itemProp="name">
                        {{ $category->name }}
                    </span>
                </a>
                <meta itemProp="position" content="3" />
            </li>
        @endforeach
        <li itemProp="itemListElement" itemScope="" itemType="http://schema.org/ListItem">
            <a class="" itemProp="item" href="{{ $currentMovie->getUrl() }}" title="{{ $currentMovie->name }}">
                <span itemProp="name">
                    {{ $currentMovie->name }}
                </span>
            </a>
            <meta itemProp="position" content="4" />
        </li>
        <li class="active" itemProp="itemListElement" itemScope="" itemType="http://schema.org/ListItem">
            <span itemProp="item">
                <span class="breadcrumb_last" itemProp="name">
                    Tập {{ $episode->name }}
                </span>
            </span>
            <meta itemProp="position" content="5" />
        </li>
    </ol>
@endsection

@section('content')
    <main>
        <article class="TPost Single">
            <header>
                <h1 class="Title">{{ $currentMovie->name }}</h1>
                <h2 class="SubTitle">{{ $currentMovie->origin_name }}</h2>
                <div class="Image">
                    <figure class="Objf">
                        <img width="180" height="260" src="{{ $currentMovie->getThumbUrl() }}"
                            class="attachment-img-mov-md size-img-mov-md wp-post-image"
                            alt="{{ $currentMovie->name }} - {{ $currentMovie->origin_name }}" />
                    </figure>

                    <ul class="ListPOpt">
                        <li>
                            <a title="Chia sẻ qua Facebook" rel="nofollow"
                                onclick="window.open ('http://www.facebook.com/share.php?u={{ $currentMovie->getUrl() }}&amp;title={{ $currentMovie->name }}', 'Facebook', 'toolbar=0, status=0, width=650, height=450');"
                                href="javascript: void(0);" class="Fcb fa-facebook"></a>
                        </li>
                        <li>
                            <a title="Chia sẻ qua Twitter" rel="nofollow"
                                onclick="window.open ('http://twitter.com/intent/tweet?status={{ $currentMovie->name }}+{{ $currentMovie->getUrl() }}', 'Twitter', 'toolbar=0, status=0, width=650, height=450');"
                                href="javascript: void(0);" class="Twt fa-twitter"></a>
                        </li>
                        <li>
                            <a title="Chia sẻ qua Google" rel="nofollow"
                                onclick="window.open ('https://plus.google.com/share?url={{ $currentMovie->getUrl() }}', 'Google', 'toolbar=0, status=0, width=650, height=450');"
                                href="javascript: void(0);" class="Ggl fa-google-plus"></a>
                        </li>
                    </ul>
                </div>
                <div class="Description">
                    @if ($currentMovie->content)
                        {!! $currentMovie->content !!}
                    @else
                        Đang cập nhật...
                    @endif
                </div>
            </header>
            <footer class="ClFx">
                <div class="VotesCn">
                    <div class="Prct">
                        <div id="TPVotes" data-percent="{{ $currentMovie->getRatingStar() }}">
                        </div>
                    </div>
                    <div class="post-ratings" itemscope itemtype="http://schema.org/Article">
                        <input id="hint_current" type="hidden" value="">
                        <input id="score_current" type="hidden" value="{{ $currentMovie->getRatingStar() }}">
                        <div id="star" data-score="{{ $currentMovie->getRatingStar() }}" style="cursor: pointer;">
                        </div>
                        <br />
                        (<strong class="num-rating">{{ $currentMovie->getRatingCount() }}</strong> lượt, đánh giá: <strong
                            id="average_score">{{ $currentMovie->getRatingStar() }}</strong>
                        trên 10)<br />
                        <span class="post-ratings-text" id="hint"></span>
                    </div>
                    <div style="display: none;" itemprop="aggregateRating" itemscope
                        itemtype="http://schema.org/AggregateRating">
                        <span itemprop="ratingValue">{{ $currentMovie->getRatingStar() }}</span>
                        <meta itemprop="ratingCount" content="{{ $currentMovie->getRatingCount() }}">
                        <meta itemprop="bestRating" content="10" />
                        <meta itemprop="worstRating" content="1" />
                    </div>
                </div>
                <p class="Info">
                    <span class="Time AAIco-access_time">{{ $currentMovie->episode_time ?? 'N/A' }}</span>
                    <span class="Date AAIco-date_range">{{ $currentMovie->publish_year }}</span>
                    <span class="View AAIco-remove_red_eye">{{ bptv_format_view($currentMovie->view_total) }} lượt
                        xem</span>
                </p>
            </footer>
            @if ($currentMovie->getPosterUrl())
                <div class="TPostBg Objf">
                    <img class="TPostBg" src="{{ $currentMovie->getPosterUrl() }}"
                        alt="{{ $currentMovie->name }} - {{ $currentMovie->origin_name }}">
                </div>
            @endif
        </article>

        <!--@if ($currentMovie->notify && $currentMovie->notify != '')
    -->
        <!--    <div class="watch-notice">-->
        <!--        <div class="box-content alerts">-->
        <!--            <div class="alert alert-danger">-->
        <!--                <strong>Thông báo: </strong>{{ strip_tags($currentMovie->notify) }}-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--
    @endif-->
        @if ($currentMovie->showtimes && $currentMovie->showtimes != '')
            <div class="watch-notice">
                <div class="box-content alerts">
                    <div class="alert alert-success">
                        <strong>Lịch chiếu: </strong>{{ strip_tags($currentMovie->showtimes) }}
                    </div>
                </div>
            </div>
        @endif

        <div id="watch-block">
            <style>
                .jwplayer.jw-flag-aspect-mode {
                    height: 100% !important;
                }
            </style>
            <div class="media-player uniad-player" id="media-player-box">
                <div id="media-player" style="width: 100%;height: 100%;background:#1D1D1D;text-align: center">
                    <center>
                        <img src="//animevietsub.io/statics/images/loading.heart.gif" class="post-ratings-image" />Đang
                        tải phim, vui lòng đợi trong giây lát..
                    </center>
                </div>
                <div id="player-loading" class="player-loading">
                    <div class="status"></div>
                </div>
                {{-- <div id="invideo_wrapper"
                    style="width: 300px; height: 250px; padding: 0px; border-radius: 5px; position: absolute; top: 50%; left: 50%; margin-left: -150px; margin-top: -175px; text-align: center; background: transparent;display:none">
                    <div style="width:100%">
                        <a href="https://www.i9bet162.com/Register?a=714234" target="_blank">
                            <img src="https://imgyn.imageshh.com/400x300.jpg" alt="onbet" width="300"
                                height="250">
                        </a>
                    </div>
                    <div id="close-and-play"
                        style="padding: 10px 0px; color: rgb(255, 255, 255); border: 1px solid rgb(255, 255, 255); font-size: 18px; width: 200px; margin: 20px -105px 0px; border-radius: 5px; cursor: pointer; position: absolute; top: 100%; left: 50%; background: rgb(53, 53, 53);">
                        Đóng và Xem Tiếp</div>
                </div> --}}
                <span class="AAIco-input btn-re-expand" id="btn-re-expand"></span>
            </div>
            <div class="MovieTabNav ControlPlayer">
                <div class="Lnk AAIco-lightbulb_outline" id="btn-light" title="Tắt đèn nền">Tắt đèn</div>
                <div class="Lnk AAIco-launch" id="btn-expand"><span id="expand-status">Phóng to</span></div>
                <div class="Lnk AAIco-error" id="btn-toggle-error" title="Báo lỗi cho admin!">Báo lỗi</div>
                <div class="Lnk AAIco-camera_enhance" id="btn-toggle-capture" title="Chụp ảnh">Chụp ảnh</div>
                <div class="Lnk AAIco-vertical_align_bottom" id="btn-toggle-download" title="Tải về">Tải về</div>
            </div>
        </div>
        <center>
            <div class="schedule-title-main">
                <ul>
                    <li>
                        <h3>Lưu ngay địa chỉ gg.gg/animesuborg để truy cập website nhanh nhất khi bị chặn</h3>
                    </li>
                    <li>
                        <h3>Server Vietsub #1: tốc độ load nhanh, có thể hỗ trợ chất lượng 1080p</h3>
                    </li>
                    <li>
                        <h3>Server Vietsub #2: hỗ trợ tốt nhất xem trên điện thoại</h3>
                    </li>
                </ul>
            </div>
        </center>



        <div id="change-server">
            <center>
                <ul class="server-list">
                    <li class="backup-server"> <span class="server-title">Đổi Sever</span>
                        <ul class="list-episode">
                            <li class="episode">
                                @foreach ($currentMovie->episodes->where('slug', $episode->slug)->where('server', $episode->server) as $server)
                                    <a data-id="{{ $server->id }}" data-link="{{ $server->link }}"
                                        data-type="{{ $server->type }}" onclick="chooseStreamingServer(this)"
                                        class="streaming-server btn-link-backup btn-episode black episode-link">VIP
                                        #{{ $loop->index + 1 }}</a>
                                @endforeach
                            </li>
                        </ul>
                    </li>
                    <input type="text" id="searchBox" placeholder="Tìm tập phim..."
                        style="
    background: 0 0;
    border: 1px solid #fff;
    height: 32px;
    width: 200px;
    padding: 5px;


">
                </ul>
            </center>
        </div>

        <div class="Wdgt list-server" id="list-server">
            @foreach ($currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server') as $server => $data)
                <div class="server clearfix server-group">
                    <h3 class="server-name"> {{ $server }} </h3>
                    <ul class="list-episode tab-pane">
                        @foreach ($data->sortBy('name', SORT_NATURAL)->groupBy('name') as $name => $item)
                            <li class="episode">
                                <a class="btn-episode episode-link btn3d black @if ($item->contains($episode)) active @endif"
                                    title="{{ $name }}"
                                    href="{{ $item->sortByDesc('type')->first()->getUrl() }}">{{ $name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
        <div class="watch-notice">
            <div class="box-content alerts">
                <div class="watch-notice">
                    <div class="box-content alerts">
                        <div class="alert alert-info">
                            <ul>
                                <li><span style="font-size:16px"><span style="color:#000000">Xem lịch chiếu những bộ anime
                                            khác&nbsp;</span><a href="/lich-chieu-phim.html"><strong>tại
                                                đây!!</strong></a></span></li>
                                <li><span style="color:#ff0033"><span style="font-size:16px">Click quảng cáo hoặc like,
                                            share Facebook giúp xem Anime mượt hơn!!</span></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="Wdgt">
            <div class="Title">Bình luận</div>
            <div style="width: 100%; background-color: #fff">
                <div class="fb-comments" data-href="{{ $currentMovie->getUrl() }}" data-width="100%"
                    data-colorscheme="light" data-numposts="5" data-order-by="reverse_time" data-lazy="true"></div>
            </div>
        </div>
        <div class="Wdgt">
            <div class="Title">Có thể bạn muốn xem?</div>
            <div class="MovieListRelated owl-carousel">
                @foreach ($movie_related as $movie)
                    <div class="TPostMv">
                        <div class="TPost B">
                            <a href="{{ $movie->getUrl() }}" title="{{ $movie->name }} ({{ $movie->publish_year }})">
                                <div class="Image">
                                    <figure class="Objf TpMvPlay AAIco-play_arrow"><img width="180" height="260"
                                            src="{{ $movie->getthumbUrl() }}"
                                            class="attachment-img-mov-md size-img-mov-md wp-post-image"
                                            alt="{{ $movie->name }} ({{ $movie->publish_year }})"></figure>
                                    <span class="mli-eps"><i>{{ $movie->episode_current }}</i></span>
                                    <div class="anime-extras">
                                        <div class="anime-avg-user-rating"
                                            title="{{ $movie->rating_star }} trong số {{ $movie->rating_count }} đánh giá"
                                            data-action="click->anime-card#showLibraryEditor"><i
                                                class="fa fa-star"></i>{{ $movie->rating_star }}
                                        </div>
                                    </div>
                                </div>
                                <div class="Title">{{ $movie->name }}</div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div id="mv-keywords">
            <strong class="mr10">Từ khóa: xem phim {{ $currentMovie->name }} </strong>
            @foreach ($currentMovie->tags as $tag)
                <a href="{{ $tag->getUrl() }}" rel="follow, index"
                    title="{{ $tag->name }}">{{ $tag->name }},</a>
            @endforeach
            Phim {{ $currentMovie->name }}, {{ $currentMovie->origin_name }}, Phim {{ $currentMovie->name }}
            {{ $currentMovie->episode_current }}, {{ $currentMovie->name }} fptplay, {{ $currentMovie->name }} tv360,
            {{ $currentMovie->name }} phimmoi, {{ $currentMovie->origin_name }} vuighe, {{ $currentMovie->origin_name }}
            animevietsub, {{ $currentMovie->name }} {{ $currentMovie->publish_year }}
        </div>
    </main>
@endsection

@push('scripts')
    <script src="/themes/bptv/player/js/p2p-media-loader-core.min.js"></script>
    <script src="/themes/bptv/player/js/p2p-media-loader-hlsjs.min.js"></script>

    <script src="/js/jwplayer-8.9.3.js"></script>
    <script src="/js/hls.min.js"></script>
    <script src="/js/jwplayer.hlsjs.min.js"></script>

    <script>
        $(document).ready(function() {
            $('html, body').animate({
                scrollTop: $('#media-player-box').offset().top
            }, 'slow');
        });
    </script>

    <script>
        var episode_id = {{ $episode->id }};
        const wrapper = document.getElementById('media-player');
        const vastAds = "{{ Setting::get('jwplayer_advertising_file') }}";

        function chooseStreamingServer(el) {
            const type = el.dataset.type;
            const link = el.dataset.link.replace(/^http:\/\//i, 'https://');
            const id = el.dataset.id;

            const newUrl =
                location.protocol +
                "//" +
                location.host +
                location.pathname.replace(`-${episode_id}`, `-${id}`);

            history.pushState({
                path: newUrl
            }, "", newUrl);
            episode_id = id;


            Array.from(document.getElementsByClassName('streaming-server')).forEach(server => {
                server.classList.remove('active');
            })
            el.classList.add('active');

            renderPlayer(type, link, id);
        }

        function renderPlayer(type, link, id) {
            if (type == 'embed') {
                if (vastAds) {
                    wrapper.innerHTML = `<div id="fake_jwplayer" style="height: 100%"></div>`;
                    const fake_player = jwplayer("fake_jwplayer");
                    const objSetupFake = {
                        key: "{{ Setting::get('jwplayer_license') }}",
                        aspectratio: "16:9",
                        width: "100%",
                        height: "100%",
                        file: "/themes/bptv/player/1s_blank.mp4",
                        volume: 100,
                        mute: false,
                        autostart: true,
                        advertising: {
                            tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                            client: "vast",
                            vpaidmode: "insecure",
                            skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 3 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                            skipmessage: "Bỏ qua sau xx giây",
                            skiptext: "Bỏ qua"
                        }
                    };
                    fake_player.setup(objSetupFake);
                    fake_player.on('complete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adSkipped', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adComplete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                } else {
                    if (wrapper) {
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                    }
                }
                return;
            }

            if (type == 'm3u8' || type == 'mp4') {
                wrapper.innerHTML = `<div id="jwplayer"></div>`;
                const player = jwplayer("jwplayer");
                const objSetup = {
                    key: "{{ Setting::get('jwplayer_license') }}",
                    aspectratio: "16:9",
                    width: "100%",
                    height: "100%",
                    image: "{{ $currentMovie->getPosterUrl() }}",
                    file: link,
                    aboutlink: "https://linktr.ee/animesuborg",
                    abouttext: "Cập nhật AnimeSub",
                    playbackRateControls: true,
                    playbackRates: [0.25, 0.75, 1, 1.25],
                    sharing: {
                        sites: [
                            "reddit",
                            "facebook",
                            "twitter",
                            "googleplus",
                            "email",
                            "linkedin",
                        ],
                    },
                    volume: 100,
                    mute: false,
                    autostart: true,
                    logo: {
                        file: "{{ Setting::get('jwplayer_logo_file') }}",
                        link: "{{ Setting::get('jwplayer_logo_link') }}",
                        position: "{{ Setting::get('jwplayer_logo_position') }}",
                    },
                    advertising: {
                        tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                        client: "vast",
                        vpaidmode: "insecure",
                        skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 3 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                        skipmessage: "Bỏ qua sau xx giây",
                        skiptext: "Bỏ qua"
                    }
                };

                if (type == 'm3u8') {
                    const segments_in_queue = 50;

                    var engine_config = {
                        debug: !1,
                        segments: {
                            forwardSegmentCount: 50,
                        },
                        loader: {
                            cachedSegmentExpiration: 864e5,
                            cachedSegmentsCount: 1e3,
                            requiredSegmentsPriority: segments_in_queue,
                            httpDownloadMaxPriority: 9,
                            httpDownloadProbability: 0.06,
                            httpDownloadProbabilityInterval: 1e3,
                            httpDownloadProbabilitySkipIfNoPeers: !0,
                            p2pDownloadMaxPriority: 50,
                            httpFailedSegmentTimeout: 500,
                            simultaneousP2PDownloads: 20,
                            simultaneousHttpDownloads: 2,
                            // httpDownloadInitialTimeout: 12e4,
                            // httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpDownloadInitialTimeout: 0,
                            httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpUseRanges: !0,
                            maxBufferLength: 300,
                            // useP2P: false,
                        },
                    };
                    if (Hls.isSupported() && p2pml.hlsjs.Engine.isSupported()) {
                        var engine = new p2pml.hlsjs.Engine(engine_config);
                        player.setup(objSetup);
                        jwplayer_hls_provider.attach();
                        p2pml.hlsjs.initJwPlayer(player, {
                            liveSyncDurationCount: segments_in_queue, // To have at least 7 segments in queue
                            maxBufferLength: 300,
                            loader: engine.createLoaderClass(),
                        });
                    } else {
                        player.setup(objSetup);
                    }
                } else {
                    player.setup(objSetup);
                }

                player.on("pause", function() {
                    jQuery("#invideo_wrapper").css({
                        "display": "block"
                    });

                    jQuery("#close-and-play").on("click", function() {
                        player.play(true);
                        jQuery("#invideo_wrapper").css({
                            "display": "none"
                        });
                    });
                });

                player.on("play", function() {
                    jQuery("#invideo_wrapper").css({
                        "display": "none"
                    });
                });
                player.addButton(
                    '<svg width="64px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#585656"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M19.6916 7.34849C19.4416 7.01849 18.9716 6.94849 18.6416 7.19849C18.3116 7.44849 18.2416 7.91849 18.4916 8.24849C19.5716 9.68849 20.1416 11.3685 20.1416 13.1085C20.1416 17.5985 16.4916 21.2485 12.0016 21.2485C7.51156 21.2485 3.86156 17.5985 3.86156 13.1085C3.86156 8.61849 7.51156 4.97849 12.0016 4.97849C12.5816 4.97849 13.1716 5.04849 13.8116 5.19849C13.8416 5.20849 13.8716 5.19849 13.9116 5.19849C13.9316 5.19849 13.9616 5.21849 13.9816 5.21849C14.0116 5.21849 14.0316 5.20849 14.0616 5.20849C14.1016 5.20849 14.1316 5.19849 14.1616 5.18849C14.2116 5.17849 14.2616 5.15849 14.3116 5.12849C14.3416 5.10849 14.3816 5.09849 14.4116 5.07849C14.4216 5.06849 14.4416 5.06849 14.4516 5.05849C14.4816 5.03849 14.4916 5.00849 14.5116 4.98849C14.5516 4.94849 14.5816 4.91849 14.6116 4.86849C14.6416 4.82849 14.6516 4.77849 14.6716 4.73849C14.6816 4.70849 14.7016 4.67849 14.7116 4.64849C14.7116 4.62849 14.7116 4.61849 14.7116 4.59849C14.7216 4.54849 14.7216 4.49849 14.7116 4.44849C14.7116 4.39849 14.7116 4.35849 14.7016 4.30849C14.6916 4.26849 14.6716 4.22849 14.6516 4.17849C14.6316 4.12849 14.6116 4.07849 14.5816 4.03849C14.5716 4.01849 14.5716 4.00849 14.5616 3.99849L12.5816 1.52849C12.3216 1.20849 11.8516 1.15849 11.5316 1.40849C11.2116 1.66849 11.1616 2.13849 11.4116 2.45849L12.2316 3.47849C12.1516 3.47849 12.0716 3.46849 11.9916 3.46849C6.68156 3.46849 2.35156 7.78849 2.35156 13.1085C2.35156 18.4285 6.67156 22.7485 11.9916 22.7485C17.3116 22.7485 21.6316 18.4285 21.6316 13.1085C21.6416 11.0385 20.9616 9.04849 19.6916 7.34849Z" fill="#ffffff"></path> <path d="M9.5415 16.6708C9.1315 16.6708 8.7915 16.3308 8.7915 15.9208V12.5308L8.6015 12.7508C8.3215 13.0608 7.8515 13.0808 7.5415 12.8108C7.2315 12.5308 7.2115 12.0608 7.4815 11.7508L8.9815 10.0808C9.1915 9.85081 9.5215 9.77081 9.8115 9.88081C10.1015 9.99081 10.2915 10.2708 10.2915 10.5808V15.9308C10.2915 16.3408 9.9615 16.6708 9.5415 16.6708Z" fill="#ffffff"></path> <path d="M14 16.6703C12.48 16.6703 11.25 15.4403 11.25 13.9203V12.5703C11.25 11.0503 12.48 9.82031 14 9.82031C15.52 9.82031 16.75 11.0503 16.75 12.5703V13.9203C16.75 15.4403 15.52 16.6703 14 16.6703ZM14 11.3303C13.31 11.3303 12.75 11.8903 12.75 12.5803V13.9303C12.75 14.6203 13.31 15.1803 14 15.1803C14.69 15.1803 15.25 14.6203 15.25 13.9303V12.5803C15.25 11.8903 14.69 11.3303 14 11.3303Z" fill="#ffffff"></path> </g></svg>',
                    "Forward 10 Seconds", () => player.seek(player.getPosition() + 10), "+10s");
                player.addButton(
                    '<svg width="64px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9.5415 16.6708C9.1315 16.6708 8.7915 16.3308 8.7915 15.9208V12.5308L8.6015 12.7508C8.3215 13.0608 7.8515 13.0808 7.5415 12.8108C7.2315 12.5308 7.2115 12.0608 7.4815 11.7508L8.9815 10.0808C9.1915 9.85081 9.5215 9.77081 9.8115 9.88081C10.1015 9.99081 10.2915 10.2708 10.2915 10.5808V15.9308C10.2915 16.3408 9.9615 16.6708 9.5415 16.6708Z" fill="#ffffff"></path> <path d="M12.0011 3.47974C11.9211 3.47974 11.8411 3.48974 11.7611 3.48974L12.5811 2.46974C12.8411 2.14974 12.7911 1.66974 12.4611 1.41974C12.1411 1.15974 11.6711 1.20974 11.4111 1.53974L9.44109 3.99974C9.43109 4.00974 9.43109 4.01974 9.42109 4.03974C9.39109 4.07974 9.37109 4.12974 9.35109 4.16974C9.33109 4.21974 9.31109 4.25974 9.30109 4.29974C9.29109 4.34974 9.29109 4.38974 9.29109 4.43974C9.29109 4.48974 9.29109 4.53974 9.29109 4.58974C9.29109 4.60974 9.29109 4.61974 9.29109 4.63974C9.30109 4.66974 9.32109 4.68974 9.33109 4.72974C9.35109 4.77974 9.36109 4.81974 9.39109 4.85974C9.42109 4.89974 9.45109 4.93974 9.49109 4.97974C9.51109 4.99974 9.53109 5.02974 9.55109 5.04974C9.56109 5.05974 9.58109 5.05974 9.59109 5.06974C9.62109 5.08974 9.65109 5.10974 9.69109 5.11974C9.74109 5.14974 9.79109 5.16974 9.84109 5.17974C9.88109 5.19974 9.91109 5.19974 9.95109 5.19974C9.98109 5.19974 10.0011 5.20974 10.0311 5.20974C10.0511 5.20974 10.0811 5.19974 10.1011 5.18974C10.1311 5.18974 10.1611 5.18974 10.2011 5.18974C10.8411 5.03974 11.4411 4.96974 12.0111 4.96974C16.5011 4.96974 20.1511 8.61974 20.1511 13.1097C20.1511 17.5997 16.5011 21.2497 12.0111 21.2497C7.52109 21.2497 3.87109 17.5997 3.87109 13.1097C3.87109 11.3697 4.44109 9.68974 5.52109 8.24974C5.77109 7.91974 5.70109 7.44974 5.37109 7.19974C5.04109 6.94974 4.57109 7.01974 4.32109 7.34974C3.04109 9.04974 2.37109 11.0397 2.37109 13.1097C2.37109 18.4197 6.69109 22.7497 12.0111 22.7497C17.3311 22.7497 21.6511 18.4297 21.6511 13.1097C21.6511 7.78974 17.3111 3.47974 12.0011 3.47974Z" fill="#ffffff"></path> <path d="M14 16.6703C12.48 16.6703 11.25 15.4403 11.25 13.9203V12.5703C11.25 11.0503 12.48 9.82031 14 9.82031C15.52 9.82031 16.75 11.0503 16.75 12.5703V13.9203C16.75 15.4403 15.52 16.6703 14 16.6703ZM14 11.3303C13.31 11.3303 12.75 11.8903 12.75 12.5803V13.9303C12.75 14.6203 13.31 15.1803 14 15.1803C14.69 15.1803 15.25 14.6203 15.25 13.9303V12.5803C15.25 11.8903 14.69 11.3303 14 11.3303Z" fill="#ffffff"></path> </g></svg>',
                    "Rewind 10 Seconds", () => player.seek(player.getPosition() - 10), "-10s");
                player.addButton(
                    '<svg width="64px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 5.5v13m-3.48-5.636-9.016 5.259A1 1 0 0 1 5 17.259V6.741a1 1 0 0 1 1.504-.864l9.015 5.26a1 1 0 0 1 0 1.727Z"></path> </g></svg>',
                    "SKIP/OP", () => player.seek(player.getPosition() + 90), "+90s");


                const resumeData = 'OPCMS-PlayerPosition-' + id;
                player.on('ready', function() {
                    if (typeof(Storage) !== 'undefined') {
                        if (localStorage[resumeData] == '' || localStorage[resumeData] == 'undefined') {
                            console.log("No cookie for position found");
                            var currentPosition = 0;
                        } else {
                            if (localStorage[resumeData] == "null") {
                                localStorage[resumeData] = 0;
                            } else {
                                var currentPosition = localStorage[resumeData];
                            }
                            console.log("Position cookie found: " + localStorage[resumeData]);
                        }
                        player.once('play', function() {
                            console.log('Checking position cookie!');
                            console.log(Math.abs(player.getDuration() - currentPosition));
                            if (currentPosition > 180 && Math.abs(player.getDuration() - currentPosition) >
                                5) {
                                player.seek(currentPosition);
                            }
                        });
                        window.onunload = function() {
                            localStorage[resumeData] = player.getPosition();
                        }
                    } else {
                        console.log('Your browser is too old!');
                    }
                });

                player.on('complete', function() {
                    if (typeof(Storage) !== 'undefined') {
                        localStorage.removeItem(resumeData);
                    } else {
                        console.log('Your browser is too old!');
                    }
                })

                function formatSeconds(seconds) {
                    var date = new Date(1970, 0, 1);
                    date.setSeconds(seconds);
                    return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
                }
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const episode = '{{ $episode->id }}';
            let playing = document.querySelector(`[data-id="${episode}"]`);
            if (playing) {
                playing.click();
                return;
            }

            const servers = document.getElementsByClassName('streaming-server');
            if (servers[0]) {
                servers[0].click();
            }
        });
    </script>

    <script type="text/javascript">
        var URL_POST_RATING = '{{ route('movie.rating', ['movie' => $currentMovie->slug]) }}';
        var URL_POST_REPORT_ERROR =
            '{{ route('episodes.report', ['movie' => $currentMovie->slug, 'episode' => $episode->slug, 'id' => $episode->id]) }}';
        var rated = false;
    </script>
    <script type="text/javascript" src="/themes/bptv/js/film.notiny.js"></script>
    <script type="text/javascript" src="/themes/bptv/js/jquery.raty.js"></script>
    <script type="text/javascript" src="/themes/bptv/js/film.rating.js"></script>
    <script type="text/javascript" src="/themes/bptv/js/watch.js"></script>

    {!! setting('site_scripts_facebook_sdk') !!}
@endpush
