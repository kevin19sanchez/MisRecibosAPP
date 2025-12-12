<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;

class Recibo extends Model
{
    protected $table = 'recibos';

    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'issue_date',
        'due_date',
        'status',
        'description',
        'reference_code'
    ];

    protected $casts = [
        'issue_date' => 'date',
    ];

    public function user(){
        return $this->belongsTo(Usuario::class, 'user_id');
    }
}
