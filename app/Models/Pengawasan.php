<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengawasan extends Model
{
    use HasFactory;

    protected $table = 'pengawasan';

    protected $fillable = [
        'tanggal_pengawasan',
        'bidang',
        'subbidang',
        'tajuk',
        'kondisi',
        'kriteria',
        'sebab',
        'akibat',
        'rekomendasi',
        'pengawas_id',
        'eviden',
        'kondisiafter',
        'evidenafter',
        'penanggung_jawab_id',
    ];
    
}
