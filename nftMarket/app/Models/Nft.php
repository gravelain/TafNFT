<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nft extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'artiste',
        'description',
        'adresse',
        'standard',
        'prix',
        'image'
    ];
    
    public function getCategoryName(){
    
        return $this->belongsTo(Category::class);
    }
}
