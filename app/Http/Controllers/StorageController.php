<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\H_SchedulerRequest;
use App\Http\Requests\StorageRequest;


use App\Storage;
use App\Plantation;
use App\Isues;

class StorageController extends Controller
{   #h_scheduler is the class resposnible for handling  requests to schedule harests
    public function schedule_harvest(H_SchedulerRequest $request, Isues $isue)
    {   
        // return ($request);
        $scheduled = $isue->make_harvest_reminder($request);
        $produce =  $plant->find($request->id);
        $produce->book_harvest();
        return $produce;
        

    }
    public function harvest(StorageRequest $request,Storage $store)
    {   
        $stored = $store->store($request);
        return redirect('plant')->with('message','Stored Succesfully');

    }
    public function sell()
    {
        # code...
    }
    public function all_items()
    {
        $user_items = auth()->user()->stored_products;
        return view('storage.index')->with('user_items',$user_items);
    }
}
