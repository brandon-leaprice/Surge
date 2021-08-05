<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $search = '';
    public  $sortField = 'title';
    public  $sortDirection = 'desc';
    public $showEditModal = false;
    public Transaction $editing;

    public $queryString = ['sortField', 'sortDirection'];


    public function rules()
    {
        return [
            'editing.title' => 'required|min:3',
            'editing.amount' => 'required',
            'editing.status' => 'required|in:'.collect(Transaction::STATUSES)->keys()->implode(','),
            'editing.date_for_editing' => 'required',
        ];
    }

    public function mount()
    {
        $this->editing = Transaction::make(['date' => now()]);
    }

    public function sortBy($field)
    {
        if($this->sortField === $field)
        {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'desc';
        }

        $this->sortField = $field;
    }

    public function edit(Transaction $transaction)
    {
        $this->editing = $transaction;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->editing->save();

        $this->showEditModal = false;
    }



    public function render()
    {
        sleep(1);
        return view('livewire.dashboard', ['transactions' =>
            Transaction::query()->search('title', $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10)])->layout('layouts.auth');
    }
}
