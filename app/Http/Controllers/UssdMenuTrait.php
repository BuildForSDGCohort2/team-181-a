<?php
namespace App\Http\Controllers;

trait UssdMenuTrait{

    public function newUserMenu(){
        $start  = "Welcome to The Farmers Assistant\n";
        $start .= "1. Register or Login\n";
        $start .= "2. Get Information\n";
        $start .= "3. Exit";
        $this->ussd_proceed($start);
    }
    public function returnUserMenu(){
        $con  = "Welcome back to The Farmers Assistant\n";
        $con .= "1. Login\n";
        $con .= "2. Submit Random Query\n";
        $con .= "3. Exit";
        $this->ussd_proceed($con);
    }
    public function searchMenuSelector()
    {
        $con = "Please Select the Kind Of Farm Resource You wooould like to know about\n";
        $con .="1. Animal\n";
        $con .="2. Plantations or Crops\n";
        $con .="3. Broods or Poultry\n";
        $con .="4. Proffesionals in my area\n";
        $con .="5. Custom Query";
        $this->ussd_proceed($con);
    }
    public function servicesMenu(){
        $serve = "What service are you looking for?\n";
        $serve .= "1. Get My Animal/ Plantation biodata\n"; 
        $serve .= "2. Summon Vet or FEO\n";      
        $serve .= "3. Logout";
        $this->ussd_proceed($serve);
    }
    public function custom_query_menu()
    {
        $con = 'Please Enter the specific question or query you would like help with , A professional will answer as soon as possible';
        $this->ussd_proceed($con);
                                                                                                  
    }
}