<?php

namespace App\Http\Controllers;
use App\People;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function storeItem(Request $request){
    	$people = People::create([
    		'name' => $request->name,
    		'age' => $request->age,
    		'profession' => $request->profession
    	]);
    	if ($people) {
    		return response($request->name, 200);
    	} else{
    		return response('Opps! There is an error!');
    	}
    }

    public function index()
    {
    	$peoples = People::orderByDesc('id')->get();
    	if ($peoples) {
    		return response()->json($peoples,200);
    	}else{
    		return response('Opps! There is an error!');
    	}
    }

    public function findItem($id)
    {
        $people = People::find($id);
        if ($people) {
            return response()->json($people,200);
        }else{
            return response('Opps! There is an error!');
        }
    }
    public function updateItem(Request $request , $id)
    {
        $people = People::find($id);
        $people->name  = $request->name;
        $people->age = $request->age;
        $people->profession = $request->profession;
        $people->save();
        if ($people) {
            return response([
                'msg' => 'Successfully Updated!',
                'id' => $people->id
            ]);
        }else{
            return response('Opps! There is an error!');
        }
    }
    public function deleteItem($id)
    {
        $people = People::destroy($id);
        if ($people) {
            return response()->json("Information was deleted.",200);
        }else{
            return response('Opps! There is an error!');
        }
    }
}
