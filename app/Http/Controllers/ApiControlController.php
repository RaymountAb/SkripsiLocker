<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use Illuminate\Http\Request;

class ApiControlController extends Controller
{
    public function getStatusLoker1($id)
    {
        /*$locker = Locker::findOrFail($id);
        return response()->json([
            'status' => $locker->status,
        ]);*/
        $data = Locker::where('id', $id)->first()->status;
        return $data;
    }

    public function getStatusLoker2($id)
    {
        /*$locker = Locker::findOrFail($id);
        return response()->json([
            'status' => $locker->status,
        ]);*/
        $data = Locker::where('id', $id)->first()->status;
        return $data;
    }

    public function getStatusLoker3($id)
    {
        /*$locker = Locker::findOrFail($id);
        return response()->json([
            'status' => $locker->status,
        ]);*/
        $data = Locker::where('id', $id)->first()->status;
        return $data;
    }

    public function getStatusLoker4($id)
    {
        /*$locker = Locker::findOrFail($id);
        return response()->json([
            'status' => $locker->status,
        ]);*/
        $data = Locker::where('id', $id)->first()->status;
        return $data;
    }
}
