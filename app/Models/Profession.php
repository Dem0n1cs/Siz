<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profession extends Model
{
    use HasFactory;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */


    protected $fillable = [
        'title'
    ];
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
    ];

    public function standards(): HasMany
    {
        return $this->HasMany(Standard::class);
    }
}
