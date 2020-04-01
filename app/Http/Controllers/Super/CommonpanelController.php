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

    public function get_country(){
        
    }

    public function get_state(){
        
    }

    public function get_city(Request $request){
        $columns = array(
            0 => 'id',
            1 => 'title',
            6 => 'id'
        );
        $totalData = City::count();
        $totalFiltered = $totalData; 

        $limit = $request->input('length')?$request->input('length') : 10;
        $start = $request->input('start')?$request->input('start') : 0;
        $order = $columns[$request->input('order.0.column')?$request->input('order.0.column'):0];
        $dir = $request->input('order.0.dir')?$request->input('order.0.dir'):'ASC';

        if(empty($request->input('search.value')))
        {            
            $posts = City::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
        }
        else {
        $search = $request->input('search.value'); 

        $posts =  City::where('id','LIKE',"%{$search}%")
                    ->orWhere('title', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

        $totalFiltered = City::where('id','LIKE',"%{$search}%")
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

    public function get_sub_city(Request $request){
        
    }
}
