<?php

namespace App\Http\Controllers\Registered;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Auth::user()->apartments()->orderByDesc('id')->paginate(5);

        return view('registered.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        // ddd($services);
        return view('registered.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'address' => 'required|max:255',
            'title' => 'required|max:255',
            'image' => 'required|image|max:500',
            'description' => 'nullable|max:65535',
            'n_rooms' => 'required|numeric|min:0|max:200',
            'n_bathroom' => 'required|numeric|min:0|max:200',
            'n_bed' => 'required|numeric|min:0|max:200',
            'square_meters' => 'required|numeric|min:0|max:5000',
            'visibility' => 'boolean',
            'latitude' => 'required',
            'longitude' => 'required',
            'services' => 'required',
        ]);

        if ($request->file('image')) {
            $image = Storage::put('apartments_images', $request->file('image'));
            $validate['image'] = $image;
        }
        $validate['user_id'] = Auth::id();





        /* --------slug ------- */
        $apartments_array = Apartment::all();
        $array_same_title = array();

        if ($apartments_array->count() > 0) {
            foreach ($apartments_array as $index) {
                if ($index->title == $request->title) {
                    array_push($array_same_title, $index);
                }
            }
        }
        foreach ($array_same_title as $i) {
            if ($i->slug == Str::slug($validate['title'])) {
                $validate['slug'] = Str::slug($validate['title'] . '-' . count($array_same_title));
            } else if ($i->slug == Str::slug($validate['title'] . '-' . (count($array_same_title)))) {
                $validate['slug'] = Str::slug($validate['title'] . '-' . (count($array_same_title) + 1));
            }
        }
        if ($array_same_title == []) {
            $validate['slug'] = Str::slug($validate['title']);
        }

        //ddd($apartments_array);
        //ddd(last($array_same_title)->slug);
        //ddd($array_same_title);
        //ddd(Str::slug($validate['title']));
        //ddd(Str::slug($validate['title'] . '-' . count($array_same_title)));
        //ddd(Str::slug($validate['title'] . '-' . (count($array_same_title)+1)));

        /* -------------------- */






        $apartment = Apartment::create($validate);

        if ($request->has('services')) {
            $request->validate([
                'services' => 'nullable|exists:services,id'
            ]);
            $apartment->services()->attach($request->services);
            //ddd($request->services);
        };
        return redirect()->route('registered.apartments.index')->with('message', "Hai inserito un nouvo appartamento con successo.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        // return view('guest.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();
        if (Auth::id() === $apartment->user_id) {
            return view('registered.apartments.edit', compact('apartment', 'services'));
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        if (Auth::id() === $apartment->user_id) {
            $validate = $request->validate([
                'address' => 'required|max:255',
                'title' => 'required|max:255',
                'image' => 'image|max:500',
                'description' => 'nullable|max:65535',
                'n_rooms' => 'required|numeric|min:0|max:200',
                'n_bathroom' => 'required|numeric|min:0|max:200',
                'n_bed' => 'required|numeric|min:0|max:200',
                'square_meters' => 'required|numeric|min:0|max:5000',
                'visibility' => 'boolean',
                'latitude' => 'required',
                'longitude' => 'required',
                'services' => 'required',
            ]);
            if ($request->file('image')) {
                Storage::delete($apartment->image);
                $image = Storage::put('apartments_images', $request->file('image'));
                $validate['image'] = $image;
            }



            /* --------slug ------- */
            $apartments_array = Apartment::all();
            $array_same_title = array();

            if ($apartments_array->count() > 0) {
                foreach ($apartments_array as $index) {
                    if ($index->title == $request->title) {
                        array_push($array_same_title, $index);
                    }
                }
            }
            foreach ($array_same_title as $i) {
                if ($i->slug == Str::slug($validate['title'])) {
                    $validate['slug'] = Str::slug($validate['title'] . '-' . count($array_same_title));
                } else if ($i->slug == Str::slug($validate['title'] . '-' . (count($array_same_title)))) {
                    $validate['slug'] = Str::slug($validate['title'] . '-' . (count($array_same_title) + 1));
                }
            }
            if ($array_same_title == []) {
                $validate['slug'] = Str::slug($validate['title']);
            }
            /* -------------------- */




            $apartment->update($validate);
            $apartment->services()->sync($request->services);

            return redirect()->route('registered.apartments.index')->with('message', "Hai modificato l'appartamento in $apartment->address con successo.");
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        if (Auth::id() === $apartment->user_id) {
            Storage::delete($apartment->image);
            $apartment->delete();

            return redirect()->route('registered.apartments.index')->with('message', "Hai eliminato l'appartamento in $apartment->address con successo.");
        } else {
            abort(403);
        }
    }

    public function showStatistics(Apartment $apartment)
    {
        
        $views_years = [];
        $views_months = [
            '1' => [],
            '2' => [],
            '3' => [],
            '4' => [],
            '5' => [],
            '6' => [],
            '7' => [],
            '8' => [],
            '9' => [],
            '10' => [],
            '11' => [],
            '12' => [],
        ];
        $times_array = [];
        

        foreach ($apartment->views as $view) {
            if (!(in_array(date("y", strtotime($view->created_at)), $views_years))){
                $anno = date("y", strtotime($view->created_at));
                array_push($views_years, $anno);
            }
        }

        foreach ($views_years as $year) {
            array_push($times_array, [$year => $views_months]);  //[$year => $views_months]
        }

        foreach ($times_array as $key0 => $index) {
            foreach ($index as $key1 => $i1) {
                foreach ($i1 as $key2 => $i2) {
                    foreach ($apartment->views as $view) {
                        if(
                        date("y", strtotime($view->created_at)) == $key1 &&
                        date("m", strtotime($view->created_at)) == $key2)
                        {
                            array_push($times_array[$key0][$key1][$key2], $view);
                        }
                    }
                }
            }
        }

        //ddd($apartment->views);
        //ddd($times_array);
        //ddd(date("y", strtotime($view->created_at)));
        ddd($views_years);
        //ddd($views_months);
        //ddd($views_years[1]);
        //ddd(date("m", strtotime($view->created_at)));

        return view('registered.statistics.index', compact('apartment'));
    }
}

