<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    }
}
