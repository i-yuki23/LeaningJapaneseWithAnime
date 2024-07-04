<x-layout>
    <div class="content">
        <div class="content__body">
            @foreach ($snippets as $snippet)
                <div class="content__body__videos">
                    <p>
                        {{ $snippet->title }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>