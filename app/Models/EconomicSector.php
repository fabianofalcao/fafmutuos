<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EconomicSector extends Model
{
    protected $fillable = ['description'];


    public function search($request, $totalPage = 10)
    {
        $keySearch = $request->search;
        return $this->where('description', 'LIKE', "%{$keySearch}%")->paginate($totalPage);
    }

    public function creditors()
    {
        return $this->hasMany(Creditor::class);
    }
}


