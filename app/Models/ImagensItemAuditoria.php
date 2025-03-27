<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagensItemAuditoria extends Model
{
    use HasFactory;
    protected $table = 'imagens_itens_auditoria';

    // Definir os campos que podem ser preenchidos em massa
    protected $fillable = [
        'item_auditoria_id',
        'caminho_imagem',
    ];

    // Relacionamento com o item de auditoria
    public function itemAuditoria()
    {
        return $this->belongsTo(ItemAuditoria::class);
    }
}
