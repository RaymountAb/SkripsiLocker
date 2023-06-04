<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use Illuminate\Http\Request;

class ApiControlController extends Controller
{

    public function loker1($id){
        //$data = Locker::where('id', $id)->first()->status;
        //return $data;
        $data = Locker::findOrFail($id);
        $status = $data->status ? true : false;
        
        return response()->json(['status'=>$status]);
    }


}
