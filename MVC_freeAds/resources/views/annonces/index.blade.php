@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            @foreach($annonces as $annonce )
            <div class="card w-75 mb-3">
            <div class="card-body">
                <h5 class="card-title">Title : {{$annonce->title}}</h5>
                <p class="card-text">Description : {{$annonce->description}}</p>
                @foreach($annonce->annonces_pictures as $picture)
                <img style="max-width: 150px;" src="http://mvc-free-ads.herokuapp.com/uploads/annonce/{{$picture->filename}}" alt="">
                @endforeach
                <p class="card-text">Category : {{$annonce->category}}</p>
                <p class="card-text">Price : {{$annonce->price}}</p>
            </div>
            </div>
            @endforeach
            <div>
                 {{ $annonces->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
