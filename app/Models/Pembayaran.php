<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Nicolaslopezj\Searchable\SearchableTrait;

class Pembayaran extends Model
{
    use HasFactory;
    use SearchableTrait;
    protected $guarded = [];
    protected $casts = ['tanggal_bayar'=>'datetime', 'tanggal_konfirmasi' => 'datetime'];
    protected $with = ['user','tagihan'];
    protected $append = ['status_konfirmasi'];
    
    public function getStatusStyleAttribute() {
        if ($this->tanggal_konfirmasi == null) {
            return 'secondary';
        }
            return 'success';
    }

    protected $searchable = [
        
    ];
    protected function statusKonfirmasi(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($this->tanggal_konfirmasi == null) ? 'Belum dikonfirmasi' : 'Sudah dikonfirmasi'
        );
    }

    /**
     * Get the tagihan that owns the Pembayaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tagihan(): BelongsTo
    {
        return $this->belongsTo(Tagihan::class);
    }

    /**
     * Get the user that owns the Pembayaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    

            /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::created(function ($pembayaran) {
            $pembayaran->tagihan->updateStatus();
        });

        static::updated(function ($pembayaran) {
            $pembayaran->tagihan->updateStatus();
        });

        static::deleted(function ($pembayaran) {
            $pembayaran->tagihan->updateStatus();
        });
        
        static::creating(function ($tagihan) {
            $tagihan->user_id = auth()->user()->id;
        });

        static::updating(function ($tagihan) {
            $tagihan->user_id = auth()->user()->id;
        });
    }

    /**
     * Get the user that owns the Pembayaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Get the bankSkynet that owns the Pembayaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bankSkynet(): BelongsTo
    {
        return $this->belongsTo(BankSkynet::class);
    }
}
