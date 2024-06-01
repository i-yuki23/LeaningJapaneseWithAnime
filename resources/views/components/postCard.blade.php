@props(['post'])
<div class="card mb-4">
    <h2 class="font-bold text-xl">{{ $post->title }}</h2>
    <div class="text-xs font-light mb-4">
        <span>Posted {{ $post->created_at->diffForHumans() }} By</span>
        <a href="{{ route('posts.user', $post->user) }}" class="text-blue-500 font-medium">{{ $post->user->username }}</a>
    </div>
    <div class="text-sm">
        <p>{{ Str::words($post->body, 30) }}</p>
    </div>
</div>
