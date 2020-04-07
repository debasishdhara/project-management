<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Licence;

class LicenceController extends Controller
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
        return view('super.licence.index');
    }

    public function get_licence_json(Request $request){
        $columns = array(
            0 => 'id',
            1 => 'licence_name',
            2 => 'licence_key',
            3 => 'licence_description',
            4 => 'licence_discount',
            5 => 'licence_amount',
            6 => 'licence_net_amount',
            7 => 'licence_validity',
            8 => 'licence_from',
            9 => 'licence_to',
            10 => 'licence_mac',
            11 => 'licence_status',
            12 => 'id'
        );
        $totalData = Licence::count();
        $totalFiltered = $totalData; 
        $limit = $request->input('length')?$request->input('length') : 10;
        $start = $request->input('start')?$request->input('start') : 0;
        $order = $columns[$request->input('order.0.column')?$request->input('order.0.column'):0];
        $dir = $request->input('order.0.dir')?$request->input('order.0.dir'):'ASC';

        if(empty($request->input('search.value')))
        {            
            $posts = Licence::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
        }
        else {
        $search = $request->input('search.value'); 

        $posts =  Licence::where('id','LIKE',"%{$search}%")
                    ->orWhere('licence_name', 'LIKE',"%{$search}%")
                    ->orWhere('licence_key', 'LIKE',"%{$search}%")
                    ->orWhere('licence_description', 'LIKE',"%{$search}%")
                    ->orWhere('licence_discount', 'LIKE',"%{$search}%")
                    ->orWhere('licence_amount', 'LIKE',"%{$search}%")
                    ->orWhere('licence_net_amount', 'LIKE',"%{$search}%")
                    ->orWhere('licence_validity', 'LIKE',"%{$search}%")
                    ->orWhere('licence_from', 'LIKE',"%{$search}%")
                    ->orWhere('licence_to', 'LIKE',"%{$search}%")
                    ->orWhere('licence_mac', 'LIKE',"%{$search}%")
                    ->orWhere('licence_status', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

        $totalFiltered = Licence::where('id','LIKE',"%{$search}%")
                    ->orWhere('licence_name', 'LIKE',"%{$search}%")
                    ->orWhere('licence_key', 'LIKE',"%{$search}%")
                    ->orWhere('licence_description', 'LIKE',"%{$search}%")
                    ->orWhere('licence_discount', 'LIKE',"%{$search}%")
                    ->orWhere('licence_amount', 'LIKE',"%{$search}%")
                    ->orWhere('licence_net_amount', 'LIKE',"%{$search}%")
                    ->orWhere('licence_validity', 'LIKE',"%{$search}%")
                    ->orWhere('licence_from', 'LIKE',"%{$search}%")
                    ->orWhere('licence_to', 'LIKE',"%{$search}%")
                    ->orWhere('licence_mac', 'LIKE',"%{$search}%")
                    ->orWhere('licence_status', 'LIKE',"%{$search}%")
                    ->count();
        }

        $data = array();
        if(!empty($posts))
        {
        foreach ($posts as $post)
        {
            $show =  "deleteData($post->id)";//oute('delete-cities',$post->id);//route('posts.show',$post->id);
            $edit =  route('edit-licences',$post->id);//route('edit-cities',$post->id);//route('posts.edit',$post->id);
                //&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>
           // &emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>

        $nestedData['id'] = $post->id;
        $nestedData['licence_name']=$post->licence_name;
        $nestedData['licence_key']=$post->licence_key;
        $nestedData['licence_description']=$post->licence_description;
        $nestedData['licence_discount']=$post->licence_discount;
        $nestedData['licence_amount']=$post->licence_amount;
        $nestedData['licence_net_amount']=$post->licence_net_amount;
        $nestedData['licence_validity']=$post->licence_validity;
        $nestedData['licence_from']=$post->licence_from;
        $nestedData['licence_to']=$post->licence_to;
        $nestedData['licence_mac']=$post->licence_mac;
        $nestedData['licence_status']=($post->licence_status ? 'Active' : 'Inactive');
        $nestedData['action'] = (!$post->licence_pre_status ? "&emsp;<a href='{$edit}' title='Edit' ><span class='fa fa-edit'></span></a>
        &emsp;<a href='javascript:void(0);' onclick='{$show}' title='Delete' ><span class='fa fa-trash'></span></a>" : "-");
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


    
    public function view_licence(){
        return view('super.licence.create');
    }

    
    public function store_licence(Request $request){
        /**
        * licence_name
        * licence_key
        * licence_description
        * licence_discount
        * licence_amount
        * licence_tax
        * licence_taxableamount
        * licence_net_amount
        * licence_validity
        * licence_from
        * licence_to
        * licence_user_limit
        * licence_mac
        * licence_status
        */
        $validator = Validator::make($request->all(), [
            'licence_name' => 'required|string|max:255|unique:licences,licence_name',
            'licence_description' => 'required|string',
            'licence_amount' => 'required|numeric',
            'licence_discount' => 'required|numeric',
            'licence_tax' => 'required|numeric',
            'licence_taxableamount' => 'required|numeric',
            'licence_net_amount' => 'required|numeric',
            'licence_validity' => 'required|numeric',
            'licence_user_limit' => 'required|numeric',
        ]);
            //dd($request->input('country_status'));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            DB::beginTransaction();
            try{// Commit To DB
                $licence_key=$this->generateBarcodeNumber();
                $licence_name=$request->input('licence_name');
                $licence_description=$request->input('licence_description');
                $licence_amount=$request->input('licence_amount');
                $licence_discount=$request->input('licence_discount');
                $licence_tax=$request->input('licence_tax');
                $licence_taxableamount=$request->input('licence_taxableamount');
                $licence_net_amount=$request->input('licence_net_amount');
                $licence_validity=$request->input('licence_validity');
                $licence_user_limit=$request->input('licence_user_limit');
                $licence_status=$request->input('licence_status') ? true : false;

                $licence_details = new Licence;
                $licence_details->licence_key=$licence_key;
                $licence_details->licence_name=$licence_name;
                $licence_details->licence_description=$licence_description;
                $licence_details->licence_amount=$licence_amount;
                $licence_details->licence_discount=$licence_discount;
                $licence_details->licence_tax=$licence_tax;
                $licence_details->licence_taxableamount=$licence_taxableamount;
                $licence_details->licence_net_amount=$licence_net_amount;
                $licence_details->licence_validity=$licence_validity;
                $licence_details->licence_user_limit=$licence_user_limit;
                $licence_details->licence_status=$licence_status;
                $licence_details->save();
                //return redirect()->back()->with(['error' => 'Unable To Update Licence Due To: '])->withInput();
                DB::commit();
                return redirect()->route('fetch-licence')->with(['success' => 'Licence Updated Successfully']);
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back()->with(['error' => 'Unable To Update Licence Due To: ' . $exception->getMessage()])->withInput();
            }
        }
    }

    function generateBarcodeNumber() {
        $charfromme='D';
        $chars = array($charfromme,'D','E','B','A','S','I','S','H',0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K',0,1,2,3,4,5,6,7,8,9,'L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',0,1,2,3,4,5,6,7,8,9);
        $serial = '';
        $max = count($chars)-1;
        for($i=0;$i<40;$i++){
            $serial .= (!($i % 8) && $i ? '-' : '').$chars[rand(0, $max)];
        }
        $number = $serial;
        // call the same function if the barcode exists already
        if ($this->barcodeNumberExists($number)) {
            return generateBarcodeNumber();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }
    
    function barcodeNumberExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Licence::where('licence_key',$number)->exists();
    }
    

    public function edit_licence(Request $request){
        $licence_details=Licence::find($request->licence_id);
        return view('super.licence.edit',compact('licence_details'));
    }


    public function update_licence(Request $request){
        $validator = Validator::make($request->all(), [
            'licence_name' => 'required|string|max:255|unique:licences,licence_name,'.$request->licence_id,
            'licence_description' => 'required|string',
            'licence_amount' => 'required|numeric',
            'licence_discount' => 'required|numeric',
            'licence_tax' => 'required|numeric',
            'licence_taxableamount' => 'required|numeric',
            'licence_net_amount' => 'required|numeric',
            'licence_validity' => 'required|numeric',
            'licence_user_limit' => 'required|numeric',
        ]);
            //dd($request->input('country_status'));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            DB::beginTransaction();
            try{// Commit To DB
                $licence_name=$request->input('licence_name');
                $licence_description=$request->input('licence_description');
                $licence_amount=$request->input('licence_amount');
                $licence_discount=$request->input('licence_discount');
                $licence_tax=$request->input('licence_tax');
                $licence_taxableamount=$request->input('licence_taxableamount');
                $licence_net_amount=$request->input('licence_net_amount');
                $licence_validity=$request->input('licence_validity');
                $licence_user_limit=$request->input('licence_user_limit');
                $licence_status=$request->input('licence_status') ? true : false;

                $licence_details = Licence::find($request->licence_id);
                $licence_details->update(array('licence_name'=>$licence_name,
                'licence_description'=>$licence_description,
                'licence_amount'=>$licence_amount,
                'licence_discount'=>$licence_discount,
                'licence_tax'=>$licence_tax,
                'licence_taxableamount'=>$licence_taxableamount,
                'licence_net_amount'=>$licence_net_amount,
                'licence_validity'=>$licence_validity,
                'licence_user_limit'=>$licence_user_limit,
                'licence_status'=>$licence_status));
                //return redirect()->back()->with(['error' => 'Unable To Update Licence Due To: '])->withInput();
                DB::commit();
                return redirect()->route('fetch-licence')->with(['success' => 'Licence Updated Successfully']);
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back()->with(['error' => 'Unable To Update Licence Due To: ' . $exception->getMessage()])->withInput();
            }
        }
    }

    public function delete_licence(Request $request){
        $licence_id=$request->licence_id;
        $licence_details= Licence::find($licence_id);
        DB::beginTransaction();
        try {
            $licence_details->update(array('licence_status'=>false));
            DB::commit();
            return redirect()->route('fetch-licence')->with(['success' => 'Licence Deleted Successfully']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Unable To Deleted Licence Due To: ' . $exception->getMessage()])->withInput();
        }
    }
    
}
