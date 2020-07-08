@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

<form method="POST" action="{{ route('adStore') }}" enctype="multipart/form-data">
@method('PUT')
@csrf
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title"  name="title" placeholder="Enter title">
  </div>

  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
  </div>

  <!-- <div class="custom-file">
  <input type="file" class="custom-file-input" name='picture' id="customFile">
  <label class="custom-file-label" for="customFile">Choose file</label>
</div> -->
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

  <div class="custom-file mb-5">
    <label for="images">Add pictures</label><br>
  <input type="file" id="images" name="images[]" accept="image/*" multiple>
</div>

  
<div class="form-group">
    <label for="Price">Price</label>
    <input type="text" class="form-control" id="Price"  name="price" placeholder="Enter Price">
  </div>


  <button type="submit" class="btn btn-primary">Post Ad</button>
  <p class="text-center">{{ session('msg') }}</p>

  @if($errors->any())
    <div id="error-box" class="text-center mt-2">
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
    </div>
  @endif
  
</form>

</div>
    </div>
</div>
@endsection