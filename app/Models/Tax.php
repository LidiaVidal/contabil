<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tax extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',
        'type_tax',
        'tax_name',
        'value',
        'due_date',
        'competence_month',
        'status',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); 

    }
    public function company(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Company::class); // Certifique-se de que o caminho do modelo está correto
    }
}
