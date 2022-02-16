@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center hero_image">
    </div>
    <div class="container-fluid d-flex justify-content-center">
        <div class="container d-flex justify-content-center flex-wrap py-5">

            @forelse ($apartments as $apartment)
                <a href="{{ route('guest.apartments.show', $apartment->slug) }}" class="card card_promo m-3">
                    <img class="card-img-top thumb" src="{{ asset('storage/' . $apartment->image) }}" alt="Card image cap">
                    <p class="promo">Promotion</p>
                    <p class="card-text m-3 card_title">{{ $apartment->title }}</h2>
                    <p class="card-text m-3">{{ $apartment->description }}</p>
                    <h6 class="mx-3 service">Services</h6>
                    <div class="services mx-3 d-flex">
                        <div class="serve">
                            <div class="label_card align-items-center d-flex mb-2">
                                <img class="mx-2" height="20" src="{{ asset('img/wifi.svg') }}" alt="wifi-icon">
                                <span class="mx-2 icon_name">Wifi</span>
                            </div>
                            <div class="label_card align-items-center d-flex">
                                <img class="mx-2" height="20" src="{{ asset('img/tv.svg') }}" alt="tv-icon">
                                <span class="mx-2 icon_name">Tv</span>
                            </div>
                        </div>

                            <div class="serve_2">
                                <div class="label_card align-items-center d-flex mx-3 mb-2">
                                    <img class="mx-2" height="20" src="{{ asset('img/pool.svg') }}" alt="pool-icon">
                                    <span class="mx-2 icon_name">Pool</span>
                                </div>
                                <div class="label_card align-items-center d-flex mx-3">
                                     <img class="mx-2" height="20" src="{{ asset('img/car.svg') }}" alt="car-icon">
                                     <span class="mx-2 icon_name">Car</span>
                                </div>

                            </div>
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
