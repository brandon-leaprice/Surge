<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        sleep(1);
        return view('livewire.dashboard', ['transactions' =>
            Transaction::query()->search('title', $this->search)->paginate(10)]);
    }
}
