<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['transaction_id', 'name', 'expanse'];

    /**
     * Get all of the transaction_products for the TransactionDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction_products()
    {
        return $this->hasMany(TransactionProduct::class);
    }
}
