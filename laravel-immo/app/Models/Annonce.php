<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Annonce extends Model
{
    use HasFactory;
    use Sortable;

    /**
     * @var mixed
     */
    private $ref_annonce;

    // permet d'ajouter le tri sur les colonnes avec le paquet Kyslik\ColumnSortable
    public $sortable = [
        'id',
        'ref_annonce',
        'prix_annonce',
        'surface_habitable',
        'created_at',
        'updated_at',
    ];
}
