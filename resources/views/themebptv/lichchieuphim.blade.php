@extends('themes::layout')
@php
    use Ophim\Core\Models\Movie;
    $lichchieuthuhai = Cache::remember('site.movies.lichchieuthuhai ', setting('site_cache_ttl', 5 * 60), function () {
        return Movie::where('ngaythuhai', true)
            ->limit(get_theme_option('recommendations_limit', 50))
            ->orderBy('updated_at', 'desc')
            ->get();
    });
    $lichchieuthuba = Cache::remember('site.movies.lichchieuthuba ', setting('site_cache_ttl', 5 * 60), function () {
        return Movie::where('ngaythuba', true)
            ->limit(get_theme_option('recommendations_limit', 50))
            ->orderBy('updated_at', 'desc')
            ->get();
    });
    $lichchieuthutu = Cache::remember('site.movies.lichchieuthutu ', setting('site_cache_ttl', 5 * 60), function () {
        return Movie::where('ngaythutu', true)
            ->limit(get_theme_option('recommendations_limit', 50))
            ->orderBy('updated_at', 'desc')
            ->get();
    });
    $lichchieuthunam = Cache::remember('site.movies.lichchieuthunam ', setting('site_cache_ttl', 5 * 60), function () {
        return Movie::where('ngaythunam', true)
            ->limit(get_theme_option('recommendations_limit', 50))
            ->orderBy('updated_at', 'desc')
            ->get();
    });
    $lichchieuthusau = Cache::remember('site.movies.lichchieuthusau ', setting('site_cache_ttl', 5 * 60), function () {
        return Movie::where('ngaythusau', true)
            ->limit(get_theme_option('recommendations_limit', 50))
            ->orderBy('updated_at', 'desc')
            ->get();
    });
    $lichchieuthubay = Cache::remember('site.movies.lichchieuthubay ', setting('site_cache_ttl', 5 * 60), function () {
        return Movie::where('ngaythubay', true)
            ->limit(get_theme_option('recommendations_limit', 50))
            ->orderBy('updated_at', 'desc')
            ->get();
    });
    $lichchieuchunhat = Cache::remember('site.movies.lichchieuchunhat ', setting('site_cache_ttl', 5 * 60), function () {
        return Movie::where('ngaychunhat', true)
            ->limit(get_theme_option('recommendations_limit', 50))
            ->orderBy('updated_at', 'desc')
            ->get();
    });
    $menu = \Ophim\Core\Models\Menu::getTree();
    $data = Cache::remember('site.movies.latest', setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('latest'));
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $limit, $link, $template] = array_merge($list, ['Phim mới cập nhật', '', 'type', 'series', 8, '/', 'section_thumb']);
                try {
                    $data[] = [
                        'label' => $label,
                        'template' => $template,
                        'data' => Movie::when($relation, function ($query) use ($relation, $field, $val) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where($field, $val);
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where($field, $val);
                            })
                            ->limit($limit)
                            ->orderBy('updated_at', 'desc')
                            ->get(),
                        'link' => $link ?: '#',
                    ];
                } catch (\Exception $e) {
                }
            }
        }
        return $data;
    });
@endphp
<!DOCTYPE html>
<html>

