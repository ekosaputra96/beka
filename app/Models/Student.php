<?php

namespace App\Models;

use Yajra\Auditable\AuditableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'nis'
    ];
}
