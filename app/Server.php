<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Server extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'asset_id', 'name', 'brand', 'price'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function rams()
    {
        return $this->hasMany(Ram::class);
    }
}
