@props(['infoMessage' => false])

<div>
    <div class="max-w-lg flex rounded-md shadow-sm">
        <textarea {{$attributes}} class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"></textarea>
    </div>

    @if($infoMessage)
        <p class="mt-2 text-sm text-gray-500">{{$infoMessage}}</p>
    @endif
</div>
