@extends('layouts.app')

@section('content')
<div class="hidden sm:block">


    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
       <div class="flex flex-col mt-2">
            <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                <x-table>
                    <x-slot name="head">
                        <x-table.heading sortable direction="asc">Hey</x-table.heading>
                        <x-table.heading>There</x-table.heading>
                        <x-table.heading>There</x-table.heading>
                    </x-slot>
                    <x-slot name="body">
                        <x-table.row>
                            <x-table.cell icon>One</x-table.cell>
                            <x-table.cell align="center">Two</x-table.cell>
                            <x-table.cell align="center">Three</x-table.cell>
                        </x-table.row>
                    </x-slot>
                </x-table>
            </div>
       </div>
    </div>

</div>
@endsection
