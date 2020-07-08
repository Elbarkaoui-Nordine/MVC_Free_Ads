<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Annonce;
use App\AnnoncePicture;

class AnnonceController extends Controller
{
    //
    public function index(){
        $annonces = Annonce::latest()->paginate(10);
        return view('annonces.index',['annonces' => $annonces]);
    }

    public function searchIndex(){
        return view('annonces.search');
    }

    public function create(){
        return view('annonces.create');
    }

    public function userAnnonce(){
        $annonces = auth()->user()->annonces;
        return view('annonces.own',['annonces' => $annonces ]);
    }

    public function getProducts(Request $req){

        // dd(request('price1'));
        // $search = $req->search;
        
        $products = Annonce::query()

                // ->when($req->withPic, function ($query) {
                //     return $query->join('annonces_pictures', 'annonces.id''='.'annonces_pictures.annonce_id');
                // })
                
                ->when($req->search, function ($query) {
                    return $query->where(function($query){
                        $query->where('title','like','%'.request('search').'%')
                          ->orWhere('description','like','%'.request('search').'%');
                    });
                })  
                ->when($req->price1, function ($query) {
                    return $query->where('price','>=', request('price1'));
                })
                ->when($req->price2, function ($query) {
                    return $query->where('price','<=', request('price2'));
                })
                ->when($req->category, function ($query) {
                    return $query->where('category','=', request('category'));
                })
                ->latest()->paginate(10);
    
        return view('annonces.search',['annonces' => $products]);
    }   
    public function delete(Annonce $annonce){
        
        if($annonce->user_id == auth::id()){
            $annonce->delete();
        }
        else{
            abort(404);
        }
        return redirect('/ad/own');
    }

    public function edit($id){
        $annonce = Annonce::where('id','=',$id)->firstOrFail();
        return $annonce->user_id == auth::id() ? view('annonces.edit',['annonce' => $annonce]) :  abort(404);
    }

    public function update(Annonce $annonce, Request $req){
     
        request()->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|integer',
            'category' => 'required'
        ]);

        $annonce->title = $req->input('title');
        $annonce->description = $req->input('description');
        $annonce->category = $req->input('category');
        $annonce->price = $req->input('price');
        $annonce->save();

        
        if($req->hasFile('images')){
            $this->storePic(request('images'),$annonce);
        }

        return redirect('/ad/edit/'.$annonce->id)->with('msg','Your ad has been correctly added');
  
    }
    
    public function store(Request $req){
        
        request()->validate([
        'title' => 'required|max:255',
        'description' => 'required|max:255',
        'price' => 'required|integer',
        'category' => 'required'
        ]);
        
        $annonce = new Annonce();
        $annonce->user_id = Auth::id();
        $annonce->title = $req->input('title');
        $annonce->description = $req->input('description');
        $annonce->category = $req->input('category');
        $annonce->price = $req->input('price');
        $annonce->save();
        
        if($req->hasFile('images')){
            $this->storePic(request('images'),$annonce);
        }
        
        return redirect('/ad/create')->with('msg','Your ad has been correctly added');
    }
        
    public function storePic($tab , $annonce){
        $count = 0;
        foreach($tab as $value){
            $picture = new AnnoncePicture();
            $file = $value;
            $extension = $file->getClientOriginalExtension();
            if(in_array($extension,array('jpg', 'jpeg', 'png')))
            {
                $filename = time()+$count.'.'.$extension;
                $file->move('./uploads/annonce/',$filename);
                $picture->annonce_id = $annonce->id;
                $picture->filename = $filename;
                $picture->save();
                $count++;
            }
        }        
    }

}
