<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class CustomerCatalogue extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    protected $fillable = [
        'name',
        'description',
        'publish',
    ];

    protected $table = 'customer_catalogue';

    public function customers()
    {
        return $this->hasMany(Customer::class, 'customer_catalogue_id', 'id');
    }

    // public function permissions(){
    //     return  $this->belongsToMany(Permission::class, 'user_catalogue_permission' , 'user_catalogue_id', 'permission_id');
    // }
}
