<div class="p-4">
    <div class="grid gap-4"
        :class="{
            'grid-cols-2': !block.data.layout || block.data.layout === '50-50',
            'grid-cols-[60%_40%]': block.data.layout === '60-40',
            'grid-cols-[40%_60%]': block.data.layout === '40-60',
            'grid-cols-[70%_30%]': block.data.layout === '70-30',
            'grid-cols-[30%_70%]': block.data.layout === '30-70',
            'items-stretch': block.data.card_style && block.data.vertical_align !== 'center' && block.data.vertical_align !== 'bottom',
            'items-start': !block.data.card_style && block.data.vertical_align === 'top',
            'items-center': block.data.vertical_align === 'center',
            'items-end': block.data.vertical_align === 'bottom'
        }">
        {{-- Left Column --}}
        <div class="rounded-xl"
            :style="'background-color: ' + (block.data.left_bg_color || (block.data.card_style ? '#f9fafb' : 'transparent')) + '; color: ' + (block.data.left_text_color || 'inherit') + '; padding: ' + (block.data.card_style && !block.data.left_padding_top ? '24px' : ((block.data.left_padding_top || 0) + 'px ' + (block.data.left_padding_right || 0) + 'px ' + (block.data.left_padding_bottom || 0) + 'px ' + (block.data.left_padding_left || 0) + 'px')) + ';'">
            <div class="prose prose-sm max-w-none [&_ul]:list-disc [&_ul]:ml-5 [&_ol]:list-decimal [&_ol]:ml-5"
                x-html="block.data.left_content || '<p class=\'text-gray-400\'>Left column content</p>'"></div>
        </div>

        {{-- Right Column --}}
        <div class="rounded-xl"
            :style="'background-color: ' + (block.data.right_bg_color || (block.data.card_style ? '#f9fafb' : 'transparent')) + '; color: ' + (block.data.right_text_color || 'inherit') + '; padding: ' + (block.data.card_style && !block.data.right_padding_top ? '24px' : ((block.data.right_padding_top || 0) + 'px ' + (block.data.right_padding_right || 0) + 'px ' + (block.data.right_padding_bottom || 0) + 'px ' + (block.data.right_padding_left || 0) + 'px')) + ';'">
            <template x-if="block.data.right_image">
                <img :src="getImageUrl(block.data.right_image)" class="w-full rounded">
            </template>
            <template x-if="!block.data.right_image">
                <div class="prose prose-sm max-w-none [&_ul]:list-disc [&_ul]:ml-5 [&_ol]:list-decimal [&_ol]:ml-5"
                    x-html="block.data.right_content || '<p class=\'text-gray-400\'>Right column content</p>'"></div>
            </template>
        </div>
    </div>
</div>
