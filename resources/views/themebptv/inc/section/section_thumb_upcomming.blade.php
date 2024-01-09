<section>
    <div class="Top">
        <h1>
            {{ $item['label'] }} <i class=" fa fa-angle-right"></i>
        </h1>
    </div>
    <ul class="MovieList Rows AX A06 B04 C03 E20">
        @foreach ($item['data'] as $movie)
            <li class="TPostMv">
                <article id="post-5177"
                    class="TPost C post-5177 post type-post status-publish format-standard has-post-thumbnail hentry">
                    <a href="{{ $movie->getUrl() }}">
                        <div class="Image">
                            <figure class="Objf TpMvPlay AAIco-play_arrow"><img width="215" height="320"
                                    src="{{ $movie->getThumbUrl() }}"
                                    class="attachment-thumbnail size-thumbnail wp-post-image"
                                    alt="{{ $movie->name }} - {{ $movie->orignin_nam }} ({{ $movie->publish_year }})"
                                    title="{{ $movie->name }} ({{ $movie->publish_year }})"></figure>
                            <span class="mli-timeschedule">SẮP CHIẾU</span><span
                                class="b">{{ $movie->publish_year }}</span>
                            <div class="anime-extras">
                                <div class="anime-avg-user-rating"
                                    title="{{ $movie->rating_star }} trong số {{ $movie->rating_count }} đánh giá"
                                    data-action="click->anime-card#showLibraryEditor"><i
                                        class="fa fa-star"></i>{{ $movie->rating_star }}
                                </div>
                            </div>
                        </div>
                        <h2 class="Title">{{ $movie->name }}</h2> <span class="Year">Lượt xem:
                            {{ bptv_format_view($movie->view_total) }}</span>
                    </a>
                    <div class="TPMvCn anmt">
                        <div class="Title">{{ $movie->name }}</div>
                        <p class="Info"><span class="Qlty">{{ $movie->quality }}</span> <span
                                class="Vote AAIco-star">{{ $movie->rating_star }}</span> <span
                                class="Time AAIco-access_time">{{ $movie->episode_current }}/{{ $movie->episode_total }}</span>
                            <span class="Date AAIco-date_range">{{ $movie->publish_year }}</span>
                        </p>
                        <div class="Description">
                            <p>{!! mb_substr(strip_tags($movie->content), 0, 142, 'utf-8') !!}...</p>
                            <p class="Studio AAIco-videocam"><span>Studio:</span>
                                {!! $movie->studios->map(function ($studio) {
                                        return '<a href="' . $studio->getUrl() . '" title="' . $studio->name . '">' . $studio->name . '</a>';
                                    })->implode(', ') !!}
                                <i class="Button STPa AAIco-more_horiz"></i>
                            </p>
                            <p class="Genre AAIco-movie_creation"><span>Thể loại:</span>
                                {!! $movie->categories->map(function ($category) {
                                        return '<a href="' . $category->getUrl() . '" title="' . $category->name . '">' . $category->name . '</a>';
                                    })->implode(', ') !!}
                                <i class="Button STPa AAIco-more_horiz"></i>
                            </p>
                            <p class="Actors AAIco-person"><span>Diễn viên:</span>
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
    <a class="viewall" href="{{ $item['link'] }}">Xem thêm..</a>
</section>
