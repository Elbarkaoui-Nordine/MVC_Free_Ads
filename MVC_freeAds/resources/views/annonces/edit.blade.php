@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

<form method="POST" action="{{ route('editAd',$annonce) }}" enctype="multipart/form-data">
@method('PUT')
@csrf
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title"  name="title" value="{{$annonce->title}}">
  </div>


  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3">{{$annonce->description}}</textarea>
  </div>
  
  <div class="form-group">
      <label for="cat">Category</label>
      <select name="category" id="cat">
      <option value="">--choose a Category--</option>
      <option value="Car">Car</option>
      <option value="IT">IT</option>
      <option value="house">House</option>
      <option value="services">Services</option>
      <option value="other">Other</option>
      </select>  
  </div>

  <div class="custom-file">
      <input type="file" name="images[]" accept="image/*" multiple>
    </div>
    
    <div class="form-group">
        <label for="Price">Price</label>
        <input type="text" class="form-control" id="Price"  name="price" value="{{$annonce->price}}">
    </div>
    
    
    <button type="submit" class="btn btn-primary">Edit ad</button>
    <p class="text-center">{{ session('msg') }}</p>
</form>
<div class="row">
    @foreach($annonce->annonces_pictures as $picture)
    <div style="margin : 10px">
        <form action="{{ route('deletePic', $picture->id) }}" method="POST">
            <img style="max-width: 150px; max-height:100px;" src="http://mvc-free-ads.herokuapp.com/uploads/annonce/{{$picture->filename}}" alt="">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-primary">X</button>
                </form>
    </div>
    @endforeach
</div>

</div>
    </div>
</div>
@endsection