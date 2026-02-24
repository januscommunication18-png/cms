<div class="p-8 text-center"
     :class="{
         'bg-gray-900 text-white': block.data.background === 'dark',
         'bg-gray-100 text-gray-900': block.data.background === 'light',
         'bg-blue-600 text-white': block.data.background === 'brand'
     }">
    <h3 class="text-xl font-bold mb-2" x-text="block.data.title || 'CTA Title'"></h3>
    <p class="mb-4 opacity-80" x-text="block.data.description || 'Description text'"></p>
    <a href="#"
       class="inline-block px-6 py-2 rounded-lg font-medium transition"
       :class="{
           'bg-white text-gray-900 hover:bg-gray-100': block.data.style === 'primary' && block.data.background === 'dark',
           'bg-gray-900 text-white hover:bg-gray-800': block.data.style === 'primary' && block.data.background === 'light',
           'bg-white text-blue-600 hover:bg-gray-100': block.data.style === 'primary' && block.data.background === 'brand',
           'border-2 border-current': block.data.style === 'outline'
       }"
       x-text="block.data.button_text || 'Click Here'"></a>
</div>
