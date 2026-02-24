@props(['data'])

@php
    $layout = $data['layout'] ?? '50-50';
    $verticalAlign = $data['vertical_align'] ?? 'top';
    $cardStyle = $data['card_style'] ?? false;

    // Left column styles
    $leftBgColor = !empty($data['left_bg_color']) ? $data['left_bg_color'] : ($cardStyle ? '#f9fafb' : 'transparent');
    $leftTextColor = $data['left_text_color'] ?? 'inherit';
    $defaultPadding = $cardStyle ? 24 : 0;
    $leftPaddingTop = isset($data['left_padding_top']) && $data['left_padding_top'] !== '' ? intval($data['left_padding_top']) : $defaultPadding;
    $leftPaddingRight = isset($data['left_padding_right']) && $data['left_padding_right'] !== '' ? intval($data['left_padding_right']) : $defaultPadding;
    $leftPaddingBottom = isset($data['left_padding_bottom']) && $data['left_padding_bottom'] !== '' ? intval($data['left_padding_bottom']) : $defaultPadding;
    $leftPaddingLeft = isset($data['left_padding_left']) && $data['left_padding_left'] !== '' ? intval($data['left_padding_left']) : $defaultPadding;

    // Right column styles
    $rightBgColor = !empty($data['right_bg_color']) ? $data['right_bg_color'] : ($cardStyle ? '#f9fafb' : 'transparent');
    $rightTextColor = $data['right_text_color'] ?? 'inherit';
    $rightPaddingTop = isset($data['right_padding_top']) && $data['right_padding_top'] !== '' ? intval($data['right_padding_top']) : $defaultPadding;
    $rightPaddingRight = isset($data['right_padding_right']) && $data['right_padding_right'] !== '' ? intval($data['right_padding_right']) : $defaultPadding;
    $rightPaddingBottom = isset($data['right_padding_bottom']) && $data['right_padding_bottom'] !== '' ? intval($data['right_padding_bottom']) : $defaultPadding;
    $rightPaddingLeft = isset($data['right_padding_left']) && $data['right_padding_left'] !== '' ? intval($data['right_padding_left']) : $defaultPadding;

    $gridClass = match($layout) {
        '60-40' => 'md:grid-cols-[60%_40%]',
        '40-60' => 'md:grid-cols-[40%_60%]',
        '70-30' => 'md:grid-cols-[70%_30%]',
        '30-70' => 'md:grid-cols-[30%_70%]',
        default => 'md:grid-cols-2'
    };

    $alignClass = match($verticalAlign) {
        'center' => 'items-center',
        'bottom' => 'items-end',
        default => $cardStyle ? 'items-stretch' : 'items-start'
    };

    // Check if any column has background color set
    $leftHasBg = $leftBgColor && $leftBgColor !== 'transparent';
    $rightHasBg = $rightBgColor && $rightBgColor !== 'transparent';
@endphp

<div class="max-w-6xl mx-auto px-4 md:px-6">
    <div class="grid grid-cols-1 {{ $gridClass }} gap-6 md:gap-8 {{ $alignClass }}">
        {{-- Left Column --}}
        <div class="{{ $leftHasBg || $cardStyle ? 'rounded-xl h-full' : '' }}"
             style="background-color: {{ $leftBgColor }}; color: {{ $leftTextColor }}; padding: {{ $leftPaddingTop }}px {{ $leftPaddingRight }}px {{ $leftPaddingBottom }}px {{ $leftPaddingLeft }}px;">
            @if($data['left_title'] ?? false)
                <h3 class="text-2xl font-semibold mb-4">
                    {{ $data['left_title'] }}
                </h3>
            @endif
            @if($data['left_content'] ?? false)
                <div class="prose prose-sm max-w-none
                            [&_h2]:text-xl [&_h2]:font-semibold [&_h2]:mt-6 [&_h2]:mb-3
                            [&_h3]:text-lg [&_h3]:font-semibold [&_h3]:mt-4 [&_h3]:mb-2
                            [&_p]:leading-relaxed [&_p]:mb-4
                            [&_ul]:list-disc [&_ul]:ml-6 [&_ul]:mb-4
                            [&_ol]:list-decimal [&_ol]:ml-6 [&_ol]:mb-4
                            [&_li]:mb-2
                            [&_a]:text-[#00959f] [&_a]:underline
                            [&_strong]:font-semibold">
                    {!! $data['left_content'] !!}
                </div>
            @endif
        </div>

        {{-- Right Column --}}
        <div class="{{ $rightHasBg || $cardStyle ? 'rounded-xl h-full' : '' }}"
             style="background-color: {{ $rightBgColor }}; color: {{ $rightTextColor }}; padding: {{ $rightPaddingTop }}px {{ $rightPaddingRight }}px {{ $rightPaddingBottom }}px {{ $rightPaddingLeft }}px;">
            @if($data['right_title'] ?? false)
                <h3 class="text-2xl font-semibold mb-4">
                    {{ $data['right_title'] }}
                </h3>
            @endif
            @if($data['right_image'] ?? false)
                <img src="{{ asset('storage/' . $data['right_image']) }}"
                     alt="{{ $data['right_image_alt'] ?? '' }}"
                     class="w-full rounded-lg">
            @elseif($data['right_content'] ?? false)
                <div class="prose prose-sm max-w-none
                            [&_h2]:text-xl [&_h2]:font-semibold [&_h2]:mt-6 [&_h2]:mb-3
                            [&_h3]:text-lg [&_h3]:font-semibold [&_h3]:mt-4 [&_h3]:mb-2
                            [&_p]:leading-relaxed [&_p]:mb-4
                            [&_ul]:list-disc [&_ul]:ml-6 [&_ul]:mb-4
                            [&_ol]:list-decimal [&_ol]:ml-6 [&_ol]:mb-4
                            [&_li]:mb-2
                            [&_a]:text-[#00959f] [&_a]:underline
                            [&_strong]:font-semibold">
                    {!! $data['right_content'] !!}
                </div>
            @endif
        </div>
    </div>
</div>
