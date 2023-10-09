<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles,HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_number',
        'last_name',
        'first_name',
        'middle_name',
        'user_name',
        'division_id',
        'profession_id',
        'email',
        'password',
        'employment',
        'dismissal',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'employee_number' => 'integer',
        'last_name'=>'string',
        'first_name'=>'string',
        'middle_name'=>'string',
        'user_name'=>'string',
        'division_id'=>'integer',
        'profession_id'=>'integer',
        'email'=>'string',
        'email_verified_at' => 'datetime',
        'employment' => 'date:Y-m-d',
        'dismissal' => 'date:Y-m-d',
    ];

    /**
     * Установить Имя пользователя
     *
     * @return Attribute
     */
    protected function firstName(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::ucfirst(Str::lower($value)),
        );
    }

    /**
     * Установить Фамилию пользователя
     *
     * @return Attribute
     */
    protected function lastName(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::ucfirst(Str::lower($value)),
        );
    }

    /**
     * Установить Отчество пользователя
     *
     * @return Attribute
     */
    protected function middleName(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::ucfirst(Str::lower($value)),
        );
    }
    /**
     * Вернуть Фамилия И.О.
     *
     * @return Attribute
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->last_name.' '.Str::substr($this->first_name, 0, 1).'.'.Str::substr($this->middle_name, 0, 1).'.'
        );
    }
    /**
     * Устанавливаем дату для полей
     *
     * @return Attribute
     */
    protected function employment(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('Y-m-d'),
        );
    }

    /**
     * Устанавливаем дату человеко подобного отображения
     *
     * @return Attribute
     */
    protected function employmentHuman(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->employment)->format('d.m.Y'),
        );
    }

    /**
     * Установить хеширование для пароля
     *
     * @return Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Hash::make($value),
        );
    }

    /**
     * Путь для папки сохранения
     *
     * @return Attribute
     */
    protected function testFirst(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::replace(' ', '_', $this->division->department->branch->title).'/'.$this->division->department->title.'/'.$this->division->short_title.'/'.$this->last_name
        );
    }
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function personalCard(): HasOne
    {
        return $this->HasOne(PersonalCard::class);
    }

    public function profession(): BelongsTo
    {
        return $this->belongsTo(Profession::class);
    }
}
