<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            $posts = Licence::with('role')->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
        }
        else {
        $search = $request->input('search.value'); 

        $posts =  Licence::with('role')->where('id','LIKE',"%{$search}%")
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

        $totalFiltered = Licence::with('role')->where('id','LIKE',"%{$search}%")
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
        $show =  'javascript:void(0);';//oute('delete-cities',$post->id);//route('posts.show',$post->id);
        $edit =  'javascript:void(0);';//route('edit-cities',$post->id);//route('posts.edit',$post->id);
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


    
    public function view_licence(){
        return view('super.licence.create');
    }
    public function store_licence(Request $request){
        dd($request);
    }
    
    
}
