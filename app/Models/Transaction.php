<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function getStatusColourAttribute()
    {
        return [
            'processing' => 'indigo',
            'success' => 'green',
            'failed' => 'red'
        ][$this->status] ?? 'cool-grey';
    }
}
