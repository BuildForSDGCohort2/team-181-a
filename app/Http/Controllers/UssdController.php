<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use DB;

class UssdController extends Controller
{

    use UssdMenuTrait;
    use SmsTrait;
    use  UssdFactFinder;
    use  RegimentsTrait;
    use FarmResourceFinderTrait;


    #this is the  master director
    public function ussdRequestHandler(Request $request)
    {

        // return $request;
        $sessionId   = $request["sessionId"];
        $serviceCode = $request["serviceCode"];
        $phone       = '+'.ltrim($request["phoneNumber"]); #this is on postman confirm on At
        $text        = $request["text"];
        header('Content-type: text/plain');

        if(User::where('phone_number', $phone)->exists()){
            // Function to handle already registered users
            $this->handleReturnUser($text, $phone);
        }else {
             // Function to handle new users
             $this->handleNewUser($text, $phone);
        }
    } 
    public function handleNewUser($ussd_string, $phone)
    {
          $ussd_string_exploded = explode ("*",$ussd_string);
  
          // Get menu level from ussd_string reply
          $level = count($ussd_string_exploded);
  
          if(empty($ussd_string) or $level == 0) {
              $this->newUserMenu(); // show the home menu
          }
  
          switch ($level) {
              case ($level == 1 && !empty($ussd_string)):
                  if ($ussd_string_exploded[0] == "1") {
                      // If user selected 1 send them to the registration menu
                      $this->ussd_proceed("Please enter your full name , Your Id or secret Pin and location separated by commas. \n eg: Jane Doe,1234,nakuru");               
                    
                    #get information anonimously
                    } else if ($ussd_string_exploded[0] == "2") {
                      $this->searchMenuSelector();

                  } else if ($ussd_string_exploded[0] == "3") {
                      //If user selected 3, exit
                      $this->ussd_stop("Thank you for reaching out to Farmers Assistant.");
                  }
              break;
              case 2:
                #check registration..
                if ( $ussd_string_exploded[0] != 2) {
                    if ($this->ussdRegister($ussd_string_exploded[1], $phone) == "success") {
                        $this->returnUserMenu();
                    }else{
                        $this->ussd_stop('There Was a Technical Error, Please Try Again later.');
                    }
                } else {
                    if ($ussd_string_exploded[1]==1) {
                        $this->ussd_proceed("Please enter the Species,Breed,Gender,Birthday(Year-month-date) or Age Approximate in months, separated by commas eg: cow,fresian,female,2020-09-12");
                    } else if($ussd_string_exploded[1]==2){
                        $this->ussd_proceed("Please enter the Type,Strain,Area covered in Acres,Planting date(Year-month-date) or Plantation Age Approximate in months, separated by commas eg: maize,katumani,30,2020-09-12");
                    } else if($ussd_string_exploded[1]==3){
                        $this->ussd_proceed("Please enter the Species,Breed,Gender\n(layers|broilers|mixed),Number,Hatching date,(Year-month-date)\n or Age Approximate in months, separated by commas \neg: chicken,kienyeji,layers,2020-09-1");
                    } else if($ussd_string_exploded[1]==4){
                        $this->ussd_proceed("Please enter the kind of service You need,\n followed by your location \n eg vet,nakuru");
                    }else if($ussd_string_exploded[1]==5){
                        $this->ussd_proceed("Enter The question ,\n if the animal concerns poultry or livestock \n sart with 'vet' \n if it concerns  crops \n start with 'officer'\n followed by the question \n eg vet,what is cows prime age?:");
                    }else{
                        $this->ussd_proceed("Invalid Input please check again : \n");
                        array_pop($ussd_string_exploded); #remove the  invalid input
                        $this->handleNewUser(implode('*',$ussd_string_exploded),$phone);

                    }
                }                 
              break;
              case 3:
                $info =  $ussd_string_exploded[2];
                if ($ussd_string_exploded[1]==1) {
                     $regiments = $this->fact_finder('anml,'.$info);
                    $this->pass_regiments($regiments,'Animal');
                    
                } else if($ussd_string_exploded[1]==2){
                    $regiments = $this->fact_finder('plnt,'.$info);
                    $this->pass_regiments($regiments,'Plantation');
                    
                } else if($ussd_string_exploded[1]==3){
                    $regiments = $this->fact_finder('brood,'.$info);
                    $this->pass_regiments($regiments,'Brood');
                
                } else if($ussd_string_exploded[1]==4){
                    $this->fact_finder('prof,'.$info,$phone);
                
                }else if($ussd_string_exploded[1]==5){
                    $this->custom_query([$phone,$ussd_string_exploded[2]]);
                }else{
                    $this->ussd_stop('Invalid Input :');

                }
              break;
            
          }
      }
      public function handleReturnUser($ussd_string, $phone)
	{ 
		$ussd_string_exploded = explode ("*",$ussd_string);

		// Get menu level from ussd_string reply
		$level = count($ussd_string_exploded);

		if(empty($ussd_string) or $level == 0) {
			$this->returnUserMenu(); // show the home/first menu
		}

		switch ($level) {
			case ($level == 1 && !empty($ussd_string)):
				if ($ussd_string_exploded[0] == "1") {
					// If user selected 1 send them to the login menu
                    $this->ussd_proceed("Kindly input your Password");                 
                } else if($ussd_string_exploded[0]=="2"){
                    #here is where we will enter the logic to seach for an animal
                    $this->searchMenuSelector();
                    #this will handle the search

                } else if ($ussd_string_exploded[0] == "3") {
					//If user selected 2, end session
					$this->ussd_stop("Thank you for reaching out to The Farmers Assistant.");
				} else {
					$this->ussd_stop("Invalid Input");
				}
			break;
			case 2:
				if ($this->ussdLogin($ussd_string_exploded[1], $phone) == "Success") {
					$this->servicesMenu();
				}
			break;
			case 3:
				if ($ussd_string_exploded[2] == "1") {                   
					$this->ussd_proceed("Enter the animal or Plantation id \n in the following format \n animal-008 ");
					// $this->sendText("You have successfully subscribed to updates from SampleUSSD.",$phone);
				} else if ($ussd_string_exploded[2] == "2") {
					$this->ussd_proceed("Enter the animal or plantation id \n followed by the service you would like to recieve\n eg animal-1,castration or plantation-4,expansion");
				} else if ($ussd_string_exploded[2] == "3") {
					$this->ussd_stop("Thanks for reaching out to The Farmers Assistant.");              
				} else {
					$this->ussd_stop("Invalid input!");
				}
            break;
            case 4:
                if ($ussd_string_exploded[2]=="1") {
                    $this->find_resource($phone,$ussd_string_exploded[3]);
                } else if($ussd_string_exploded[2]=="2") {
                     echo $ussd_string_exploded[3];
                     $this->summon_proffesional($ussd_string_exploded[3],$phone);
                }else{
                    $this->ussd_stop("Invalid input!");
                }
                
            break;
            case 5:
                if ($ussd_string_exploded[2]=="1") {
                     $this->find_resource($phone,$ussd_string_exploded[3]);
                } else {
                    $this->ussd_proceed("Please enter the kind of proffesional You need,\n  The specific service you need\n The Resource that needs the service  \n eg vet,castration,dehorning..,animal-001");
                }
                
            break;


		}
    }
    public function ussdRegister($details, $phone)
    {
        $input = explode(",",$details);//store input values in an array
        $full_name = $input[0];//store full name
        $pin = $input[1]; 
        $location = $input[2];       
       
        $user = new User;
        $user->name = $full_name;
        $user->phone_number = $phone;
        $user->email = $phone."@farmers.com";
        $user->location = $location;
        // You should encrypt the pin
        $user->password = Hash::make($pin);
        $user->assignRole('farmer');
        $user->save();
        // Auth::login($user);
        return 'success';
    }
 
    /**
     * Handles Login Request
     */
    public function ussdLogin($details, $phone)
    {
        $user = User::where('phone_number', $phone)->first();

        if (Hash::check( $details, $user->password) ) {
            return "Success";           
        } else {
            return $this->ussd_stop("Login was unsuccessful!");
        }
    }
    
    #this will handle the incoming requests
    public function ussd_proceed($ussd_text) {
          echo "CON $ussd_text";}
    
    public function ussd_stop($ussd_text) { 
         echo "END $ussd_text";}
    
}