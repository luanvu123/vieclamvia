<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subcategory_id',
        'name',
        'image',
        'description',
        'short_description',
        'quantity',
        'price',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }
      public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    /**
     * Lấy số lượng hàng tồn kho thực tế
     *
     * @return int
     */
    public function getStockCountAttribute()
    {
        return $this->stocks()->count();
    }

    /**
     * Cập nhật số lượng thực tế từ bảng stock
     */
    public function updateQuantityFromStock()
    {
        $this->quantity = $this->stocks()->count();
        $this->save();

        return $this->quantity;
    }
}