<head>
    <title>Lịch chiếu phim mới nhất tại AnimeVietsub</title>
    <meta name="description" content="Lịch chiếu phim/anime được cập nhật hàng ngày nhanh nhất tại AnimeVietsub" />
    <meta name="keywords" content="lich chieu anime, lich chieu anime cap nhat moi" />
    <meta itemprop="name" content="Lịch chiếu phim mới nhất tại AnimeVietsub" />
    <meta itemprop="description" content="Lịch chiếu phim/anime được cập nhật hàng ngày nhanh nhất tại AnimeVietsub" />
    <meta property="og:title" content="Lịch chiếu phim mới nhất tại AnimeVietsub" />
    <meta property="og:type" content="video.movie" />
    <meta property="og:description"
        content="Lịch chiếu phim/anime được cập nhật hàng ngày nhanh nhất tại AnimeVietsub" />
    <meta property="og:url" content="/lich-chieu-phim.html" />
    <link rel="canonical" href="/lich-chieu-phim.html" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
    <base href="/" />
    <meta name="robots" content="index,follow" />
    <meta name="revisit-after" content="1 days" />
    <meta name="ROBOTS" content="index,follow,noodp" />
    <meta name="googlebot" content="index,follow" />
    <meta name="BingBOT" content="index,follow" />
    <meta name="yahooBOT" content="index,follow" />
    <meta name="slurp" content="index,follow" />
    <meta name="msnbot" content="index,follow" />
    <meta name="language" content="Vietnamese, English" />
    <meta property="og:site_name" content="animevietsub.io" />
    <meta property="fb:app_id" content="1214104412028762" />
    <meta property="fb:pages" content="114595880190017" />
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    <link rel="preconnect" href="https://lh3.googleusercontent.com">
    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="preconnect" href="https://connect.facebook.net">
    <link rel="preconnect" href="https://static.xx.fbcdn.net">

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
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/bptv/css/custom.css') }}" />
</head>


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
                <div class="announcement"><span class="ann_title"><i class="fa-bullhorn"></i></span><span
                        class="ann_text">
                        <ul>
                            <li>
                                <p><span style="color:#f3dd3d"><span style="font-size:22px">Lưu hoặc nhớ ngay link rút
                                            gọn&nbsp;</span></span><span style="font-size:22px"><a
                                            href="https://bit.ly/animevietsubtv">bit.ly/animevietsubtv</a>&nbsp;<span
                                            style="color:#f3dd3d">để truy cập khi nhà mạng chặn!</span></span></p>
                            </li>
                            <li>
                                <p><span style="color:#f3dd3d"><span style="font-size:22px">Mời bạn tham gia
                                            Group&nbsp;&nbsp;</span></span><span style="font-size:22px"><a
                                            href="https://www.facebook.com/groups/fananimevietsub"><span
                                                style="color:#e62117">tại đây!</span></a>&nbsp;&nbsp;</span><span
                                        style="color:#f3dd3d"><span style="font-size:22px">hoặc tham gia Discord
                                        </span></span><span style="font-size:22px"><a
                                            href="https://bitly.com/discordAVS"><span style="color:#e62117">tại
                                                đây!</span></a>&nbsp;<span style="color:#f3dd3d">để ủng hộ </span><span
                                            style="color:#e62117">AnimeVietsub</span></span></p>
                            </li>
                            <li>
                                <p><span style="color:#f3dd3d"><span style="font-size:22px">Do thiếu hút kinh phí nên
                                            quảng cáo có thể gây khó chịu, rất mong các bạn thông cảm!</span></span></p>
                            </li>
                        </ul>
                    </span>
                </div>
                <ol class="breadcrumb">
                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a
                            itemprop="item" title="Trang chủ" href="/"><span itemprop="name">Trang chủ</span>
                            <meta itemprop="position" content="1">
                        </a></li>
                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a
                            itemprop="item" title="Lịch Chiếu Anime" href="/lich-chieu-phim.html"><span
                                itemprop="name">Lịch Chiếu
                                Anime</span>
                            <meta itemprop="position" content="2">
                        </a></li>
                </ol>
                <div class="TpRwCont">
                    <div class="schedule-title-main"> <strong>Lưu ý:</strong> Lịch chiếu phim bên dưới chỉ mang tính
                        chất tương đối, đây là thời gian ra tập phim Raw bên nhật, thời gian ra vietsub phụ thuộc vào
                        nhóm dịch, có thể chỉ sau vài giờ hoặc vài ngày thậm chí vài năm nếu phim đó không ai dịch, mong
                        các bạn không phàn nàn và thắc mắc </div>
                    <div class="col-sm-12">
                        @if (count($lichchieuthuhai))
                            <section class="Homeschedule">
                                <div class="Top">
                                    <h1><b>Thứ Hai</b></h1>
                                </div>
                                <ul class="MovieList Rows AX A06 B04 C03 E011">
                                    @foreach ($lichchieuthuhai ?? [] as $movie)
                                        <li class="TPostMv">
                                            <article id="post-5175"
                                                class="TPost C post-5175 post type-post status-publish format-standard has-post-thumbnail hentry">
                                                <a href="{{ $movie->getUrl() }}">
                                                    <div class="Image">
                                                        <figure class="Objf TpMvPlay AAIco-play_arrow"><img
                                                                width="215" height="320"
                                                                src="{{ $movie->getThumbUrl() }}"
                                                                class="attachment-thumbnail size-thumbnail wp-post-image"
                                                                alt="{{ $movie->name }} - {{ $movie->origin_name }} ({{ $movie->publish_year }})"
                                                                title="{{ $movie->name }} ({{ $movie->publish_year }})">
                                                        </figure>
                                                        <span class="mli-timeschedule"
                                                            data-timer_second="58715"></span>
                                                        <span class="b">{{ $movie->giochieu }}</span>
                                                    </div>
                                                    <h2 class="Title">{{ $movie->name }}
                                                    </h2> <span class="Year">{{ $movie->origin_name }}</span>
                                                </a>
                                                <div class="TPMvCn anmt">
                                                    <div class="Title">{{ $movie->name }}
                                                    </div>
                                                    <p class="Info"> <span
                                                            class="Vote AAIco-star">{{ $movie->rating_star }}</span>
                                                        <span
                                                            class="Time AAIco-access_time">{{ $movie->episode_current }}/{{ $movie->episode_total }}</span>
                                                        <span
                                                            class="Date AAIco-date_range">{{ $movie->publish_year }}</span>
                                                    </p>
                                                    <div class="Description">
                                                        <p>{!! mb_substr(strip_tags($movie->content), 0, 142, 'utf-8') !!}...</p>
                                                        <p class="Director AAIco-videocam">
                                                            <span>Đạo diễn:</span>
                                                            {!! $movie->directors->map(function ($director) {
                                                                    return '<a href="' . $director->getUrl() . '" title="' . $director->name . '">' . $director->name . '</a>';
                                                                })->implode(', ') !!}
                                                            <i class="Button STPa AAIco-more_horiz"></i>
                                                        </p>
                                                        <p class="Actors AAIco-person">
                                                            <span>Diễn viên:</span>
                                                            {!! $movie->actors->map(function ($actor) {
                                                                    return '<a href="' . $actor->getUrl() . '" title="' . $actor->name . '">' . $actor->name . '</a>';
                                                                })->implode(', ') !!}
                                                            <i class="Button STPa AAIco-more_horiz"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </article>
                                        </li>
                                    @endforeach
                                </ul>
                            </section>
                        @endif
                        @if (count($lichchieuthuba))
                            <section class="Homeschedule">
                                <div class="Top">
                                    <h1><b>Thứ Ba</b></h1>
                                </div>
                                <ul class="MovieList Rows AX A06 B04 C03 E011">
                                    @foreach ($lichchieuthuba ?? [] as $movie)
                                        <li class="TPostMv">
                                            <article id="post-5175"
                                                class="TPost C post-5175 post type-post status-publish format-standard has-post-thumbnail hentry">
                                                <a href="{{ $movie->getUrl() }}">
                                                    <div class="Image">
                                                        <figure class="Objf TpMvPlay AAIco-play_arrow"><img
                                                                width="215" height="320"
                                                                src="{{ $movie->getThumbUrl() }}"
                                                                class="attachment-thumbnail size-thumbnail wp-post-image"
                                                                alt="{{ $movie->name }} - {{ $movie->origin_name }} ({{ $movie->publish_year }})"
                                                                title="{{ $movie->name }} ({{ $movie->publish_year }})">
                                                        </figure>
                                                        <span class="mli-timeschedule"
                                                            data-timer_second="58715"></span>
                                                        <span class="b">{{ $movie->giochieu }}</span>
                                                    </div>
                                                    <h2 class="Title">{{ $movie->name }}
                                                    </h2> <span class="Year">{{ $movie->origin_name }}</span>
                                                </a>
                                                <div class="TPMvCn anmt">
                                                    <div class="Title">{{ $movie->name }}
                                                    </div>
                                                    <p class="Info"> <span
                                                            class="Vote AAIco-star">{{ $movie->rating_star }}</span>
                                                        <span
                                                            class="Time AAIco-access_time">{{ $movie->episode_current }}/{{ $movie->episode_total }}</span>
                                                        <span
                                                            class="Date AAIco-date_range">{{ $movie->publish_year }}</span>
                                                    </p>
                                                    <div class="Description">
                                                        <p>{!! mb_substr(strip_tags($movie->content), 0, 142, 'utf-8') !!}...</p>
                                                        <p class="Director AAIco-videocam">
                                                            <span>Đạo diễn:</span>
                                                            {!! $movie->directors->map(function ($director) {
                                                                    return '<a href="' . $director->getUrl() . '" title="' . $director->name . '">' . $director->name . '</a>';
                                                                })->implode(', ') !!}
                                                            <i class="Button STPa AAIco-more_horiz"></i>
                                                        </p>
                                                        <p class="Actors AAIco-person">
                                                            <span>Diễn viên:</span>
                                                            {!! $movie->actors->map(function ($actor) {
                                                                    return '<a href="' . $actor->getUrl() . '" title="' . $actor->name . '">' . $actor->name . '</a>';
                                                                })->implode(', ') !!}
                                                            <i class="Button STPa AAIco-more_horiz"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </article>
                                        </li>
                                    @endforeach
                                </ul>
                            </section>
                        @endif
                        @if (count($lichchieuthutu))
                            <section class="Homeschedule">
                                <div class="Top">
                                    <h1><b>Thứ Tư</b></h1>
                                </div>
                                <ul class="MovieList Rows AX A06 B04 C03 E011">
                                    @foreach ($lichchieuthutu ?? [] as $movie)
                                        <li class="TPostMv">
                                            <article id="post-5175"
                                                class="TPost C post-5175 post type-post status-publish format-standard has-post-thumbnail hentry">
                                                <a href="{{ $movie->getUrl() }}">
                                                    <div class="Image">
                                                        <figure class="Objf TpMvPlay AAIco-play_arrow"><img
                                                                width="215" height="320"
                                                                src="{{ $movie->getThumbUrl() }}"
                                                                class="attachment-thumbnail size-thumbnail wp-post-image"
                                                                alt="{{ $movie->name }} - {{ $movie->origin_name }} ({{ $movie->publish_year }})"
                                                                title="{{ $movie->name }} ({{ $movie->publish_year }})">
                                                        </figure>
                                                        <span class="mli-timeschedule"
                                                            data-timer_second="58715"></span>
                                                        <span class="b">{{ $movie->giochieu }}</span>
                                                    </div>
                                                    <h2 class="Title">{{ $movie->name }}
                                                    </h2> <span class="Year">{{ $movie->origin_name }}</span>
                                                </a>
                                                <div class="TPMvCn anmt">
                                                    <div class="Title">{{ $movie->name }}
                                                    </div>
                                                    <p class="Info"> <span
                                                            class="Vote AAIco-star">{{ $movie->rating_star }}</span>
                                                        <span
                                                            class="Time AAIco-access_time">{{ $movie->episode_current }}/{{ $movie->episode_total }}</span>
                                                        <span
                                                            class="Date AAIco-date_range">{{ $movie->publish_year }}</span>
                                                    </p>
                                                    <div class="Description">
                                                        <p>{!! mb_substr(strip_tags($movie->content), 0, 142, 'utf-8') !!}...</p>
                                                        <p class="Director AAIco-videocam">
                                                            <span>Đạo diễn:</span>
                                                            {!! $movie->directors->map(function ($director) {
                                                                    return '<a href="' . $director->getUrl() . '" title="' . $director->name . '">' . $director->name . '</a>';
                                                                })->implode(', ') !!}
                                                            <i class="Button STPa AAIco-more_horiz"></i>
                                                        </p>
                                                        <p class="Actors AAIco-person">
                                                            <span>Diễn viên:</span>
                                                            {!! $movie->actors->map(function ($actor) {
                                                                    return '<a href="' . $actor->getUrl() . '" title="' . $actor->name . '">' . $actor->name . '</a>';
                                                                })->implode(', ') !!}
                                                            <i class="Button STPa AAIco-more_horiz"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </article>
                                        </li>
                                    @endforeach
                                </ul>
                            </section>
                        @endif
                        @if (count($lichchieuthunam))
                            <section class="Homeschedule">
                                <div class="Top">
                                    <h1><b>Thứ Năm</b></h1>
                                </div>
                                <ul class="MovieList Rows AX A06 B04 C03 E011">
                                    @foreach ($lichchieuthunam ?? [] as $movie)
                                        <li class="TPostMv">
                                            <article id="post-5175"
                                                class="TPost C post-5175 post type-post status-publish format-standard has-post-thumbnail hentry">
                                                <a href="{{ $movie->getUrl() }}">
                                                    <div class="Image">
                                                        <figure class="Objf TpMvPlay AAIco-play_arrow"><img
                                                                width="215" height="320"
                                                                src="{{ $movie->getThumbUrl() }}"
                                                                class="attachment-thumbnail size-thumbnail wp-post-image"
                                                                alt="{{ $movie->name }} - {{ $movie->origin_name }} ({{ $movie->publish_year }})"
                                                                title="{{ $movie->name }} ({{ $movie->publish_year }})">
                                                        </figure>
                                                        <span class="mli-timeschedule"
                                                            data-timer_second="58715"></span>
                                                        <span class="b">{{ $movie->giochieu }}</span>
                                                    </div>
                                                    <h2 class="Title">{{ $movie->name }}
                                                    </h2> <span class="Year">{{ $movie->origin_name }}</span>
                                                </a>
                                                <div class="TPMvCn anmt">
                                                    <div class="Title">{{ $movie->name }}
                                                    </div>
                                                    <p class="Info"> <span
                                                            class="Vote AAIco-star">{{ $movie->rating_star }}</span>
                                                        <span
                                                            class="Time AAIco-access_time">{{ $movie->episode_current }}/{{ $movie->episode_total }}</span>
                                                        <span
                                                            class="Date AAIco-date_range">{{ $movie->publish_year }}</span>
                                                    </p>
                                                    <div class="Description">
                                                        <p>{!! mb_substr(strip_tags($movie->content), 0, 142, 'utf-8') !!}...</p>
                                                        <p class="Director AAIco-videocam">
                                                            <span>Đạo diễn:</span>
                                                            {!! $movie->directors->map(function ($director) {
                                                                    return '<a href="' . $director->getUrl() . '" title="' . $director->name . '">' . $director->name . '</a>';
                                                                })->implode(', ') !!}
                                                            <i class="Button STPa AAIco-more_horiz"></i>
                                                        </p>
                                                        <p class="Actors AAIco-person">
                                                            <span>Diễn viên:</span>
                                                            {!! $movie->actors->map(function ($actor) {
                                                                    return '<a href="' . $actor->getUrl() . '" title="' . $actor->name . '">' . $actor->name . '</a>';
                                                                })->implode(', ') !!}
                                                            <i class="Button STPa AAIco-more_horiz"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </article>
                                        </li>
                                    @endforeach
                                </ul>
                            </section>
                        @endif
                        @if (count($lichchieuthusau))
                            <section class="Homeschedule">
                                <div class="Top">
                                    <h1><b>Thứ Sáu</b></h1>
                                </div>
                                <ul class="MovieList Rows AX A06 B04 C03 E011">
                                    @foreach ($lichchieuthusau ?? [] as $movie)
                                        <li class="TPostMv">
                                            <article id="post-5175"
                                                class="TPost C post-5175 post type-post status-publish format-standard has-post-thumbnail hentry">
                                                <a href="{{ $movie->getUrl() }}">
                                                    <div class="Image">
                                                        <figure class="Objf TpMvPlay AAIco-play_arrow"><img
                                                                width="215" height="320"
                                                                src="{{ $movie->getThumbUrl() }}"
                                                                class="attachment-thumbnail size-thumbnail wp-post-image"
                                                                alt="{{ $movie->name }} - {{ $movie->origin_name }} ({{ $movie->publish_year }})"
                                                                title="{{ $movie->name }} ({{ $movie->publish_year }})">
                                                        </figure>
                                                        <span class="mli-timeschedule"
                                                            data-timer_second="58715"></span>
                                                        <span class="b">{{ $movie->giochieu }}</span>
                                                    </div>
                                                    <h2 class="Title">{{ $movie->name }}
                                                    </h2> <span class="Year">{{ $movie->origin_name }}</span>
                                                </a>
                                                <div class="TPMvCn anmt">
                                                    <div class="Title">{{ $movie->name }}
                                                    </div>
                                                    <p class="Info"> <span
                                                            class="Vote AAIco-star">{{ $movie->rating_star }}</span>
                                                        <span
                                                            class="Time AAIco-access_time">{{ $movie->episode_current }}/{{ $movie->episode_total }}</span>
                                                        <span
                                                            class="Date AAIco-date_range">{{ $movie->publish_year }}</span>
                                                    </p>
                                                    <div class="Description">
                                                        <p>{!! mb_substr(strip_tags($movie->content), 0, 142, 'utf-8') !!}...</p>
                                                        <p class="Director AAIco-videocam">
                                                            <span>Đạo diễn:</span>
                                                            {!! $movie->directors->map(function ($director) {
                                                                    return '<a href="' . $director->getUrl() . '" title="' . $director->name . '">' . $director->name . '</a>';
                                                                })->implode(', ') !!}
                                                            <i class="Button STPa AAIco-more_horiz"></i>
                                                        </p>
                                                        <p class="Actors AAIco-person">
                                                            <span>Diễn viên:</span>
                                                            {!! $movie->actors->map(function ($actor) {
                                                                    return '<a href="' . $actor->getUrl() . '" title="' . $actor->name . '">' . $actor->name . '</a>';
                                                                })->implode(', ') !!}
                                                            <i class="Button STPa AAIco-more_horiz"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </article>
                                        </li>
                                    @endforeach
                                </ul>
                            </section>
                        @endif
                        @if (count($lichchieuthubay))
                            <section class="Homeschedule">
                                <div class="Top">
                                    <h1><b>Thứ Bảy</b></h1>
                                </div>
                                <ul class="MovieList Rows AX A06 B04 C03 E011">
                                    @foreach ($lichchieuthubay ?? [] as $movie)
                                        <li class="TPostMv">
                                            <article id="post-5175"
                                                class="TPost C post-5175 post type-post status-publish format-standard has-post-thumbnail hentry">
                                                <a href="{{ $movie->getUrl() }}">
                                                    <div class="Image">
                                                        <figure class="Objf TpMvPlay AAIco-play_arrow"><img
                                                                width="215" height="320"
                                                                src="{{ $movie->getThumbUrl() }}"
                                                                class="attachment-thumbnail size-thumbnail wp-post-image"
                                                                alt="{{ $movie->name }} - {{ $movie->origin_name }} ({{ $movie->publish_year }})"
                                                                title="{{ $movie->name }} ({{ $movie->publish_year }})">
                                                        </figure>
                                                        <span class="mli-timeschedule"
                                                            data-timer_second="58715"></span>
                                                        <span class="b">{{ $movie->giochieu }}</span>
                                                    </div>
                                                    <h2 class="Title">{{ $movie->name }}
                                                    </h2> <span class="Year">{{ $movie->origin_name }}</span>
                                                </a>
                                                <div class="TPMvCn anmt">
                                                    <div class="Title">{{ $movie->name }}
                                                    </div>
                                                    <p class="Info"> <span
                                                            class="Vote AAIco-star">{{ $movie->rating_star }}</span>
                                                        <span
                                                            class="Time AAIco-access_time">{{ $movie->episode_current }}/{{ $movie->episode_total }}</span>
                                                        <span
                                                            class="Date AAIco-date_range">{{ $movie->publish_year }}</span>
                                                    </p>
                                                    <div class="Description">
                                                        <p>{!! mb_substr(strip_tags($movie->content), 0, 142, 'utf-8') !!}...</p>
                                                        <p class="Director AAIco-videocam">
                                                            <span>Đạo diễn:</span>
                                                            {!! $movie->directors->map(function ($director) {
                                                                    return '<a href="' . $director->getUrl() . '" title="' . $director->name . '">' . $director->name . '</a>';
                                                                })->implode(', ') !!}
                                                            <i class="Button STPa AAIco-more_horiz"></i>
                                                        </p>
                                                        <p class="Actors AAIco-person">
                                                            <span>Diễn viên:</span>
                                                            {!! $movie->actors->map(function ($actor) {
                                                                    return '<a href="' . $actor->getUrl() . '" title="' . $actor->name . '">' . $actor->name . '</a>';
                                                                })->implode(', ') !!}
                                                            <i class="Button STPa AAIco-more_horiz"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </article>
                                        </li>
                                    @endforeach
                                </ul>
                            </section>
                        @endif
                        @if (count($lichchieuchunhat))
                            <section class="Homeschedule">
                                <div class="Top">
                                    <h1><b>Thứ Bảy</b></h1>
                                </div>
                                <ul class="MovieList Rows AX A06 B04 C03 E011">
                                    @foreach ($lichchieuchunhat ?? [] as $movie)
                                        <li class="TPostMv">
                                            <article id="post-5175"
                                                class="TPost C post-5175 post type-post status-publish format-standard has-post-thumbnail hentry">
                                                <a href="{{ $movie->getUrl() }}">
                                                    <div class="Image">
                                                        <figure class="Objf TpMvPlay AAIco-play_arrow"><img
                                                                width="215" height="320"
                                                                src="{{ $movie->getThumbUrl() }}"
                                                                class="attachment-thumbnail size-thumbnail wp-post-image"
                                                                alt="{{ $movie->name }} - {{ $movie->origin_name }} ({{ $movie->publish_year }})"
                                                                title="{{ $movie->name }} ({{ $movie->publish_year }})">
                                                        </figure>
                                                        <span class="mli-timeschedule"
                                                            data-timer_second="58715"></span>
                                                        <span class="b">{{ $movie->giochieu }}</span>
                                                    </div>
                                                    <h2 class="Title">{{ $movie->name }}
                                                    </h2> <span class="Year">{{ $movie->origin_name }}</span>
                                                </a>
                                                <div class="TPMvCn anmt">
                                                    <div class="Title">{{ $movie->name }}
                                                    </div>
                                                    <p class="Info"> <span
                                                            class="Vote AAIco-star">{{ $movie->rating_star }}</span>
                                                        <span
                                                            class="Time AAIco-access_time">{{ $movie->episode_current }}/{{ $movie->episode_total }}</span>
                                                        <span
                                                            class="Date AAIco-date_range">{{ $movie->publish_year }}</span>
                                                    </p>
                                                    <div class="Description">
                                                        <p>{!! mb_substr(strip_tags($movie->content), 0, 142, 'utf-8') !!}...</p>
                                                        <p class="Director AAIco-videocam">
                                                            <span>Đạo diễn:</span>
                                                            {!! $movie->directors->map(function ($director) {
                                                                    return '<a href="' . $director->getUrl() . '" title="' . $director->name . '">' . $director->name . '</a>';
                                                                })->implode(', ') !!}
                                                            <i class="Button STPa AAIco-more_horiz"></i>
                                                        </p>
                                                        <p class="Actors AAIco-person">
                                                            <span>Diễn viên:</span>
                                                            {!! $movie->actors->map(function ($actor) {
                                                                    return '<a href="' . $actor->getUrl() . '" title="' . $actor->name . '">' . $actor->name . '</a>';
                                                                })->implode(', ') !!}
                                                            <i class="Button STPa AAIco-more_horiz"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </article>
                                        </li>
                                    @endforeach
                                </ul>
                            </section>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('themes::themebptv.inc.footer')
</div>

</html>
