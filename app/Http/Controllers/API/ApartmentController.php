<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApartmentResource;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return Apartment::with(['services'])->paginate(5);

        /* per personalizzarci la risposta */
        //function($query){$query->where('addres', request('address'))};

        /*  // return Apartment::with(['services'])->paginate(5);

        /* per personalizzarci la risposta */
        //function($query){$query->where('addres', request('address'))};


        //$apart = Apartment::where('address', 'like', 'Powlowski');
        //return ApartmentResource::collection($apart); */
        //ddd($request->userinput);
        //if ($request->ajax()) {


        //$apart = Apartment::where('address', 'Via Carlo Pisacane 36, 01100 Viterbo')->get();
        // }
        //SELECT * FROM 'apartments' WHERE 'n_bathroom' > request

        $aparts = Apartment::where('n_rooms', '>', intval(request('n_rooms')))
            ->where('n_bathroom', '>', intval(request('n_bathroom')))
            ->get();
        return ApartmentResource::collection($aparts);

        //return ApartmentResource::collection(Apartment::with(['services'])->paginate(5));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        //
        return new ApartmentResource(Apartment::find($apartment->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}