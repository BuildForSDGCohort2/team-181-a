<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Animal_Fact_sheet;
use App\Isues;
use App\Pregnant;
use App\Image;



class Animal extends Model
{

    use SoftDeletes;

    protected $guarded=[];

    public  function new_animal(array $validated,$date=null)
    {
        #calling the functions that will  format the date of birth no matter
        $date = (array_key_exists('approx_Age' ,$validated))
        ? Animal::date_of_birth_calculator($validated)
        :  Animal::date_formatter(Animal::date_of_birth_calculator($validated));

            $animal= new Animal;
            $animal->name= $validated['name'];
            $animal->species = $validated['species'];
            $animal->gender= $validated['gender'];
            $animal->birthday= $date ;
            $animal->weight= $validated['weight'];
            $animal->mother_id= $validated['mothers_name'];
            $animal->breed_id= $validated['breed_id'];
            $animal->user_id= auth()->user()->id;
            $animal->sale_status= 0;
            $animal->reproductive_status=  Animal::reproductivity_checker($validated);
            $animal->health_status=  Animal::health_checker($validated);
            $animal->father_id= 1;
            $animal->save();

        if ( $validated['gender'] =='female'&& array_key_exists('pregnancy_status',$validated)) {
            $pregnancy = new Pregnant;
                $pregnancy->pregnancy_status=0;
                $pregnancy->animal_id= $animal->id;
                $pregnancy->save();

            Isues::confirm_pregnancy($pregnancy);
        }
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

    #What thus Guy Does is calculate the age of the animal.. From varios formats
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
    private function reproductivity_checker(array $validated) #there will be a change here .. age will be checked an d the pg table will be used hre
    {
        $age =Animal::age_calculator($validated);

        if ( $validated['gender'] =='female'&& array_key_exists('pregnancy_status',$validated))  {
            return 2; #pregnant
        } elseif ($age > floor(Animal_Fact_sheet::find($validated['breed_id'])->reproductive_age/30) ) {
            return 1;#active
        } else {
            return 0;#inactive
        }

    }
    public function death_of_animal( $request)
    {
        $animal  = $this->find($request->id);
        // if (property_exists('call_vet', $request)) {

        //     Isues::summon_vet(['reason'=>'Death Of Animal']); #check for the animals previous medical records

        // }else {
        //     $animal->delete();
        // }
        $animal->delete();
    }
    public function summon_vet()
    {
        #make an alert to the vet
        #channgee the animals status to on sale .. awaiting vet

    }
    public function put_up_for_sale($request)
    {
        $animal  = $this->find($request->id);
        $animal->sale_status = 1;
        $animal->save();

        return ['animal'=>$animal, 'price'=>($request->price === null? $animal->breed->price: $request->price)];
    }
    public function sell_animal(Array $data)
    {
        if ($data['animal']->sales !==null ) {
            #get the sales record
            #add del & replace the image with the ew one that the user will so kindly provide
            $sale_record = $data['animal']->sales;
            $sale_record->amount = ($data['animal']->weight);
            $sale_record->price = $data['price'];
            $sale_record->save();
        }else {
            Sales::create([
                'prod_id'=>'ANML',
                'price'=>($data['price']),
                'amount'=>($data['animal']->weight),
                'animal_id'=>$data['animal']->id,
            ]);
        }
        if ( array_key_exists('picture', $data)) {
            // if ($data['picture'] !== null) {
            $path = $data['picture']->store('animals','s3');
            $this->image_url = $path;
            $this->save();
        }
    }
    public function view_picture()
    {
        return Image::get_image($this);
    }

    private function health_checker(array $validated)
    {
        if (array_key_exists('health_status',$validated)) {
            return 1;
        }else {
            return 0;
        }
    }


    public function farmer(){
        return $this->belongsTo('App\User','user_id');
    }
    public function breed(){
        return $this->belongsTo('App\Animal_Fact_sheet');
    }
    public function sales()
    {
        return $this->hasOne('App\Sales');
    }
    public function pregnant()
    {
        return $this->hasMany('App\Pregnant','animal_id');
    }
    public function sick()
    {
        return $this->hasMany('App\Animal_Ailments','animal_id');
    }
    public function waaiting(Type $var = null)
    {
        return $this->hasMany('App\Waiting');
    }


}

#the cows rartind eill be automatically calculated by a js fxn to reside in the client <side
# could an api reside on the front end?
