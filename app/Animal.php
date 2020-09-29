<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Animal_Fact_sheet;

class Animal extends Model
{

    protected $guarded=[];

    public  function new_animal(array $validated,$date=null)
    {
        #calling the functions that will  format the date of birth no matter
        $date = (array_key_exists('approx_Age' ,$validated))
        ? Animal::date_of_birth_calculator($validated)
        :  Animal::date_formatter(Animal::date_of_birth_calculator($validated));

        Animal::create([
            'name'=>$validated['name'],
            'species'=> $validated['species'],
            'gender'=>$validated['gender'],
            'birthday'=>$date ,
            'weight'=>$validated['weight'],
            'mother_id'=>$validated['mothers_name'],
            'breed_id'=>$validated['breed_id'],
            'user_id'=>auth()->user()->id,
            'sale_status'=>0,
            'reproductive_status'=> Animal::reproductivity_checker($validated),
            'health_status'=> Animal::health_checker($validated),
            'father_id'=> 1,

        ]);
    }

    private function date_of_birth_calculator(array $validated)
    {
         #now to exactly calculate the birthdate incase teh user approximatded
         if (! is_null($validated['approx_age']) && array_key_exists('approximation',$validated) && is_null($validated['birthday'])){
            #if the user approximated in months the months
            if ($validated['approximation'] == 'months') {
                $months = $validated['approx_age'];
                #conversion
                if ($months > 12) {
                    #convert them to years
                    $yr_diff =round($months/12,0);
                    #get the extra months
                    $month_diff = $months%12;
                    $birthyear = strval(date('Y')-$yr_diff);
                    $birthmonth = strval(12- $month_diff);
                   $birthday = ($birthmonth.'/'.date('d').'/'.$birthyear);
                } elseif(date('m') < $validated['approx_age'] ) {
                   $birthyear = date('Y')- 1;
                   $month_diff =  date('m')-$validated['approx_age'];
                   $birthmonth = 12 + $month_diff;
                   $birthday = ($birthmonth.'/'.date('d').'/'.date('Y'));
                }elseif (date('m')-$validated['approx_age'] == 0) {
                    $birthday =  ('1'.'/'.date('d').'/'.date('Y'));
                }else{
                    $birthday =  (date('m')-$validated['approx_age']).'/'.date('d').'/'.(date('Y'));
                }
            #if user approximated in years
            }else {
                #just subtract the year directly
                $birthday =  (date('m').'/'.date('d').'/'.(date('Y')-$validated['approx_age']));
            }
        }else {
            $birthday =  $validated['birthday'];
        }
        return $birthday;
    }
    // this will convert the Date from string format to a t=format that matches the ones already in the db
    private function date_formatter(string $date)
    {
        return date('Y-m-d' ,strtotime($date));
    }

    #What thus Guy Does is calculate the age of the animal..
    private function age_calculator(array $validated)
    {
        $birthDate = Animal::date_of_birth_calculator($validated) ;
        if (! is_null($validated['approx_age']) && array_key_exists('approximation',$validated)
            && is_null($validated['birthday']))
            {
            //explode the date to get month, day and year
            $birthDate = explode("/", $birthDate);
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
              ? ((date("Y") - $birthDate[2]) - 1)
              : (date("Y") - $birthDate[2]));
            return $age;
        } else {
            //explode the date to get month, day and year
            $birthDate = explode("-", $birthDate);
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md")
                ? ((date("Y") - $birthDate[0]) - 1)
                : (date("Y") - $birthDate[0]));
            return $age;
        }



    }
    #from the animals age are we able to find out if
    private function reproductivity_checker(array $validated)
    {
        $age =Animal::age_calculator($validated);

        if ( array_key_exists('pregnancy_status',$validated))  {
            return 2; #pregnant
        } elseif ($age > Animal_Fact_sheet::find($validated['breed_id'])->reproductive_age ) {
            return 1;#active
        } else {
            return 0;#inactive
        }

    }
    private function health_checker(array $validated)
    {
        if (array_key_exists('health_status',$validated)) {
            return 0;
        }else {
            return 1;
        }
    }

    public function farmer(){
        return $this->belongsTo('App\User');
    }
    public function animal_fact_sheet(){
        return $this->belongsTo('App\Animal_Fact_sheet');
    }

}

#the cows rartind eill be automatically calculated by a js fxn to reside in the client <side
# could an api reside on the front end?
