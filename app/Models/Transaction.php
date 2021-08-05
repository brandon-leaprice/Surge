<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const STATUSES = [
        'success' => 'Success',
        'failed' => 'Failed',
        'processing' => 'Processing',
    ];

    protected $guarded = [];
    protected $casts = ['date' => 'date'];

    public function getStatusColourAttribute()
    {
        return [
            'processing' => 'indigo',
            'success' => 'green',
            'failed' => 'red'
        ][$this->status] ?? 'cool-grey';
    }


    public function getDateForEditingAttribute()
    {
        return $this->date->format('m/d/Y');
    }

    public function setDateForEditingAttribute($value)
    {
        $this->date = Carbon::parse($value);
    }
}
