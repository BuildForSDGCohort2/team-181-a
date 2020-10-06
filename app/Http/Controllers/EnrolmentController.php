<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProfEnrols;
use App\Http\Requests\SuppliersEnrol;
use App\Http\Requests\FarmersRequest;
use App\Proffesional;
use App\Supplier;
use App\Farmer;


class EnrolmentController extends Controller
{
    //
    public function profesionals_enrole(StoreProfEnrols $request,Proffesional $prof)
    {
        $validated = $request->validated();
        $prof->new_enrolement($validated);

        return 'success';

    }
    public function suppliers_enrole(SuppliersEnrol $request , Supplier $sup )
    {   
        $validated = $request->validated();
        // return ($validated['kra']);
        // return $request;
        
        $sup->new_enrolement($validated);

        return 'Sucess!' ;

    }
    public function farmers_enrole(FarmersRequest $request ,Farmer $farmer )
    {   
        $validated = $request->validated();
        $farmer->new_enrolement($validated);
        return redirect('login')->with('info','Enter You login Details');

    }
    public function customer_enrole(FarmersRequest $request ,Customer $customer )
    {   
        $validated = $request->validated();
        $customer->new_enrolement($validated);
        return 'Sucess!' ;

    }
    
}
 