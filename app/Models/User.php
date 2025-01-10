<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'sur_name',
        'email',
        'password',
        'birth_date',
        'email',
        'cpf',
        'cnpj',
        'cellphone',
        'regional_council_number',
        'regional_council_state_id',
        'state_inscription_number',
        'enable_user_login',
        'administrator',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function listings(): HasMany
    {
        return $this->hasMany(
            \App\Models\Listing::class,
            'by_user_id'
        );
    }

    public function products(): HasMany
    {
        return $this->hasMany(
            \App\Models\Product::class,
            'by_user_id'
        );
    }

    public function brands(): HasMany
    {
        return $this->hasMany(
            \App\Models\Brand::class,
            'by_user_id'
        );
    }

    /**
     * Accessor for birthDate (JSON camelCase).
     *
     * @return string|null
     */
    public function getBirthDateAttribute(): ?string
    {
        return $this->attributes['birth_date'];
    }

    /**
     * Accessor for birthDate (JSON camelCase).
     *
     * @return string|null
     */
    public function getRegionalCouncilNumberAttribute(): ?string
    {
        return $this->attributes['regional_council_number'];
    }

    /**
     * Accessor for stateInscriptionNumber (JSON camelCase).
     *
     * @return string|null
     */
    public function getStateInscriptionNumberAttribute(): ?string
    {
        return $this->attributes['state_inscription_number'];
    }

    /**
     * Accessor for regionalCouncilStateId (JSON camelCase).
     *
     * @return string|null
     */
    public function getRegionalCouncilStateIdAttribute(): ?string
    {
        return $this->attributes['regional_council_state_id'];
    }


    /**
     * Accessor for enableUserLogin (JSON camelCase).
     *
     * @return bool|null
     */
    public function getEnableUserLoginAttribute(): ?bool
    {
        return $this->attributes['enable_user_login'];
    }

    /**
     * Mutator for birthDate (converts JSON camelCase to DB snake_case).
     *
     * @param string|null $value
     */
    public function setBirthDateAttribute(?string $value): void
    {
        $this->attributes['birth_date'] = $value;
    }

    /**
     * Mutator for birthDate (converts JSON camelCase to DB snake_case).
     *
     * @param string|null $value
     */
    public function setRegionalCouncilNumberAttribute(?string $value): void
    {
        $this->attributes['regional_council_number'] = $value;
    }

    /**
     * Accessor for birthDate (converts JSON camelCase to DB snake_case).
     *
     * @return string|null
     */
    public function setStateInscriptionNumberAttribute(?string $value): void
    {
        $this->attributes['state_inscription_number'] = $value;
    }

    /**
     * Accessor for birthDate (converts JSON camelCase to DB snake_case).
     *
     * @return string|null
     */
    public function setRegionalCouncilStateIdAttribute(?string $value): void
    {
        $this->attributes['regional_council_state_id'] = $value;
    }

    /**
     * Accessor for enableUserLogin (converts JSON camelCase to DB snake_case).
     *
     * @return string|null
     */
    public function setEnableUserLoginAttribute(?bool $value): void
    {
        $this->attributes['enable_user_login'] = $value;
    }
}
