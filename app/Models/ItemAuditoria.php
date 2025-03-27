<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemAuditoria extends Model
{    
    protected $table = 'itens_auditoria';
    use HasFactory;

    // Definir os campos que podem ser preenchidos em massa
    protected $fillable = [
        'auditoria_id', 
        'tipo', 
        'descricao', 
        'imagem', 
        'ordem',
    ];

    // Relacionamento com a auditoria
    public function auditoria()
    {
        return $this->belongsTo(Auditoria::class);
    }

    // Relacionamento com as imagens
    public function imagens()
    {
        return $this->hasMany(ImagensItemAuditoria::class);
    }
}
