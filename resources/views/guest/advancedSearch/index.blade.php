@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center">
        <searchbar-component></searchbar-component>
        <advanced-search :services='{{ json_encode($services) }}'></advanced-search>
    </div>
@endsection
