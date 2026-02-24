@props(['data'])

<div class="max-w-6xl mx-auto px-4 md:px-6">
    @if($data['heading'] ?? false)
        <h2 class="text-3xl md:text-4xl font-semibold text-gray-900 mb-6">
            {{ $data['heading'] }}
        </h2>
    @endif

    @if($data['content'] ?? false)
        <div class="prose prose-lg max-w-none text-gray-600
                    [&_h2]:text-2xl [&_h2]:font-semibold [&_h2]:text-gray-900 [&_h2]:mt-8 [&_h2]:mb-4
                    [&_h3]:text-xl [&_h3]:font-semibold [&_h3]:text-gray-900 [&_h3]:mt-6 [&_h3]:mb-3
                    [&_p]:leading-relaxed [&_p]:mb-4 [&_p]:text-gray-600
                    [&_ul]:list-disc [&_ul]:ml-6 [&_ul]:mb-4
                    [&_ol]:list-decimal [&_ol]:ml-6 [&_ol]:mb-4
                    [&_li]:mb-2 [&_li]:text-gray-600
                    [&_a]:text-[#00959f] [&_a]:underline
                    [&_strong]:font-semibold
                    [&_span]:inline">
            {!! $data['content'] !!}
        </div>
    @endif
</div>
