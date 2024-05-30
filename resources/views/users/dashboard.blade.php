<x-layout>
    <h1 class="title">Hello {{ auth()->user()->username }}</h1>
    {{-- create post form --}}
    <div class="card mb-4">
        <h2 class="font-bold mb-4">Create a new post</h2>

        {{-- Session message --}}
        @if (session('success'))
            <div>
                <x-flashMsg msg="{{ session('success') }}"
                bg="bg-green-500"/>
            </div>
        @endif
        <form action="{{ route('posts.store') }}" method="post">
        @csrf
        {{-- Post Title --}}
        <div class="mb-4">
            <label for="title">Post Title</label>
            <input type="text" name="title" value="{{ old('title') }}" 
            class="input @error('title') ring-red-500 @enderror">
            @error('title')
                <p class="error"> {{ $message }}</p>
            @enderror
        </div>
        {{-- Post Body --}}
        <div class="mb-4">
            <label for="body">Post Content</label>
            <textarea name="body" rows="5" class="input @error('body') ring-red-500 @enderror">{{ old('body') }}</textarea>
            @error('body')
                <p class="error"> {{ $message }}</p>
            @enderror
        </div>
        <button class="btn">Create</button>
        </form>
    </div>
</x-layout>
