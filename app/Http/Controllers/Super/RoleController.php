<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Role;

class RoleController extends Controller
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
        return view('super.role.index');
    }

    public function get_role_json(Request $request){
        $columns = array(
            0 => 'id',
            1 => 'role_name',
            2 => 'role_status',
            3 => 'id'
        );
        $totalData = Role::count();
        $totalFiltered = $totalData; 
        $limit = $request->input('length')?$request->input('length') : 10;
        $start = $request->input('start')?$request->input('start') : 0;
        $order = $columns[$request->input('order.0.column')?$request->input('order.0.column'):0];
        $dir = $request->input('order.0.dir')?$request->input('order.0.dir'):'ASC';

        if(empty($request->input('search.value')))
        {            
            $posts = Role::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
        }
        else {
        $search = $request->input('search.value'); 

        $posts =  Role::where('id','LIKE',"%{$search}%")
                    ->orWhere('role_name', 'LIKE',"%{$search}%")
                    ->orWhere('role_status', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

        $totalFiltered = Role::where('id','LIKE',"%{$search}%")
                    ->orWhere('role_name', 'LIKE',"%{$search}%")
                    ->orWhere('role_status', 'LIKE',"%{$search}%")
                    ->count();
        }

        $data = array();
        if(!empty($posts))
        {
        foreach ($posts as $post)
        {
        $show =  'deleteData('.$post->id.')';//oute('delete-cities',$post->id);//route('posts.show',$post->id);
        $edit =  route('edit-role',$post->id);//route('edit-cities',$post->id);//route('posts.edit',$post->id);
            //&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>
           // &emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>

        $nestedData['id'] = $post->id;
        $nestedData['role_name'] = $post->role_name;
        $nestedData['role_status'] = ($post->role_status? 'Active' : 'Inactive');
        $nestedData['action'] = !$post->primary_status ? "&emsp;<a href='{$edit}' title='EDIT' ><span class='fa fa-edit'></span></a>
        &emsp;<a href='javascript:void(0);' onclick='{$show}' title='SHOW' ><span class='fa fa-trash'></span></a>":"-";
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

    public function view_role(){
        return view('super.role.create');
    }

    public function store_role(Request $request){
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|string|max:255|unique:roles,role_name'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            DB::beginTransaction();
            try {
                // Create Role
                $role = new Role();
                $role->role_name = $request->input('role_name');
                $role->role_status = $request->input('role_status') ? true : false;
                $role->save();
                // Commit To DB
                DB::commit();
                return redirect()->route('fetch-role')->with(['success' => 'Role Created Successfully']);
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back()->with(['error' => 'Unable To Create Role Due To: ' . $exception->getMessage()])->withInput();
            }
        }
    }
    
    public function edit_role(Request $request){
        $role_id=$request->role_id;
        $role_details= Role::find($role_id);
        return view('super.role.edit',compact('role_details'));;
    }
    public function update_role(Request $request){
        $role_id=$request->role_id;
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|string|max:255|unique:roles,role_name,'.$role_id
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            DB::beginTransaction();
            try {
                // Update Role
                $role_name = $request->input('role_name');
                $role_status = $request->input('role_status') ? true : false;
                $role= Role::find($role_id);
                $role->update(array(
                    'role_name'=>$role_name,
                    'role_status'=>$role_status
                ));
                // Commit To DB
                DB::commit();
                return redirect()->route('fetch-role')->with(['success' => 'Role Updated Successfully']);
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back()->with(['error' => 'Unable To Update Role Due To: ' . $exception->getMessage()])->withInput();
            }
        }
    }

    public function delete_role(Request $request){
        $role_id=$request->role_id;
        $role_details= Role::find($role_id);
        DB::beginTransaction();
        try {
            $role_details->where('primary_status','!=',true);
            $role_details->delete();
            // Commit To DB
            DB::commit();
            return redirect()->route('fetch-role')->with(['success' => 'Role Deleted Successfully']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Unable To Deleted Role Due To: ' . $exception->getMessage()])->withInput();
        }
    }
}
