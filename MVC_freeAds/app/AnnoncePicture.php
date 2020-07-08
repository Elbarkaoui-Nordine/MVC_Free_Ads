<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnoncePicture extends Model
{
    //
    protected $table = 'annonces_pictures';
    protected $fillable = ['annonce_id','filename'];


    public function annonce(){
        return $this->belongsTo(Annonce::class);
    }
    
}
