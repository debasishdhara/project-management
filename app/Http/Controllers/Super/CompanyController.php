<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Company;
use App\Licence;
use App\Role;
use App\Permission;
use App\User;
use App\Country;
use App\State;
use App\City;
use App\SubCity;

class CompanyController extends Controller
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

    public function index(){
        return view('super.company.index');
    }

    public function addcompany(Request $request){
        $country_all = Country::all();
        $state_all=[];
        $user_state_all=[];
        $city_all = [];
        $user_city_all =[];
        $country_id = $request->old('country_id');
        $state_id = $request->old('state_id');
        $user_country_id = $request->old('user_country');
        $user_state_id = $request->old('user_state');

        if($country_id){
            $state_all = State::where('country_id', $country_id)->get();
        }else{
            $state_all = State::where('country_id', 101)->get();
        }
        if($state_id){
            $city_all = City::where('state_id', $state_id)->get();
        }
        if($user_country_id){
            $user_state_all = State::where('country_id', $user_country_id)->get();
        }else{
            $user_state_all = State::where('country_id', 101)->get();
        }
        if($user_state_id){
            $user_city_all = City::where('state_id', $user_state_id)->get();
        }
        return view('super.company.create',compact('country_all','state_all','city_all','user_state_all','user_city_all'));
    }


    public function get_company_json(Request $request){
        $columns = array(
            0 => 'id',
            1 => 'company_name',
            2 => 'company_email',
            3 => 'company_phone',
            4 => 'company_gstin',
            5 => 'company_validity',
            6 => 'company_status',
            7 => 'id'
        );
        $totalData = Company::count();
        $totalFiltered = $totalData; 
        $limit = $request->input('length')?$request->input('length') : 10;
        $start = $request->input('start')?$request->input('start') : 0;
        $order = $columns[$request->input('order.0.column')?$request->input('order.0.column'):0];
        $dir = $request->input('order.0.dir')?$request->input('order.0.dir'):'ASC';

        if(empty($request->input('search.value')))
        {            
            $posts = Company::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
        }
        else {
        $search = $request->input('search.value'); 

        $posts =  Company::where('id','LIKE',"%{$search}%")
                    ->orWhere('company_name', 'LIKE',"%{$search}%")
                    ->orWhere('company_email', 'LIKE',"%{$search}%")
                    ->orWhere('company_phone', 'LIKE',"%{$search}%")
                    ->orWhere('company_gstin', 'LIKE',"%{$search}%")
                    ->orWhere('company_validity', 'LIKE',"%{$search}%")
                    ->orWhere('company_status', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

        $totalFiltered = Company::where('id','LIKE',"%{$search}%")
                    ->orWhere('company_name', 'LIKE',"%{$search}%")
                    ->orWhere('company_email', 'LIKE',"%{$search}%")
                    ->orWhere('company_phone', 'LIKE',"%{$search}%")
                    ->orWhere('company_gstin', 'LIKE',"%{$search}%")
                    ->orWhere('company_validity', 'LIKE',"%{$search}%")
                    ->orWhere('company_status', 'LIKE',"%{$search}%")
                    ->count();
        }

        $data = array();
        if(!empty($posts))
        {
        foreach ($posts as $post)
        {
        $show =  'javascript:void(0);';//route('posts.show',$post->id);
        $edit =  'javascript:void(0);';//route('posts.edit',$post->id);
            //&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>
           // &emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>
        $nestedData['id'] = $post->id;
        $nestedData['company_name'] = $post->company_name;
        $nestedData['company_email'] = $post->company_email;
        $nestedData['company_phone'] = $post->company_phone;
        $nestedData['company_gstin'] = $post->company_gstin;
        $nestedData['company_validity'] = $post->company_validity;
        $nestedData['company_status'] = $post->company_status ? 'Active' : 'Inactive';
        $nestedData['action'] = "&emsp;<a href='{$edit}' title='EDIT' ><span class='fa fa-edit'></span></a>
        &emsp;<a href='{$show}' title='SHOW' ><span class='fa fa-trash'></span></a>";
        $data[] = $nestedData;

        }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')?$request->input('draw'):1),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
            );
        echo json_encode($json_data); 
    }
        /**
             * company_name
             * company_email
             * company_phone
             * company_address_line_1
             * company_address_line_2
             * company_address_line_3
             * company_state
             * company_country
             * company_pin
             * company_fax
             * company_gstin
             * company_vat
             * company_alise
             * company_validity
             * company_from
             * company_to
             * company_logo
             * company_status
             * name
             * email
             * password
             * user_status
             * user_image
             * frist_name
             * last_name
             * user_phone
             * user_address_line_1
             * user_address_line_2
             * user_address_line_3
             * user_country
             * user_state
             * user_city
             * user_pincode
        */
    public function store_company(Request $request){
        
       
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string',
            'company_email' => 'required|string|unique:users,email',
            'company_phone' => 'required|numeric',
            'company_address_line_1' => 'required|string',
            'country_id' => 'required|numeric',
            'company_gstin' => 'required|string',
            'company_logo' => 'required',
            'frist_name' => 'required|string',
            'last_name' => 'required|string',
        ]);
        
            //dd($request->input('country_status'));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            DB::beginTransaction();
            try{// Commit To DB
               
                /**
                 * Company Details
                 */
                $company_name=$request->input('company_name');
                $company_email=$request->input('company_email');
                $company_phone=$request->input('company_phone');
                $company_address_line_1=$request->input('company_address_line_1');
                $company_address_line_2=$request->input('company_address_line_2');
                $company_address_line_3=$request->input('company_address_line_3');
                $company_state=$request->input('state_id');
                $company_country=$request->input('country_id');
                $company_city=$request->input('city_id');
                $company_pin=$request->input('company_pin');
                $company_fax=$request->input('company_fax');
                $company_gstin=$request->input('company_gstin');
                $company_vat=$request->input('company_vat');
                $company_alise=$request->input('company_alise');

                /**
                 * Company Validity
                 */
                $licence_details= Licence::where('licence_pre_status', 1)->first();
                $company_validity=$licence_details->licence_validity;
                $company_start=Carbon::now();
                $company_to=$company_start->addDays($company_validity);
                $company_from=Carbon::now();
                /**
                 * user details
                 */
                $frist_name=$request->input('frist_name');
                $last_name=$request->input('last_name');
                $name=$frist_name." ".$last_name;
                $email=$request->input('company_email');
                
                $user_phone=$request->input('user_phone');
                $user_address_line_1=$request->input('user_address_line_1');
                $user_address_line_2=$request->input('user_address_line_2');
                $user_address_line_3=$request->input('user_address_line_3');
                $user_country=$request->input('user_country');
                $user_state=$request->input('user_state');
                $user_city=$request->input('user_city');
                $user_pincode=$request->input('user_pincode');
                
                $company_logo = $request->file('company_logo')->storeAs(
                    'public/company_picture', time().'.jpg'
                );
                
                $company_details = new Company;
                $company_details->company_name = $company_name;
                $company_details->company_email = $company_email;
                $company_details->company_phone = $company_phone;
                $company_details->company_address_line_1 = $company_address_line_1;
                $company_details->company_address_line_2 = $company_address_line_2;
                $company_details->company_address_line_3 = $company_address_line_3;
                $company_details->company_state = $company_state;
                $company_details->company_country = $company_country;
                $company_details->company_pin = $company_pin;
                $company_details->company_fax = $company_fax;
                $company_details->company_gstin = $company_gstin;
                $company_details->company_vat = $company_vat;
                $company_details->company_alise = $company_alise;
                $company_details->company_validity = $company_validity;
                $company_details->company_from = $company_from;
                $company_details->company_to = $company_to;
                $company_details->company_logo = $company_logo;
                $company_details->company_status = true;
                $company_details->save();

                $company_id=$company_details->id;

                $company_update=Company::find($company_id);

                $company_update->licence()->attach($licence_details->id);

                $role_details= Role::where('role_name', 'ADMIN')->first();

                $user_details = new User;
                $user_details->name = $name;
                $user_details->email = $email;
                $user_details->password = Hash::make('1234');
                $user_details->user_status = true;
                $user_details->frist_name = $frist_name;
                $user_details->last_name = $last_name;
                $user_details->user_phone = $user_phone;
                $user_details->user_address_line_1 = $user_address_line_1;
                $user_details->user_address_line_2 = $user_address_line_2;
                $user_details->user_address_line_3 = $user_address_line_3;
                $user_details->user_country = $user_country;
                $user_details->user_state = $user_state;
                $user_details->user_city = $user_city;
                $user_details->user_pincode = $user_pincode;
                $user_details->company_id = $company_id;
                $user_details->save();

                $user_update_details=User::find($user_details->id);

                $user_update_details->roles()->attach($role_details->id);

                //return redirect()->back()->with(['error' => 'Unable To Update Licence Due To: '])->withInput();
                DB::commit();
                return redirect()->route('company')->with(['success' => 'Company Updated Successfully']);
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back()->with(['error' => 'Unable To Update Company Due To: ' . $exception->getMessage()])->withInput();
            }
        }
    }
}
