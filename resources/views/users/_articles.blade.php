@if (count($articles))

<ul class="list-group">
    @foreach ($articles as $article)
        <li class="list-group-item">
            <a href="{{ route('articles.show', $article->id) }}">
                {{ $article->title }}
            </a>
            <span class="meta pull-right">
                {{ $article->reply_count }} 回复
                <span> ⋅ </span>
                {{ $article->created_at->diffForHumans() }}
            </span>
        </li>
    @endforeach
</ul>

@else
   <div class="empty-block">暂无数据 ~_~ </div>
@endif

{{-- 分页 --}}
{!! $articles->render() !!}