<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PlantationRequest;
use App\Plantation;
use App\Storage;
use App\User;


class PlantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Plantation $plantation)
    {
        
            $plantations = auth()->user()->plantations->filter(function($plantation){ return $plantation->status < 2 ;});
            return view('plants.index')->with('plantations',$plantations);
        
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
    public function store(PlantationRequest $request,Plantation $plantation)
    {
       
        $validated = $request->validated();
        $plantation->new_plantation($validated);
        return redirect('plant')->with('success','Plant Records recorded Succesfully');
    }
    public function order_regiment(Request $request, Isues $notification)
    {
        #the request should contain the regiment the user wants
        $selected_supplier = User::request_regiment($request);
        $notification->alert_supplier($selected_supplier,$request);
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
    public function destroy($id)
    {
        //
    }
}
