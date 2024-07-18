@foreach ($posts as $value)
<div class="post-entry-1 border-bottom">
    <div class="post-meta"><span class="date"><a href="{{ $value->c_slug }}">{{  $value->c_name }}</a></span> <span
            class="mx-1">&bullet;</span> <span>{{ $value->p_created_at }}</span></div>
    <h2 class="mb-2"><a href="{{ $value->p_slug }}">{{ $value->p_excerpt }}</a></h2>
    <span class="author mb-3 d-block">Nguyễn Ngọc Quốc</span>
</div> 
@endforeach
