<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
    ];

    // /**
    //  * @return HasOne
    //  */
    // public function type()
    // {
    //     return $this->hasOne(Type::class, 'id', 'type_id');
    // }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
