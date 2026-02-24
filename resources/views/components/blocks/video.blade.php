@props(['data'])

<div class="max-w-6xl mx-auto px-4 md:px-6">
    @if($data['url'] ?? false)
        @php
            $url = $data['url'];
            $embedUrl = '';

            // Parse YouTube URLs
            if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $matches)) {
                $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
            }
            // Parse Vimeo URLs
            elseif (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
                $embedUrl = 'https://player.vimeo.com/video/' . $matches[1];
            }
        @endphp

        @if($embedUrl)
            <div class="aspect-video rounded-lg overflow-hidden shadow-lg">
                <iframe src="{{ $embedUrl }}"
                        class="w-full h-full"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                </iframe>
            </div>
        @endif
    @endif

    @if($data['caption'] ?? false)
        <p class="mt-4 text-center text-gray-500 text-sm">
            {{ $data['caption'] }}
        </p>
    @endif
</div>
