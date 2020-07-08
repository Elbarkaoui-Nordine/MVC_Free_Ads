<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\AnnoncePicture;


class AnnoncePictureController extends Controller
{

    public function delete($id){
    
        $picture = AnnoncePicture::where('id','=',$id)->firstOrFail();
        if($picture->annonce->user_id == auth::id()){
            $picture->delete();
        }
        else{
            abort(404);
        }
        return redirect('/ad/edit/'.$picture->annonce->id);
    
    }

    // public function create($imgTab,$annonceId){
    //     $count = 0;
    //     foreach($imgTab as $value){
    //         $picture = new AnnoncePicture();
    //         $file = $value;
    //         $extension = $file->getClientOriginalExtension();
    //         if(in_array($extension,array('jpg', 'jpeg', 'png')))
    //         {
    //             $filename = time()+$count.'.'.$extension;
    //             $file->move('uploads/annonce/',$filename);
    //             $picture->annonce_id = $annonceId;
    //             $picture->filename = $filename;
    //             $picture->save();
    //             $count++;
    //         }
    //     } 
    // }
}