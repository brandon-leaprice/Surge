@props(['leadingAddon' => false])

<div class="max-w-lg flex rounded-md shadow-sm">

    @if($leadingAddon)
        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                           {{$leadingAddon}}
            </span>
    @endif
    <input
        {{$attributes}}
        class="flex-1 border border-gray-300 form-input block w-full {{ $leadingAddon == true ? 'rounded-none rounded-r-md' : '' }} transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
</div>
