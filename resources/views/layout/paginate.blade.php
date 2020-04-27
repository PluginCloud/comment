@if($paginator->hasPages())
    <div id="{{ $paginator->getPageName() }}" class="center">
        <div class="layui-box layui-laypage layui-laypage-default">
            @if(!$paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}" class="layui-laypage-prev">上一页</a>
            @endif
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="layui-laypage-spr">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="layui-laypage-curr">
                                <em class="layui-laypage-em"></em>
                                <em>{{ $page }}</em>
                            </span>
                        @else
                            <a href="{{ $paginator->url($page) }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="layui-laypage-next">下一页</a>
            @endif
        </div>
    </div>
@endif
