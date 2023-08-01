<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\ModelStatus\HasStatuses;

class Member extends Model
{
    use HasFactory;
    use LogsActivity;
    use SearchableTrait;
    use HasStatuses;
    protected $guarded =[];
    protected $searchable = [
        'columns' => [
            'nama' => 10,
            'idpel' => 10,
            'paket' =>10,
            //'client->name' => 10,
        ],
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            // ->logOnly(['name', 'text']);
            ->logUnguarded()->logOnlyDirty();
    }

    /**
     * Get all of the biaya for the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function biaya(): BelongsTo
    {
        return $this->belongsTo(Biaya::class);
    }

    /**
     * Get the user that owns the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user that owns the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Get all of the tagihan for the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tagihan(): HasMany
    {
        return $this->hasMany(Tagihan::class);
    }

            /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::creating(function ($member) {
            $member->user_id = auth()->user()->id;
        });

        static::created(function ($member) {
            $member->setStatus('aktif');

        });

        static::updating(function ($member) {
            $member->user_id = auth()->user()->id;
        });
    }
}
