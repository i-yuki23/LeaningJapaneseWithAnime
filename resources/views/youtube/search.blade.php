<x-layout>
    <h1>Search Results for "{{ $keyword }}"</h1>
    <ul>
        @foreach ($videos as $video)
            <li>
                <h3>{{ $video['snippet']['title'] }}</h3>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $video['id']['videoId'] }}" frameborder="0" allowfullscreen></iframe>
                <p><strong>Explanation:</strong> {{ $video['explanation'] }}</p>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('youtube.index') }}">Back to search</a>
</x-layout>