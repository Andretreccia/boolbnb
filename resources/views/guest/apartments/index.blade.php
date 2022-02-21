@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center hero_image">
    </div>
    <div class="container-fluid d-flex justify-content-center">
        <searchbar-component></searchbar-component>
        <div class="container d-flex justify-content-center flex-wrap">

            @forelse ($apartments as $apartment)
                <a href="{{ route('guest.apartments.show', $apartment->slug) }}" class="card  m-5" style="width: 40%">
                    <img class="card-img-top" src="{{ asset('storage/' . $apartment->image) }}" alt="Card image cap">
                    <p class="card-text">{{ $apartment->title }}</p>
                    <p class="card-text">{{ $apartment->description }}</p>
                </a>
            @empty
                <p>no data</p>
            @endforelse
        </div>
    </div>
    <div class="container-fluid d-flex justify-content-center">
        {{ $apartments->links() }}
    </div>
@endsection
