<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Country;
use App\State;
use App\City;
use App\SubCity;

class LocationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('super-admin');
    }
    /**
     * country
     */
    public function show_country(){
        // $Country = Country::with(['state','state.city','state.city.subcity'])->get();
        return view('super.country.index');
    }
    /**
     * country edit
     */
    public function edit_country(Request $request){
        $country_details = Country::find($request->country_id);
        return view('super.country.edit',compact('country_details'));
    }

    /**
     * country update
     */
    public function update_country(Request $request){
        $country_id=$request->country_id;
        $validator = Validator::make($request->all(), [
            'country_title' => 'required|string|max:255|unique:countries,title,'.$country_id,
            'sort_name' => 'required|string|max:255',
            'phone_code' => 'required|numeric'
        ]);
            //dd($request->input('country_status'));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            DB::beginTransaction();
            try {
                // Update country
                $title = $request->input('country_title');
                $sort_name = $request->input('sort_name');
                $phone_code = $request->input('phone_code');
                $country_status = $request->input('country_status')!=null ? true : false;
                //dd($country_status);
                $country= Country::find($country_id);
               // dd($country);
                $country->update(array(
                    'title'=>$title,
                    'sort_name'=>$sort_name,
                    'phone_code'=>$phone_code,
                    'country_status'=>$country_status
                ));

                $state_details=State::where('country_id',$country_id)->get();
                State::where('country_id',$country_id)->update(array('state_status'=>$country_status));

                $state_details_ids= collect($state_details)->map(function ($item, $key){
                return $item->id;
                });

                $city_details=City::whereIn('state_id',$state_details_ids)->get();
                City::whereIn('state_id',$state_details_ids)->update(array('city_status'=>$country_status));

                $city_details_ids= collect($city_details)->map(function ($item, $key){
                return $item->id;
                });

                $subcity_details=SubCity::whereIn('city_id',$city_details_ids)->get();
                SubCity::whereIn('city_id',$city_details_ids)->update(array('subcity_status'=>$country_status));
                // Commit To DB
                DB::commit();
                return redirect()->route('fetch-countries')->with(['success' => 'Country Updated Successfully']);
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back()->with(['error' => 'Unable To Update Country Due To: ' . $exception->getMessage()])->withInput();
            }
        }
    }
    /**
     * country delete
     */
    public function delete_country(Request $request){
        $country_id=$request->country_id;
        $country_details= Country::find($country_id);
        DB::beginTransaction();
        try {
            //$country_details->where('primary_status','!=',true);
            $country_details->update(array('country_status'=>false));
           
            $state_details=State::where('country_id',$country_id)->get();
            State::where('country_id',$country_id)->update(array('state_status'=>false));

            $state_details_ids= collect($state_details)->map(function ($item, $key){
            return $item->id;
            });

            $city_details=City::whereIn('state_id',$state_details_ids)->get();
            City::whereIn('state_id',$state_details_ids)->update(array('city_status'=>false));

            $city_details_ids= collect($city_details)->map(function ($item, $key){
            return $item->id;
            });

            $subcity_details=SubCity::whereIn('city_id',$city_details_ids)->get();
            SubCity::whereIn('city_id',$city_details_ids)->update(array('subcity_status'=>false));
                
            // Commit To DB
            DB::commit();
            return redirect()->route('fetch-countries')->with(['success' => 'Country Deleted Successfully']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Unable To Deleted Country Due To: ' . $exception->getMessage()])->withInput();
        }
    }
    

    /**
     * country
     */
    public function add_country(){
        return view('super.country.create');
    }
    /**
     * state
     */
    public function store_country(Request $request){
        $validator = Validator::make($request->all(), [
            'country_title' => 'required|string|max:255|unique:countries,title',
            'sort_name' => 'required|string|max:255',
            'phone_code' => 'required|numeric'
        ]);
            //dd($request->input('country_status'));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            DB::beginTransaction();
            try {
                // Update country
                $title = $request->input('country_title');
                $sort_name = $request->input('sort_name');
                $phone_code = $request->input('phone_code');
                $country_status = $request->input('country_status')!=null ? true : false;
                //dd($country_status);
                $country= new Country;
               // dd($country);
               $country->title=$title;
               $country->sort_name=$sort_name;
               $country->phone_code=$phone_code;
               $country->country_status=$country_status;

               $country->save();
               DB::commit();
                return redirect()->route('fetch-countries')->with(['success' => 'Country Added Successfully']);
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back()->with(['error' => 'Unable To Add Country Due To: ' . $exception->getMessage()])->withInput();
            }
        }
    }
    /**
     * state
     */
    public function show_state(){

        return view('super.state.index');
    }

    /**
     * state edit add
     */
    public function add_state(){
        $country_all = Country::all();
        return view('super.state.create',compact('country_all'));
    }

    /**
     * state edit view
     */
    public function store_state(Request $request){
        $validator = Validator::make($request->all(), [
            'state_title' => 'required|string|max:255|unique:states,title',
            'country_id' => 'required|numeric'
        ]);
            //dd($request->input('country_status'));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            DB::beginTransaction();
            try {
                // Update country
                $title = $request->input('state_title');
                $country_id = $request->input('country_id');
                $state_status = $request->input('state_status')!=null ? true : false;
                //dd($state_status);
                $state= new State;
                //dd($state);
                $state->title=$title;
                $state->country_id=$country_id;
                $state->state_status=$state_status;
                $state->save();
                DB::commit();
                return redirect()->route('fetch-states')->with(['success' => 'State Added Successfully']);
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back()->with(['error' => 'Unable To Add State Due To: ' . $exception->getMessage()])->withInput();
            }
        }
    }
    /**
     * state edit view
     */
    public function edit_state(Request $request){
        $country_all = Country::all();
        $state_details = State::find($request->state_id);
        return view('super.state.edit',compact('state_details','country_all'));
    }

    /**
     * state update
     */
    public function update_state(Request $request){
        $state_id=$request->state_id;
        $validator = Validator::make($request->all(), [
            'state_title' => 'required|string|max:255|unique:states,title,'.$state_id,
            'country_id' => 'required|numeric'
        ]);
            //dd($request->input('country_status'));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            DB::beginTransaction();
            try {
                // Update country
                $title = $request->input('state_title');
                $country_id = $request->input('country_id');
                $state_status = $request->input('state_status')!=null ? true : false;
                //dd($state_status);
                $state= State::find($state_id);
                //dd($state);
                $state->update(array(
                    'title'=>$title,
                    'country_id'=>$country_id,
                    'state_status'=>$state_status
                ));

                $city_details= City::where('state_id',$state_id)->get();
                City::where('state_id',$state_id)->update(array('city_status'=>$state_status));

                $city_details_ids= collect($city_details)->map(function ($item, $key){
                        return $item->id;
                });

                $subcity_details=SubCity::whereIn('city_id',$city_details_ids)->get();
                SubCity::whereIn('city_id',$city_details_ids)->update(array('subcity_status'=>$state_status));
                // Commit To DB
                DB::commit();
                return redirect()->route('fetch-states')->with(['success' => 'State Updated Successfully']);
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back()->with(['error' => 'Unable To Update State Due To: ' . $exception->getMessage()])->withInput();
            }
        }
    }
    /**
     * state delete
     */
    public function delete_state(Request $request){
        $state_id=$request->state_id;
        $state_details= State::find($state_id);
        DB::beginTransaction();
        try {
            //$city_details->where('primary_status','!=',true);
            $state_details->update(array('state_status'=>false));
           
            $city_details= City::where('state_id',$state_id)->get();
            City::where('state_id',$state_id)->update(array('city_status'=>false));

            $city_details_ids= collect($city_details)->map(function ($item, $key){
                    return $item->id;
            });

            $subcity_details=SubCity::whereIn('city_id',$city_details_ids)->get();
            SubCity::whereIn('city_id',$city_details_ids)->update(array('subcity_status'=>false));
                
            // Commit To DB
            DB::commit();
            return redirect()->route('fetch-cities')->with(['success' => 'Country Deleted Successfully']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Unable To Deleted Country Due To: ' . $exception->getMessage()])->withInput();
        }
    }
    /**
     * city
     */
    public function show_city(){
        return view('super.city.index');
    }
    /**
     * city delete
     */
    public function delete_city(Request $request){
        $city_id=$request->city_id;
        $city_details= City::find($city_id);
        DB::beginTransaction();
        try {
            //$city_details->where('primary_status','!=',true);
            $city_details->update(array('city_status'=>false));
           
            $subcity_details=SubCity::where('city_id',$city_id)->get();
            SubCity::where('city_id',$city_id)->update(array('subcity_status'=>false));
                
            // Commit To DB
            DB::commit();
            return redirect()->route('fetch-cities')->with(['success' => 'City Deleted Successfully']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Unable To Deleted City Due To: ' . $exception->getMessage()])->withInput();
        }
    }
    /**
     * city edit view
     */
    public function edit_city(Request $request){
        $country_all = Country::all();
        
        $city_details = City::with('state')->find($request->city_id);
        $state_all = State::where('country_id', $city_details->state->country_id)->get();
        return view('super.city.edit',compact('city_details','country_all','state_all'));
    }

    /**
     * city update
     */
    public function update_city(Request $request){
        
        $city_id=$request->city_id;
        $validator = Validator::make($request->all(), [
            'city_title' => 'required|string|max:255',
            'country_id' => 'required|numeric',
            'state_id' => 'required|numeric'
        ]);
            //dd($request->input('country_status'));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
             DB::beginTransaction();
            try{// Commit To DB
                // Update country
                $title = $request->input('city_title');
                $country_id = $request->input('country_id');
                $state_id = $request->input('state_id');
                $city_status = $request->input('city_status') != null ? true : false;
                //dd($city_status);
                $city= City::find($city_id);
                $city->update(array(
                    'title'=>$title,
                    'state_id'=>$state_id,
                    'city_status'=>$city_status
                ));
                $subcity_details=SubCity::where('city_id',$city_id)->get();
                SubCity::where('city_id',$city_id)->update(array('subcity_status'=>$city_status));
                 DB::commit();
                return redirect()->route('fetch-cities')->with(['success' => 'City Updated Successfully']);
            } catch (\Exception $exception) {
                 DB::rollBack();
                return redirect()->back()->with(['error' => 'Unable To Update City Due To: ' . $exception->getMessage()])->withInput();
            }
        }
    }
    
    /**
     * city add view
     */
    public function add_city(Request $request){
        $country_all = Country::all();
        $state_all = State::all();
        return view('super.city.create',compact('country_all','state_all'));
    }

    /**
     * city add record
     */
    public function store_city(Request $request){
        $validator = Validator::make($request->all(), [
            'city_title' => 'required|string|max:255',
            'country_id' => 'required|numeric',
            'state_id' => 'required|numeric'
        ]);
            //dd($request->input('country_status'));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
             DB::beginTransaction();
            try{// Commit To DB
                // Update country
                $title = $request->input('city_title');
                $country_id = $request->input('country_id');
                $state_id = $request->input('state_id');
                $city_status = $request->input('city_status') != null ? true : false;
                //dd($city_status);
                $city= new City;
                $city->title=$title;
                $city->state_id=$state_id;
                $city->city_status=$city_status;
                $city->save();
                 DB::commit();
                return redirect()->route('fetch-cities')->with(['success' => 'City Added Successfully']);
            } catch (\Exception $exception) {
                 DB::rollBack();
                return redirect()->back()->with(['error' => 'Unable To Add City Due To: ' . $exception->getMessage()])->withInput();
            }
        }
    }
    /**
     * subcity
     */
    public function show_sub_city(){
        // $SubCity = SubCity::with(['city','city.state','city.state.country'])->get();
        return view('super.subcity.index');
    }

    /**
     * subcity
     */
    public function add_sub_city(Request $request){
        $country_all = Country::all();
        $state_all =[];
        $city_all = [];
        $country_id = $request->old('country_id');
        $state_id = $request->old('state_id');
        if($country_id){
            $state_all = State::where('country_id', $country_id)->get();
        }
        if($state_id){
            $city_all = City::where('state_id', $state_id)->get();
        }
        // $SubCity = SubCity::with(['city','city.state','city.state.country'])->get();
        return view('super.subcity.create',compact('country_all','state_all','city_all'));
    }
    

    /**
     * subcity
     */
    public function store_sub_city(Request $request){
        $validator = Validator::make($request->all(), [
            'subcity_title' => 'required|string|max:255',
            'country_id' => 'required|numeric',
            'state_id' => 'required|numeric',
            'city_id' => 'required|numeric'
        ]);
            //dd($request->input('country_status'));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
             DB::beginTransaction();
            try{// Commit To DB
                // Update country
                $title = $request->input('subcity_title');
                $country_id = $request->input('country_id');
                $state_id = $request->input('state_id');
                $city_id = $request->input('city_id');
                $zip_code= $request->input('zip_code');
                $subcity_status = $request->input('subcity_status') != null ? true : false;
                //dd($city_status);
                $subcity= new SubCity;
                $subcity->title=$title;
                $subcity->city_id=$city_id;
                $subcity->zip_code=$zip_code;
                $subcity->subcity_status=$subcity_status;
                $subcity->save();
                 DB::commit();
                return redirect()->route('fetch-sub-cities')->with(['success' => 'Sub-City Added Successfully']);
            } catch (\Exception $exception) {
                 DB::rollBack();
                return redirect()->back()->with(['error' => 'Unable To Add Sub-City Due To: ' . $exception->getMessage()])->withInput();
            }
        }
    }


    /**
     * subcity
     */
    public function delete_sub_city(Request $request){
        $sub_city_id=$request->sub_city_id;
        $sub_city_details= SubCity::find($sub_city_id);
        DB::beginTransaction();
        try {
            //$sub_city_details->where('primary_status','!=',true);
            $sub_city_details->update(array('subcity_status'=>false));
                
            // Commit To DB
            DB::commit();
            return redirect()->route('fetch-cities')->with(['success' => 'SubCity Deleted Successfully']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Unable To Deleted SubCity Due To: ' . $exception->getMessage()])->withInput();
        }
    }
    /**
     * subcity
     */
    public function edit_sub_city(Request $request){
        $subcity_details = SubCity::with(['city','city.state','city.state.country'])->find($request->sub_city_id);
        $country_all = Country::all();
        $state_all = State::where('country_id', $subcity_details->city->state->country_id)->get();
        $city_all = City::where('state_id', $subcity_details->city->state_id)->get();
        return view('super.subcity.edit',compact('subcity_details','country_all','state_all','city_all'));
    }
    /**
     * subcity
     */
    public function update_sub_city(Request $request){
        $validator = Validator::make($request->all(), [
            'subcity_title' => 'required|string|max:255',
            'country_id' => 'required|numeric',
            'state_id' => 'required|numeric',
            'city_id' => 'required|numeric'
        ]);
            //dd($request->input('country_status'));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
             DB::beginTransaction();
            try{// Commit To DB
                // Update country
                $title = $request->input('subcity_title');
                $country_id = $request->input('country_id');
                $state_id = $request->input('state_id');
                $city_id = $request->input('city_id');
                $zip_code= $request->input('zip_code');
                $subcity_status = $request->input('subcity_status') != null ? true : false;
                //dd($city_status);
                $subcity= SubCity::find($request->sub_city_id);
                $subcity->update(array('title'=>$title,
                'city_id'=>$city_id,
                'zip_code'=>$zip_code,
                'subcity_status'=>$subcity_status));
                 DB::commit();
                return redirect()->route('fetch-sub-cities')->with(['success' => 'Sub-City Updated Successfully']);
            } catch (\Exception $exception) {
                 DB::rollBack();
                return redirect()->back()->with(['error' => 'Unable To Update Sub-City Due To: ' . $exception->getMessage()])->withInput();
            }
        }
    }
    


}
