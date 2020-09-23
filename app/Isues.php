<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Isues extends Model

{

    protected $guarded=[];
    
    public function generate_issue(array $isues)
    {
        $new_issue = new Issues;
        $new_issue->reason = $isues[''];
        $new_issue->information = $isues['information'];
        $new_issue->status = 0;
        $new_issue->user_id = $isues['user_id'];
        $new_issue->save();
    }
    public function issues()
    {
        return DB::table('isues')
                ->where('user_id','=',auth()->user()->id)
                ->get();
    }
    public function get_unsolved_issues()
    {
        return DB::table('isues')
                ->where('user_id','=',auth()->user()->id)
                ->where('status','=',0)
                ->get();
        // return Isues::where(['user_id','=',auth()->user()->id],['status','=',0]);
    }

    public function issue_classifier(Type $var = null)
    {
        #This will get to classifie various isues or reminders the the user 
        #will bee geting maybe automatically generated or from the other users
        #ANM- this wll be a n animal issue identifier
        #PLNT- will be for plantation
        #POULT- will be a poultry 
        #INF- This will be information needed to complete ones profile in the system  
    }

}
