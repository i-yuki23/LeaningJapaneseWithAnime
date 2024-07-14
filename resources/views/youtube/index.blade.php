<x-layout>
    <h1>Search Videos</h1>
    <form action="{{ route('youtube.search.post') }}" method="POST">
        @csrf
        <input type="text" name="keyword" placeholder="Enter keyword">
        <button type="submit">Search</button>
    </form>
</x-layout>
