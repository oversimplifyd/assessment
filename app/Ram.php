<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ram extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'size', 'type', 'server_id'
    ];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}
