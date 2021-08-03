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

    public $queryString = ['sortField', 'sortDirection'];


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

    public function render()
    {
        sleep(1);
        return view('livewire.dashboard', ['transactions' =>
            Transaction::query()->search('title', $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(10)]);
    }
}
