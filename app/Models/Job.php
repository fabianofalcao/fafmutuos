<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = ['description'];


    public function search($request, $totalPage = 10)
    {
        $keySearch = $request->search;
        return $this->where('description', 'LIKE', "%{$keySearch}%")->paginate($totalPage);
    }
}
