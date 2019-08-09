<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creditor extends Model
{
    protected $fillable = [
        'user_id', 'service_id', 'economic_sector_invest', 'value',
    ];
}
