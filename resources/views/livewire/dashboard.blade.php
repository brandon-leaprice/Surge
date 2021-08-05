 <div>
        <div class="py-6 px-10">
            <h1 class="text-2xl">Dashboard</h1>
        </div>
        <div class="py-4 space-y-4">

            <div class="hidden sm:block">
                <div class="mx-auto px-4 sm:px-6 lg:px-8">

                    <div class="flex justify-between">
                        <div class="w-2/4 flex space-x-4">
                            <x-input.text wire:model="filters.search" placeholder="Search Transactions..." />

                            <x-button.link wire:click="$toggle('showFilters')">@if ($showFilters) Hide @endif Advanced Search...</x-button.link>
                        </div>

                        <div>
                            <x-button.primary wire:click="create"> New</x-button.primary>
                        </div>
                    </div>

                    <div>
                    @if ($showFilters)
                        <div class="bg-cool-gray-200 p-4 rounded shadow-inner flex relative">
                            <div class="w-1/2 pr-2 space-y-4">
                                <x-input.group inline for="filter-status" label="Status">
                                    <x-input.select wire:model="filters.status" id="filter-status">
                                        <option value="" disabled>Select Status...</option>

                                        @foreach (App\Models\Transaction::STATUSES as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </x-input.select>
                                </x-input.group>

                                <x-input.group inline for="filter-amount-min" label="Minimum Amount">
                                    <x-input.money wire:model.lazy="filters.amount-min" id="filter-amount-min" />
                                </x-input.group>

                                <x-input.group inline for="filter-amount-max" label="Maximum Amount">
                                    <x-input.money wire:model.lazy="filters.amount-max" id="filter-amount-max" />
                                </x-input.group>
                            </div>

                            <div class="w-1/2 pl-2 space-y-4">
                                <x-input.group inline for="filter-date-min" label="Minimum Date">
                                    <x-input.date wire:model="filters.date-min" id="filter-date-min" placeholder="MM/DD/YYYY" />
                                </x-input.group>

                                <x-input.group inline for="filter-date-max" label="Maximum Date">
                                    <x-input.date wire:model="filters.date-max" id="filter-date-max" placeholder="MM/DD/YYYY" />
                                </x-input.group>

                                <x-button.link wire:click="resetFilters" class="absolute right-0 bottom-0 p-4">Reset Filters</x-button.link>
                            </div>
                        </div>
                    @endif
                </div>

                    <div class="flex flex-col mt-2">
                        <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                            <x-table>
                                <x-slot name="head">
                                    <x-table.heading sortable wire:click="sortBy('title')" :direction="$sortField === 'title' ? $sortDirection : null">Title</x-table.heading>
                                    <x-table.heading>Amount</x-table.heading>
                                    <x-table.heading>Status</x-table.heading>
                                    <x-table.heading>Date</x-table.heading>
                                    <x-table.heading>Actions</x-table.heading>
                                </x-slot>
                                <x-slot name="body">
                                    @forelse($transactions as $transaction)
                                        <x-table.row wire:loading.class="opacity-75">
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

                                            <x-table.cell align="center">
                                                <x-button.link wire:click="edit({{ $transaction->id }})">Edit</x-button.link>
                                            </x-table.cell>
                                        </x-table.row>
                                    @empty
                                        <x-table.row>
                                            <x-table.cell colspan="5">
                                                <div class="text-center py-8 text-2xl text-gray-400">
                                                    <h1>Couldn't find any results</h1>
                                                </div>
                                            </x-table.cell>
                                        </x-table.row>
                                    @endforelse
                                </x-slot>
                            </x-table>
                        </div>

                        <div class="py-4">
                            {{$transactions->links()}}
                        </div>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="save">
                <x-modal.dialog wire:model.defer="showEditModal">
                    <x-slot name="title">Edit Transaction</x-slot>

                    <x-slot name="content">
                        <x-input.group for="title" label="Title" :error="$errors->first('editing.title')">
                            <x-input.text wire:model="editing.title" id="title" />
                        </x-input.group>

                        <x-input.group for="amount" label="Amount" :error="$errors->first('editing.amount')">
                            <x-input.money wire:model="editing.amount" id="amount" />
                        </x-input.group>

                        <x-input.group for="status" label="Status" :error="$errors->first('editing.status')">
                            <x-input.select wire:model="editing.status" id="status">
                                @foreach (App\Models\Transaction::STATUSES as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </x-input.select>
                        </x-input.group>

                        <x-input.group for="date_for_editing" label="Date" :error="$errors->first('editing.date_for_editing')">
                            <x-input.date wire:model="editing.date_for_editing" id="date_for_editing" />
                        </x-input.group>
                    </x-slot>

                    <x-slot name="footer">
                        <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                            <x-button.primary type="submit">Save</x-button.primary>
                    </x-slot>
                </x-modal.dialog>
            </form>
        </div>
    </div>

