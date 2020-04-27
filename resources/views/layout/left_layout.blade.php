@if(request()->route()->named("comment.home.content.info"))
    @if(isset($infoLeftAd) && !is_null($infoLeftAd))
        <div class="ads_content">
            {!! $infoLeftAd->content !!}
        </div>
    @else
        <div style="margin-top: 100px"></div>
    @endif
@else
    <div style="margin-top: 100px"></div>
@endif
