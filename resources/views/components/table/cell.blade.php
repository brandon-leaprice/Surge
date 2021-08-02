@props([
    'icon' => null,
    'align' => null
])
<td class="px-6 py-4 text-{{$align}} whitespace-nowrap text-sm text-gray-900">
    @unless($icon)
        <span class="font-medium">{{$slot}}</span>
    @else
        <div class="flex">
            <a href="#" class="group inline-flex space-x-2 truncate text-sm">
                <!-- Heroicon name: solid/cash -->
                <svg class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                </svg>
                <p class="text-gray-500 truncate group-hover:text-gray-900">
                    {{$slot}}
                </p>
            </a>
        </div>
    @endunless
</td>
