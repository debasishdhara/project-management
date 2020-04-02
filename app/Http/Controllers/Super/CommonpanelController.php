<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country;
use App\State;
use App\City;
use App\SubCity;

class CommonpanelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get_country(Request $request){
        $columns = array(
            0 => 'id',
            1 => 'sort_name',
            2 => 'title',
            3 => 'phone_code',
            4 => 'id'
        );
        $totalData = Country::count();
        $totalFiltered = $totalData; 

        $limit = $request->input('length')?$request->input('length') : 10;
        $start = $request->input('start')?$request->input('start') : 0;
        $order = $columns[$request->input('order.0.column')?$request->input('order.0.column'):0];
        $dir = $request->input('order.0.dir')?$request->input('order.0.dir'):'ASC';

        if(empty($request->input('search.value')))
        {            
            $posts = Country::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
        }
        else {
        $search = $request->input('search.value'); 

        $posts =  Country::where('id','LIKE',"%{$search}%")
                    ->orWhere('title', 'LIKE',"%{$search}%")
                    ->orWhere('sort_name', 'LIKE',"%{$search}%")
                    ->orWhere('phone_code', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

        $totalFiltered = Country::where('id','LIKE',"%{$search}%")
                    ->orWhere('title', 'LIKE',"%{$search}%")
                    ->orWhere('sort_name', 'LIKE',"%{$search}%")
                    ->orWhere('phone_code', 'LIKE',"%{$search}%")
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
        $nestedData['sort_name'] = $post->sort_name;
        $nestedData['title'] = $post->title;
        $nestedData['phone_code'] = $post->phone_code;
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

    public function get_state(Request $request){
        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'id'
        );
        $totalData = State::count();
        $totalFiltered = $totalData; 

        $limit = $request->input('length')?$request->input('length') : 10;
        $start = $request->input('start')?$request->input('start') : 0;
        $order = $columns[$request->input('order.0.column')?$request->input('order.0.column'):0];
        $dir = $request->input('order.0.dir')?$request->input('order.0.dir'):'ASC';

        if(empty($request->input('search.value')))
        {            
            $posts = State::with('country')->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
        }
        else {
        $search = $request->input('search.value'); 

        $posts =  State::with('country')->where('id','LIKE',"%{$search}%")
                    ->orWhere('title', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

        $totalFiltered = State::with('country')->where('id','LIKE',"%{$search}%")
                    ->orWhere('title', 'LIKE',"%{$search}%")
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
        $nestedData['title'] = $post->title;
        $nestedData['country'] = $post->country->title;
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

    public function get_city(Request $request){
        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'id'
        );
        $totalData = City::count();
        $totalFiltered = $totalData; 

        $limit = $request->input('length')?$request->input('length') : 10;
        $start = $request->input('start')?$request->input('start') : 0;
        $order = $columns[$request->input('order.0.column')?$request->input('order.0.column'):0];
        $dir = $request->input('order.0.dir')?$request->input('order.0.dir'):'ASC';

        if(empty($request->input('search.value')))
        {            
            $posts = City::with('state')->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
        }
        else {
        $search = $request->input('search.value'); 

        $posts =  City::with('state')->where('id','LIKE',"%{$search}%")
                    ->orWhere('title', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

        $totalFiltered = City::with('state')->where('id','LIKE',"%{$search}%")
                    ->orWhere('title', 'LIKE',"%{$search}%")
                    ->count();
        }

        $data = array();
        if(!empty($posts))
        {
        foreach ($posts as $post)
        {
        $show =  "deleteData($post->id)";//route('posts.show',$post->id);
        $edit =  route('edit-cities',$post->id);//route('posts.edit',$post->id);
            //&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>
           // &emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>
        $nestedData['id'] = $post->id;
        $nestedData['title'] = $post->title;
        $nestedData['state'] = $post->state->title;
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

    public function get_sub_city(Request $request){
        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'zip_code',
            3 => 'id'
        );
        $totalData = SubCity::count();
        $totalFiltered = $totalData; 

        $limit = $request->input('length')?$request->input('length') : 10;
        $start = $request->input('start')?$request->input('start') : 0;
        $order = $columns[$request->input('order.0.column')?$request->input('order.0.column'):0];
        $dir = $request->input('order.0.dir')?$request->input('order.0.dir'):'ASC';

        if(empty($request->input('search.value')))
        {            
            $posts = SubCity::with('city')->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
        }
        else {
        $search = $request->input('search.value'); 

        $posts =  SubCity::with('city')->where('id','LIKE',"%{$search}%")
                    ->orWhere('title', 'LIKE',"%{$search}%")
                    ->orWhere('zip_code', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

        $totalFiltered = SubCity::with('city')->where('id','LIKE',"%{$search}%")
                    ->orWhere('title', 'LIKE',"%{$search}%")
                    ->orWhere('zip_code', 'LIKE',"%{$search}%")
                    ->count();
        }

        $data = array();
        if(!empty($posts))
        {
        foreach ($posts as $post)
        {
        $show =  route('delete-sub-cities',$post->id);//route('posts.show',$post->id);
        $edit =  route('edit-sub-cities',$post->id);//route('posts.edit',$post->id);
            //&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>
           // &emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>
        $nestedData['id'] = $post->id;
        $nestedData['title'] = $post->title;
        $nestedData['zip_code'] = $post->zip_code;
        $nestedData['city'] = $post->city->title;
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
