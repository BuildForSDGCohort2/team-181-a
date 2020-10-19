<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProfEnrols;
use App\Http\Requests\SuppliersEnrol;
use App\Http\Requests\FarmersRequest;

use  App\Mail\RejectMail;

use App\Proffesional;
use App\Supplier;
use App\Farmer;
use App\Http\Requests\CustomerStore;
use App\Image;
use Illuminate\Support\Facades\Storage;

class EnrolmentController extends Controller
{
    //
    public function profesionals_enrole(StoreProfEnrols $request,Proffesional $prof)
    {

        // dd($request->all());


        $path = $request->file('file')->store('cvs' , 's3');
        $url = Storage::disk('s3')->url($path);

        dd($path, $url);



        $validated = $request->validated();
        $prof->new_enrolement($validated);

        // return 'success';
        return redirect('/')->with('success','Your account will be reviewed');

    }
    public function suppliers_enrole(SuppliersEnrol $request , Supplier $sup )
    {
        $validated = $request->validated();
        // return ($validated['kra']);
        // return $request;

      $path = $sup->new_enrolement($validated);
    //   return Image::get_image($path);
        return redirect('/')->with('success','Your account will be reviewed');

    //   return back()->withStatus(__('Your Request Has Been succesfull submitted.'));

    }
    public function farmers_enrole(FarmersRequest $request ,Farmer $farmer )
    {
        $validated = $request->validated();
        $farmer->new_enrolement($validated);
        return redirect('login')->with('info','Enter You login Details');
    }
    public function customer_enrole(CustomerStore $request ,Customer $customer )
    {
        // return $request->all();
        $validated = $request->validated();
        $customer->new_enrolement($validated);
        return 'Sucess!';
    }
    public function confirmation($id,Proffesional $proffesional)
    {
        $proffesional->confirm($id);
    }
    public function rejection($id, Proffesional $proffesional)
    {
        $proffesional->reject($id);
    }

}
