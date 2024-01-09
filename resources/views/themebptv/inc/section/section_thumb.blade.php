<section>
    <div class="Top">
        <h1>
            {{ $item['label'] }} <i class=" fa fa-angle-right"></i>
        </h1>
    </div>
    <ul class="MovieList Rows AX A06 B04 C03 E20">
        @foreach ($item['data'] as $movie)
            @include('themes::themebptv.inc.section.section_thumb_item')
        @endforeach
    </ul>
    <a href="{{ $item['link'] }}" class="viewall">Xem thêm.. <i class="ion-ios-arrow-right"></i></a>
</section>
