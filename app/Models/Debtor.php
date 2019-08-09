<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
    protected $fillable = [
        'user_id', 'job_id', 'source_of_debt', 'kind_of_work', 'value',
    ];
}
