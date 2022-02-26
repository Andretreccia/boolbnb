@extends('layouts.registered')

@section('content')

    <div class="container">
         <canvas id="myChart" width="400" height="400"></canvas>
          <h2>Visualizzazioni dell'appartamento: {{ $apartment->title }}</h2>
        <p>
            Totale visualizzazioni di sempre:
            {{ count($apartment->views) }}
        </p>

        <div class='d-flex flex-column' >
            <span>2022</span>
            <span>gen, views:{{count($views_array[0][22][1])}}, messages:, </span>
            <span>feb, views:{{count($views_array[0][22][2])}}, messages:, </span>
            <span>mar, views:{{count($views_array[0][22][3])}}, messages:, </span>
            <span>apr, views:{{count($views_array[0][22][4])}}, messages:, </span>
            <span>mag, views:{{count($views_array[0][22][5])}}, messages:, </span>
            <span>giu, views:{{count($views_array[0][22][6])}}, messages:, </span>
            <span>lug, views:{{count($views_array[0][22][7])}}, messages:, </span>
            <span>ago, views:{{count($views_array[0][22][8])}}, messages:, </span>
            <span>set, views:{{count($views_array[0][22][9])}}, messages:, </span>
            <span>ott, views:{{count($views_array[0][22][10])}}, messages:, </span>
            <span>nov, views:{{count($views_array[0][22][11])}}, messages:, </span>
            <span>dec, views:{{count($views_array[0][22][12])}}, messages:, </span>


            {{-- **** ESEMPIO prossimi anni; se non ci sono views negli anni dopo non funzionano ***
                *
                *
                *
                 <span>2023</span>
            <span>gen, views:{{count($views_array[1][23][1])}}, messages:, </span>
            <span>feb, views:{{count($views_array[1][23][2])}}, messages:, </span>
            <span>mar, views:{{count($views_array[1][23][3])}}, messages:, </span>
            <span>apr, views:{{count($views_array[1][23][4])}}, messages:, </span>
            <span>mag, views:{{count($views_array[1][23][5])}}, messages:, </span>
            <span>giu, views:{{count($views_array[1][23][6])}}, messages:, </span>
            <span>lug, views:{{count($views_array[1][23][7])}}, messages:, </span>
            <span>ago, views:{{count($views_array[1][23][8])}}, messages:, </span>
            <span>set, views:{{count($views_array[1][23][9])}}, messages:, </span>
            <span>ott, views:{{count($views_array[1][23][10])}}, messages:, </span>
            <span>nov, views:{{count($views_array[1][23][11])}}, messages:, </span>
            <span>dec, views:{{count($views_array[1][23][12])}}, messages:, </span>
            <span>2024</span>
            <span>gen, views:{{count($views_array[2][24][1])}}, messages:, </span>
            <span>feb, views:{{count($views_array[2][24][2])}}, messages:, </span>
            <span>mar, views:{{count($views_array[2][24][3])}}, messages:, </span>
            <span>apr, views:{{count($views_array[2][24][4])}}, messages:, </span>
            <span>mag, views:{{count($views_array[2][24][5])}}, messages:, </span>
            <span>giu, views:{{count($views_array[2][24][6])}}, messages:, </span>
            <span>lug, views:{{count($views_array[2][24][7])}}, messages:, </span>
            <span>ago, views:{{count($views_array[2][24][8])}}, messages:, </span>
            <span>set, views:{{count($views_array[2][24][9])}}, messages:, </span>
            <span>ott, views:{{count($views_array[2][24][10])}}, messages:, </span>
            <span>nov, views:{{count($views_array[2][24][11])}}, messages:, </span>
            <span>dec, views:{{count($views_array[2][24][12])}}, messages:, </span>
                *
                *
                *
                --}}

        </div>
    </div>
@endsection

