<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifikasi'; // Tambahkan properti ini

    protected $fillable = [
        'title',
        'message',
        'status',
    ];
}
