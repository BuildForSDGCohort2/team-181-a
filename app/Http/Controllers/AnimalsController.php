<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnimalStore;
use App\Animal;


class AnimalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request , Animal $animal)
    {
        $animals = $animal->paginate();
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function death(Request $request,Animal $animal)
    {
        $animal->death_of_animal($request);
        return redirect('animal');
    }
    public function sell_animal(Request $request,Animal $animal)
    {
        // return $request;
        $data =$animal->put_up_for_sale($request);
        $animal->sell_animal($data);
        return redirect('animal');

    }
}
