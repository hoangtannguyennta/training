<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pub extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'product_name',
        'amount',
        'price',
        'total',
        'images',
        'user_id',
    ];


    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function pubs_users()
    {
        return $this->belongsToMany('App\Models\User', 'pubs_users', 'pubs_id', 'users_id');
    }

    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = json_encode($value);
    }
}
