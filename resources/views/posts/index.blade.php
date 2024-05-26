<x-layout>
    <h1 class="title">Latest Posts</h1>
    <div class="grid grid-cols-2 gap-6">
        @foreach ($posts as $post)
            <div class="card mb-4">
                <h2 class="font-bold text-xl">{{ $post->title }}</h2>
                <div class="text-xs font-light mb-4">
                    <span>Posted {{ $post->created_at->diffForHumans() }} By</span>
                    <a href="" class="text-blue-500 font-medium">USERNAME</a>
                </div>
                <div class="text-sm">
                    <p>{{ Str::words($post->body, 30) }}</p>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
