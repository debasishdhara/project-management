<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Permission;
use App\Role;

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
        $show =  "deleteData($post->id)";//oute('delete-cities',$post->id);//route('posts.show',$post->id);
        $edit =  route('edit-permission',$post->id);//route('edit-cities',$post->id);//route('posts.edit',$post->id);
            //&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>
           // &emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>
        $nestedData['id'] = $post->id;
        $nestedData['permission_name'] = $post->permission_name;
        $nestedData['permission_status'] = ($post->permission_status? 'Active' : 'Inactive');
        $role_names='';
        $rco=0;
        foreach ($post->role as $key => $ro) {
            if($rco==0){ 
                $rco++; $role_names=$role_names." ".$ro->role_name;
            }
            else{
                 $role_names=$role_names." </br> ".$ro->role_name;
            }
        }
        $nestedData['role'] = $role_names;
        $nestedData['action'] = "&emsp;<a href='{$edit}' title='EDIT' ><span class='fa fa-edit'></span></a>
        &emsp;<a href='javascript:void(0);' onclick='{$show}' title='SHOW' ><span class='fa fa-trash'></span></a>";
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
        $role_all =Role::all();
        return view('super.permission.create',compact('role_all'));
    }


    public function store_permission(Request $request){
       $validator = Validator::make($request->all(), [
        'permission_title' => 'required|string|max:255|unique:permissions,permission_name',
        'role_id' => 'required|array'
        ]);
            //dd($request->input('country_status'));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            DB::beginTransaction();
            try{// Commit To DB
                // Update country
                $permission_name = $request->input('permission_title');
                $role_id = $request->input('role_id');
                $permission_status = $request->input('permission_status') != null ? true : false;
                //dd($city_status);
                $permissio= new Permission;
                $permissio->permission_name=$permission_name;
                $permissio->permission_status=$permission_status;
                $permissio->save();
                $permissiondetails=Permission::find($permissio->id);
                $permissiondetails->role()->attach($role_id);
                DB::commit();
                return redirect()->route('fetch-permission')->with(['success' => 'Permission Updated Successfully']);
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back()->with(['error' => 'Unable To Update Permission Due To: ' . $exception->getMessage()])->withInput();
            }
        }
    }


    public function edit_permission(Request $request){
        $permission_details=Permission::with('role')->find($request->permission_id);
        $role_all =Role::all();
        $role_details=$permission_details->role->map(function($item,$key){
            return $item->id;
        });

        $role_count=Role::count();
        $r_count=count($role_details);
        return view('super.permission.edit',compact('role_all','permission_details','role_details','role_count','r_count'));
    }

    public function update_permission(Request $request){
        $validator = Validator::make($request->all(), [
            'permission_title' => 'required|string|max:255|unique:permissions,permission_name,'.$request->permission_id,
            'role_id' => 'required|array'
        ]);
            //dd($request->input('country_status'));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            DB::beginTransaction();
            try{// Commit To DB
                // Update country
                $permission_name = $request->input('permission_title');
                $role_id = $request->input('role_id');
                $permission_status = $request->input('permission_status') != null ? true : false;
                //dd($city_status);
                $permissio= Permission::find($request->permission_id);
                $permissio->update(array('permission_name'=>$permission_name,
                'permission_status'=>$permission_status));
                $permissiondetails=Permission::find($request->permission_id);
                $permissiondetails->role()->sync($role_id);
                DB::commit();
                return redirect()->route('fetch-permission')->with(['success' => 'Permission Updated Successfully']);
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back()->with(['error' => 'Unable To Update Permission Due To: ' . $exception->getMessage()])->withInput();
            }
        }
    }

    public function delete_permission(Request $request){
        $permission_id=$request->permission_id;
        $permission_details= Permission::find($permission_id);
        DB::beginTransaction();
        try {
            $permission_details->update(array('permission_status'=>false));
            DB::commit();
            return redirect()->route('fetch-permission')->with(['success' => 'Permission Deleted Successfully']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Unable To Deleted Permission Due To: ' . $exception->getMessage()])->withInput();
        }
    }
    
    
}
