@extends('layouts.app')

@section('content')
    <x-sidebar>
        <x-slot name="body">
            <div class="py-6 px-10">
                <h1 class="text-2xl">Dashboard</h1>
            </div>
            <div class="py-4">
                <div class="hidden sm:block">
                    <div class="mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex flex-col mt-2">
                            <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                                <x-table>
                                    <x-slot name="head">
                                        <x-table.heading sortable direction="asc">Title</x-table.heading>
                                        <x-table.heading>Amount</x-table.heading>
                                        <x-table.heading>Status</x-table.heading>
                                        <x-table.heading>Date</x-table.heading>
                                    </x-slot>
                                    <x-slot name="body">
                                        @foreach($transactions as $transaction)
                                            <x-table.row>
                                                <x-table.cell>
                                                    <x-icon.cash/>
                                                    <p class="text-gray-500 truncate group-hover:text-gray-900">
                                                        {{$transaction->title}}
                                                    </p>
                                                </x-table.cell>

                                                <x-table.cell align="center">
                                                    <span class="text-gray-900 font-medium">${{$transaction->amount}}</span>
                                                </x-table.cell>

                                                <x-table.cell align="center">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{$transaction->getStatusColourAttribute()}}-100 text-green-800 capitalize">
                                                      {{$transaction->status}}
                                                    </span>
                                                </x-table.cell>


                                                <x-table.cell align="center">{{$transaction->date}}</x-table.cell>
                                            </x-table.row>
                                        @endforeach
                                    </x-slot>
                                </x-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-sidebar>
@endsection
