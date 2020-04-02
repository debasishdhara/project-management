<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Company;

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

    public function addcompany(){
        return view('super.company.create');
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
        $show =  route('delete-cities',$post->id);//route('posts.show',$post->id);
        $edit =  route('edit-cities',$post->id);//route('posts.edit',$post->id);
            //&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>
           // &emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>
        $nestedData['id'] = $post->id;
        $nestedData['company_name'] = $post->company_name;
        $nestedData['company_email'] = $post->company_email;
        $nestedData['company_phone'] = $post->company_phone;
        $nestedData['company_gstin'] = $post->company_gstin;
        $nestedData['company_validity'] = $post->company_validity;
        $nestedData['company_status'] = $post->company_status;
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
}
