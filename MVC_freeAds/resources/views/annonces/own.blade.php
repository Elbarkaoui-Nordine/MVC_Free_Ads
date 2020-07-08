@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($annonces->isEmpty())
                <p>You dont have any ads <a href="/ad/create">click here to make one</a></p>
            @endif

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

                <div class='row'>
                    <form action="{{ route('deleteAd', $annonce) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-primary">Delete ad</button>
                    </form>
                    <a href="/ad/edit/{{$annonce->id}}" class="btn btn-primary ml-2">Edit this ad</a>

                </div>
            </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection