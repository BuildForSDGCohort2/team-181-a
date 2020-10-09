<?php

namespace App\Http\Controllers;
use App\Isues;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public   function mark_as_read(Requesr $request, Isues $isue)
    {   
        #the  Request will carry the isue id
        $isue->read($request);
    }
}
