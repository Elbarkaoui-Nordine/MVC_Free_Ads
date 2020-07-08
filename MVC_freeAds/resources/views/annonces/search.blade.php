@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <form method="GET" action="/search" class='mr-3'>
            <div class="form-group">
                <input type="text" class="form-control" id="search"  name="search" placeholder="Enter ad">
            </div> 
            <div class="form-group">
                <label for="exampleFormControlSelect1">Example select</label>
                <select class="form-control" id="exampleFormControlSelect1" name="category">
                <option value="">--choose a Category--</option>
                <option value="Car">Car</option>
                <option value="IT">IT</option>
                <option value="house">House</option>
                <option value="services">Services</option>
                <option value="other">Other</option>
                </select>
            </div>
            <label for="ex1">Price between</label>
            <input id="ex1" type="text" placeholder="price 1" name="price1">
            <input id="ex1" type="text" placeholder="price 2" name="price2">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        @if($errors->any())
            <div id="error-box" class="text-center mt-2">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
            </div>
        @endif
        
        </form>

        @if(isset($annonces))
        @foreach($annonces as $annonce )
            <div class="card w-75 mb-3">
            <div class="card-body">
                <h5 class="card-title">Title : {{$annonce->title}}</h5>
                <p class="card-text">Description : {{$annonce->description}}</p>
            @if(isset($annonce->annonces_pictures))
                    @foreach($annonce->annonces_pictures as $picture)
                    <img style="max-width: 150px;" src="http://mvc-free-ads.herokuapp.com/uploads/annonce/{{$picture->filename}}" alt="">
                    @endforeach
            @endif
                <p class="card-text">Category : {{$annonce->category}}</p>
                <p class="card-text">Price : {{$annonce->price}}</p>
            </div>
            </div>
            @endforeach
            @if($annonces->isEmpty())
            <p>There is no ad for this request</p>
            @else
     
            @endif
            <div>
            {{ $annonces->appends(request()->query())->links() }}
        </div>
        @endif
        </div>
    </div>
</div>
@endsection