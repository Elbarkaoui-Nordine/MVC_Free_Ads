<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    //
    protected $table = 'annonces';
    protected $fillable = ['user_id','title','description','picture','price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function annonces_pictures()
    {
        return $this->hasMany(AnnoncePicture::class);
    }
}
