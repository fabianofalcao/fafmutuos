<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
    protected $fillable = [
        'user_id', 'job_id', 'source_of_debt', 'value',
    ];

    public function getDevtorsJoin($totalPage=5)
    {
        $debtors = $this->join('users', 'users.id', '=', 'debtors.user_id')
            ->join('jobs', 'jobs.id', '=', 'debtors.job_id')
            ->where('users.debtor', '=', true)
            ->select('users.name as userName', 'jobs.description as descriptionJob', 'debtors.*')
            ->paginate($totalPage);
        return $debtors;
    }

    public function search($request, $totalPage = 10)
    {
        $keySearch = $request->search;
        return $this->join('users', 'users.id', '=', 'debtors.user_id')
            ->join('jobs', 'jobs.id', '=', 'debtors.job_id')
            ->where('users.name', 'LIKE', "%{$keySearch}%")
            ->select('users.name as userName', 'jobs.description as descriptionJob', 'debtors.*')
            ->paginate($totalPage);
    }

    public function getValueAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
