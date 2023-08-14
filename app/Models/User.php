<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'user_id', 'id');
    }

    public function getBankBalancesUSD(): float
    {
        $bankBalancesIn = $this->transactions()
            ->where('money_type', 'bank')
            ->where('type', 'in')
            ->where('currency', 'USD')
            ->sum('amount');
        $bankBalancesOut = $this->transactions()
            ->where('money_type', 'bank')
            ->where('type', 'out')
            ->where('currency', 'USD')
            ->sum('amount');
        $bankBalances = $bankBalancesIn - $bankBalancesOut;
        return $bankBalances ?? 0;
    }

    public function getBankBalancesKHR(): float
    {
        $bankBalancesIn = $this->transactions()
            ->where('money_type', 'bank')
            ->where('type', 'in')
            ->where('currency', 'KHR')
            ->sum('amount');
        $bankBalancesOut = $this->transactions()
            ->where('money_type', 'bank')
            ->where('type', 'out')
            ->where('currency', 'KHR')
            ->sum('amount');
        $bankBalances = $bankBalancesIn - $bankBalancesOut;
        return $bankBalances ?? 0;
    }

    public function getCashUSD(): float
    {
        $cashIn = $this->transactions()
            ->where('money_type', 'cash')
            ->where('type', 'in')
            ->where('currency', 'USD')
            ->sum('amount');
        $cashOut = $this->transactions()
            ->where('money_type', 'cash')
            ->where('type', 'out')
            ->where('currency', 'USD')
            ->sum('amount');
        $cash = $cashIn - $cashOut;
        return $cash ?? 0;
    }

    public function getCashKHR(): float
    {
        $cashIn = $this->transactions()
            ->where('money_type', 'cash')
            ->where('type', 'in')
            ->where('currency', 'KHR')
            ->sum('amount');
        $cashOut = $this->transactions()
            ->where('money_type', 'cash')
            ->where('type', 'out')
            ->where('currency', 'KHR')
            ->sum('amount');
        $cash = $cashIn - $cashOut;
        return $cash ?? 0;
    }
}
