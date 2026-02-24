<div class="p-6">
    <div x-html="block.data.content || '<p class=\'text-gray-400\'>Enter text content...</p>'"
         class="prose prose-sm max-w-none
                [&_ul]:list-disc [&_ul]:ml-5 [&_ul]:my-2
                [&_ol]:list-decimal [&_ol]:ml-5 [&_ol]:my-2
                [&_li]:my-1
                [&_h2]:text-xl [&_h2]:font-bold [&_h2]:my-3
                [&_h3]:text-lg [&_h3]:font-semibold [&_h3]:my-2
                [&_a]:text-blue-600 [&_a]:underline
                [&_p]:my-2">
    </div>
</div>
