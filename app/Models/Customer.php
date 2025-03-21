<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'name',
        'avatar',
        'phone',
        'url_facebook',
        'isApi',
        'is2Fa',
        'google2fa_secret',
        'idCustomer',
        'Balance',
        'isOnline',
        'Status',
        'password',
        'google_id',
        'last_active_at',
        'account_number',
        'type_customer_id'

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $dates = ['last_active_at'];
    protected $casts = [
        'last_active_at' => 'datetime',
    ];

    public static function generateUniqueId()
    {
        do {
            // Tạo mã 6 chữ số ngẫu nhiên
            $idCustomer = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (self::where('idCustomer', $idCustomer)->exists());

        return $idCustomer;
    }
    public function loginHistories()
    {
        return $this->hasMany(LoginHistory::class);
    }
    // App\Models\Customer.php

    public function typeCustomer()
    {
        return $this->belongsTo(TypeCustomer::class, 'type_customer_id');
    }
    // Trong class Customer
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }
    public function totalDeposit()
    {
        return $this->deposits()
            ->where('type', 'nạp tiền')
            ->where('status', 'thành công')
            ->sum('money');
    }
    public function getNewDepositsCountAttribute(): int
    {
        return $this->deposits()
            ->where('created_at', '>=', Carbon::now()->subHours(24))
            ->count();
    }
}
