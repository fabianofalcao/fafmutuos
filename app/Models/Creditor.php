<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Creditor extends Model
{
    protected $fillable = [
        'user_id', 'economic_sector_id', 'value',
    ];

    public function getCreditorsJoin($totalPage=5)
    {
        $debtors = $this->join('users', 'users.id', '=', 'creditors.user_id')
            ->join('economic_sectors', 'economic_sectors.id', '=', 'creditors.economic_sector_id')
            ->where('users.creditor', '=', true)
            ->select('users.name as userName', 'economic_sectors.description as descriptionSector', 'creditors.*')
            ->paginate($totalPage);
        return $debtors;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function economic_sector()
    {
        return $this->belongsTo(EconomicSector::class);
    }

    public function getValueAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }
}
