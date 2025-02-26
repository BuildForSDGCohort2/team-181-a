<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BroodStore;
use App\Brood;

class BroodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Brood $brood)
    {

        $broods = $brood->all()->filter(function($brood){ return $brood->number > 0 ;});
        // return $broods;

        return view('broods.index') ->with('broods',$broods);
    }


    public function store(BroodStore $request , Brood $brood)
    {
        $validated = $request->validated();
        $brood->new_brood($validated);
        return redirect('brood')->with('success','Animal Records recorded Succesfully');
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
    public function deduct(Request $request,Brood $brood)
    {
        $brood->deduct_number($request);
        return redirect('brood');
    }
    public function sell_bird(Request $request,Brood $brood)
    {
        $data =$brood->deduct_number($request);
        // return $data;
        $brood->sell_bird($data);
        return redirect('brood');

    }
}
