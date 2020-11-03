<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnimalStore;
use App\Animal;
use App\Isues;
use App\Pregnant;
use App\User;
use Illuminate\Support\Facades\Auth;

class AnimalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request , Animal $animal)
    {
        $animals = auth()->user()->animal;
        // return $animals;
        return view('animals.index')->with('animals',$animals);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimalStore $request , Animal $animal)
    {
        $validated = $request->validated();
        // return $validated;
        $animal->new_animal($validated);
        return redirect('animal')->with('success','Animal Records recorded Succesfully');
    }

    public function death(Request $request,Animal $animal)
    {
        $animal->death_of_animal($request);
        return redirect('animal');
    }
    public function sell_animal(Request $request,Animal $animal){

        // return $request;
        $data =$animal->put_up_for_sale($request);
        $animal->sell_animal($data);
        return redirect('animal');

    }
    public function summon_proffesional(Request $request,$location=null)
    {
        if ($location==null) {
            $location = Auth::user()->location;
        }         
        #the request should be structured as follws
        # $requea['role'=> the role proffesional baeing summoned,'location'=>the loaction from witch the user summons the vet,'information'=> the information on the request eg vaccination etx ]
        $selected_proffesional = User::summon_proffesional($location);
        Isues::alert_proffesional($selected_proffesional,$request, );
    }

    public function parent()
    {
        return Pregnant::with('animal')->groupby('animal_id')->distinct()->get();
    }

}
