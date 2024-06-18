<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Result extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'result';

    // Incrementing primary key
    public $incrementing = false;

    // Nama kolom primary key
    protected $primaryKey = 'result_id';

    // Kolom yang dapat diisi
    protected $fillable = [
        'result_id',
        'user',
        'skor',
    ];

    // Timestamped model
    public $timestamps = true;

    // Mendapatkan semua data
    public function alldata()
    {
        return DB::table($this->table)->get();
    }

    // Mengedit data berdasarkan result_id
    public function editdata($result_id)
    {
        return DB::table($this->table)->where($this->primaryKey, $result_id)->first();
    }

    // Mendapatkan data berdasarkan user
    public function resultuser($user)
    {
        return DB::table($this->table)->where('user', $user)->get();
    }
}
