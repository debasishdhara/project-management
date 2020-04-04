<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permission;

class PermissionController extends Controller
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
        return view('super.permission.index');
    }

    public function get_permission_json(Request $request){
        $columns = array(
            0 => 'id',
            1 => 'permission_name',
            2 => 'permission_status',
            3 => 'id'
        );
        $totalData = Permission::count();
        $totalFiltered = $totalData; 
        $limit = $request->input('length')?$request->input('length') : 10;
        $start = $request->input('start')?$request->input('start') : 0;
        $order = $columns[$request->input('order.0.column')?$request->input('order.0.column'):0];
        $dir = $request->input('order.0.dir')?$request->input('order.0.dir'):'ASC';

        if(empty($request->input('search.value')))
        {            
            $posts = Permission::with('role')->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
        }
        else {
        $search = $request->input('search.value'); 

        $posts =  Permission::with('role')->where('id','LIKE',"%{$search}%")
                    ->orWhere('permission_name', 'LIKE',"%{$search}%")
                    ->orWhere('permission_status', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

        $totalFiltered = Permission::with('role')->where('id','LIKE',"%{$search}%")
                    ->orWhere('permission_name', 'LIKE',"%{$search}%")
                    ->orWhere('permission_status', 'LIKE',"%{$search}%")
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
        $nestedData['permission_name'] = $post->permission_name;
        $nestedData['permission_status'] = ($post->permission_status? 'Active' : 'Inactive');
        $nestedData['role'] = $post->role!=null ? $post->role->role_name : '-';
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


    public function view_permission(){
        return view('super.permission.create');
    }
    public function store_permission(Request $request){
        dd($request);
    }
    
}
