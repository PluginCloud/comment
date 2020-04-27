@if(request()->route()->named("comment.home.content.info"))
    @if(isset($infoRightAd) && !is_null($infoRightAd))
        <div class="ads_content">
            {!! $infoRightAd->content !!}
        </div>
    @else
        <div style="margin-top: 100px"></div>
    @endif
@else
    <div style="margin-top: 100px"></div>
@endif
