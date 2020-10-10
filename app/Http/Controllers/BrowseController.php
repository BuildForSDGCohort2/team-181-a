<?php

namespace App\Http\Controllers;

use App\Animal_Fact_sheet;
use App\User;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    public function professionals()
    {
        $all_users = User::all();
        $users = [];
        foreach ($all_users as $user) {
            if ($user->hasRole('vet')) {
                $users[] = $user;
            }
        }
        return view('browse.professional', compact('users'));
    }

    public function suppliers()
    {
        $all_users = User::all();
        $users = [];
        foreach ($all_users as $user) {
            if ($user->hasRole('supplier')) {
                $users[] = $user;
            }
        }
        return view('browse.suppliers', compact('users'));
    }

    public function fact_sheet($search)
    {
        return Animal_Fact_sheet::where('species', $search)->get();
    }
}
