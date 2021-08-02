
@props([
    'sortable' => null,
    'direction' => null
])


<th {{$attributes->merge(['class' => 'px-6 py-3 bg-gray-50'])->only('class')}}>
    @unless($sortable)
        <span class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            {{$slot}}
        </span>
    @else
        <button {{$attributes->except('class')}} class="flex items-center space-x-1 text-left text-xs leading-4 font-medium">
            <span>{{$slot}}</span>

            <span>
                @if($direction === 'desc')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                @endif
            </span>
        </button>
    @endunless
</th>
