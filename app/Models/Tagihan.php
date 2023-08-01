<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\User;

class Tagihan extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    use SearchableTrait;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            // ->logOnly(['name', 'text']);
            ->logUnguarded();
    }

    protected $searchable = [
        'columns' => [
            'members.nama' => 10,
            'members.idpel' => 9,
        ],
        'joins' => [
            'members' => ['members.id', 'tagihans.member_id'],
        ]
    ];

    protected $guarded = [];
    protected $casts = [
        'tanggal_tagihan'=>'datetime', 
        'tanggal_jatuh_tempo'=>'datetime',
        'tanggal_lunas' => 'datetime'
    ];
    protected $with = ['user'];
    protected $append = ['total_tagihan', 'total_pembayaran'];

    public function getStatusStyleAttribute() {
        if ($this->status == 'lunas') {
            return 'success';
        }
        if ($this->status == 'baru') {
            return 'primary';
        }
        if ($this->status == 'angsur') {
            return 'warning';
        }
    }

    protected function totalTagihan(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->tagihanDetails()->sum('jumlah_biaya'),
        );
    }

    protected function totalPembayaran(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->pembayaran()->sum('jumlah_dibayar'),
        );
    }

    /**
     * Get the user that owns the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the tagihanDetails for the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tagihanDetails(): HasMany
    {
        return $this->hasMany(TagihanDetail::class);
    }

    /**
     * Get all of the pembayaran for the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function getStatusTagihanClient()
    {
        if ($this->status == 'baru') {
            return 'Belum bayar';
        }
        if ($this->status == 'lunas') {
            return 'Sudah dibayar';
        }
        return $this->status;
    }

    public function scopeClientMember($q)
    {
        return $q->whereIn('member_id', Auth::user()->getAllMemberId());
    }

    /**
     * Get the member that owns the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    // Mengubah status pada tagihan pelanggan
    public function updateStatus() {
        if ($this->total_pembayaran >= $this->total_tagihan) {
            $tanggalBayar = $this->pembayaran()
                ->orderBy('tanggal_bayar', 'desc')
                ->first()
                ->tanggal_bayar;
            $this->update([
                'status' => 'lunas',
                'tanggal_lunas' => $tanggalBayar,
            ]);
        }

        if ($this->total_pembayaran > 0 && $this->total_pembayaran < $this->total_tagihan) {
            $this->update(['status' => 'angsur', 'tanggal_lunas' => null]);
        }

        if ($this->total_pembayaran <= 0) {
            $this->update(['status' => 'baru', 'tanggal_lunas' => null]);
        }
    }

        /**
     * The "booted" method of the model.
     */
    // protected static function booted()
    // {
    //     static::creating(function ($tagihan) {
    //         $tagihan->user_id = auth()->user()->id;
    //     });

    //     static::updating(function ($tagihan) {
    //         $tagihan->user_id = auth()->user()->id;
    //     });
    // }

}
