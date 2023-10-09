<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */

    protected $with = ['standards'];

    protected $fillable = [
        'title'
    ];
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
    ];

    public function standards()
    {
        return $this->hasMany(Standard::class)->select('id','ppe_id','profession_id','quantity','term_wear');
    }
}
