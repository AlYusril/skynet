<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKendala extends Model
{
    use HasFactory;

    protected $table = 'laporan_kendalas';
    protected $guarded = [];

    public function getStatusStyleAttribute() {
        if ($this->status == 'Selesai') {
            return 'success';
        }
        if ($this->status == 'Belum') {
            return 'Danger';
        }
        if ($this->status == 'On-Process') {
            return 'warning';
        }
    }
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function member() 
    {
        return $this->belongsTo(Member::class);
    }
}
