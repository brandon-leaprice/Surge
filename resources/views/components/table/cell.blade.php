@props([
    'align' => null
])
<td {{$attributes->merge()}} class="px-6 py-4 text-{{$align}} whitespace-nowrap text-sm text-gray-900">
    <span>{{$slot}}</span>
</td>

