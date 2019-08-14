<?php

namespace App;

use App\Models\Creditor;
use App\Models\Debtor;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function newUser($request)
    {
        $creditor = new Creditor();
        $debtor = new Debtor();

        $this->name = $request->name;
        $this->password = ($request->password ? bcrypt($request->password) : bcrypt('opgsv5@t,'));
        $this->email = $request->email;
        if($request->type == 'creditor')
            $this->creditor = 1;
        if($request->type == 'debtor')
            $this->debtor = 1;
        $this->document = str_replace(['.','/','-'], '', $request->cnpj);
        $this->zipcode = str_replace(['.','/','-'], '',$request->zipcode);
        $this->street = $request->street;
        $this->number = $request->number;
        $this->complement = $request->complement;
        $this->neighborhood = $request->neighborhood;
        $this->state = $request->state;
        $this->city = $request->city;
        $this->save();
        $newUser = $this;

        $data = $request->all();
        $data['user_id'] = $newUser->id;

        if($newUser->debtor == 1){
            $newDebtor = $debtor->create($data);
        }

        if($newUser->creditor == 1){
            $newCreditor = $creditor->create($data);
        }

        return $newUser;

    }


    public function setLastLogin()
    {
        $this->last_login_at = date('Y-m-d');
        $this->last_login_ip = $_SERVER['REMOTE_ADDR'];
        return $updUser = $this->save();
    }


    public function search($request, $totalPage = 10)
    {
        $keySearch = $request->search;
        return $this->where('name', 'LIKE', "%{$keySearch}%")->orWhere('email', 'LIKE', "%{$keySearch}%")->paginate($totalPage);
    }

    public function getZipcodeAttribute($value)
    {
        return substr($value, 0,5). '-' .substr($value, 5,3);
    }

    public function getCreditorAttribute($value)
    {
        return ($value === 1 ? 'Sim' : 'Não');
    }

    public function getDebtorAttribute($value)
    {
        return ($value === 1 ? 'Sim' : 'Não');
    }

    public function getDocumentAttribute($value)
    {
        return substr($value, 0, 2).'.'.substr($value, 2,3).'.'.substr($value, 5,3).'/'.substr($value, 8,4).'-'.substr($value,12,2);
    }

    public function getIsActiveAttribute($value)
    {
        return ($value === 1 ? 'Ativo' : 'Inativo');
    }
}
