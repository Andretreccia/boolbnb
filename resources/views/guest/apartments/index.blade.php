@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center hero_image">
    </div>
    <div class="container-fluid d-flex justify-content-center">
        <div class="container d-flex justify-content-center flex-wrap py-5">

            @forelse ($apartments as $apartment)
                <a href="{{ route('guest.apartments.show', $apartment->slug) }}" class="card justify-content-between card_promo m-3">
                    <img class="card-img-top thumb" src="{{ asset('storage/' . $apartment->image) }}" alt="Card image cap">
                    <p class="promo">Promotion</p>
                    <p class="card-text m-3 card_title">{{ $apartment->title }}</h2>
                        <div class="box">
                            <p class="card-text m-3">{{ $apartment->description }}</p>
                        </div>

                    <h6 class="mx-3 service">Services</h6>
                    <div class="services mx-3 d-flex flex-wrap">


                    <!-- -------------------------- -->
                    @foreach ($apartment->services as $service) <!-- ****** -->
                        <div class="card_apart">
                            <div class="label_card p-1 me-1 align-items-center d-flex mb-2">
                                <img class="mx-2" height="20" src="../img/service_logo/{{$service->icon}}.svg" alt="{{$service->name}}">
                                <span class="mx-2 icon_name">{{$service->name}}</span>
                            </div>
                        </div>
                    @endforeach
                    <!-- -------------------------- -->


                    </div>
                    <div class="button_details p-2 w-50 justify-content-center align-items-center text-center text-white m-auto mt-4 mb-4">
                        <span>View details</span>
                    </div>
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
