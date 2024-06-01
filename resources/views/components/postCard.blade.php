@props(['post', 'full' => false])
<div class="card mb-4">
    <h2 class="font-bold text-xl">{{ $post->title }}</h2>
    <div class="text-xs font-light mb-4">
        <span>Posted {{ $post->created_at->diffForHumans() }} By</span>
        <a href="{{ route('posts.user', $post->user) }}" class="text-blue-500 font-medium">{{ $post->user->username }}</a>
    </div>
    @if ($full)
        <div class="text-sm">
            <span>{{$post->body}}</span>
        </div>    
    @else
        <div class="text-sm">
            <span>{{ Str::words($post->body, 30) }}</span>
            <a href="{{ route('posts.show', $post)}}" class="text-blue-500 ml-2">Read more &rarr;</a>
        </div>
    @endif
</div>
