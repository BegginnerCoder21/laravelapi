<?php

declare(strict_types=1);
namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_vat',
        'total_price_excluding_vat',
        'total_price',
        'invoice_number',
        'user_id'
    ];


    protected $casts = [
        'total_vat' => 'decimal:2',
        'total_price_excluding_vat' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
