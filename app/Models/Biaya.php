<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Biaya extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    use LogsActivity;
    protected $guarded = [];
    protected $append = ['nama_biaya_full', 'total_tagihan'];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            // ->logOnly(['name', 'text']);
            ->logUnguarded()->logOnlyDirty();
    }
    
    protected function totalTagihan(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->children()->sum('jumlah'),
        );
    }

    // parent for biaya
    public function parent() 
    {
        return $this->belongsTo(Biaya::class, 'parent_id');
    }

    public function isChild() 
    {
        return $this->parent_id != null;
    }

    /**
     * Get all of the children for the Biaya
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Biaya::class, 'parent_id');
    }

     /**
     * Interact with the user's first name.
     */
    protected function namaBiayaFull(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->nama .' -' . $this->formatRupiah('jumlah'),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the member for the Biaya
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function member(): HasMany
    {
        return $this->hasMany(Member::class);
    }

        /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function ($biaya) {
            $biaya->user_id = auth()->user()->id;
        });

        static::updating(function ($biaya) {
            $biaya->user_id = auth()->user()->id;
        });
    }
}


