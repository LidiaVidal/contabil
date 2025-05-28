<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
    'name',
    'address',
    'cnpj',
    'social',
    ];
  

    public function user()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the taxes for the company.
     */
    public function tax()
    {
        return $this->hasMany(Tax::class);
    }

    /**
     * Get the accountings for the company.
     */
    public function accounting()
    {
        return $this->hasMany(Accounting::class);
    }

    /**
     * Get the financials for the company.
     */
    public function financial()
    {
        return $this->hasMany(Financial::class);
    }

}
