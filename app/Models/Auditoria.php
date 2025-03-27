<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome', 
        'user_id', 
        'status', 
        'data_inicio',
    ];

    public function itens()
    {
        return $this->hasMany(ItemAuditoria::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
