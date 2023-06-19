<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    // protected $guarded = 'id';
    protected $table='mahasiswa';
    protected $primaryKey='Nim';
    protected $fillable=[
        'Nim',
        'Nama',
        'kelas_id',
        'Jurusan',
        'No_Handphone',
        'Email',
        'Tanggal_Lahir',
    ];
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
