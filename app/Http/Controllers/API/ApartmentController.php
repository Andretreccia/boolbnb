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


        /* $aparts = Apartment::with(['services'])

            ->where('address', 'like', "%" . request('address') . "%")
            ->where('n_rooms', '>', intval(request('n_rooms')))
            ->where('n_bathroom', '>', intval(request('n_bathroom')))
            ->get();
        return ApartmentResource::collection($aparts); */

        //return ApartmentResource::collection(Apartment::with(['services'])->paginate(20));

        //////////////////////////////////////////////////////////////////////////////////////////////

        //Alternative  Giuseppe method

        $requestQuery = $request->query();
        $reqServices = explode(',', $request->services);

        $aparts = Apartment::where('n_bathroom', '>', $requestQuery['n_bathroom'])
            ->where('n_rooms', '>', $requestQuery['n_rooms'])
            ->get();

        if (!empty($request->services)) {
            $aparts = Apartment::whereHas('services', function ($param) use ($reqServices) {
                $param->whereIn('service_id', $reqServices);
            })->get();
        }

        return ApartmentResource::collection($aparts);
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