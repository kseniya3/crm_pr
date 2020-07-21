<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'second_name',
        'first_name',
        'middle_name',
        'contacts_telephone',
        'contacts_email',
        'description',
        'company_name',
        'user_id',
    ];
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function deals()
    {
        //return $this->belongsToMany(Deal::class);
        return $this->belongsToMany('App\Models\Deal', 'clients_has_deals','client_id','deal_id');
    }

    public function findClient($id){
        $items=Client::all();
        foreach($items as $item){
            if($item->user_id==$id){
                return $item->id;
            }
        }
    }

}
