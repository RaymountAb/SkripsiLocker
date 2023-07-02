<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use Illuminate\Http\Request;

class ManualController extends Controller
{
    public function index()
    {
        $lockers = Locker::all();
        //return response()->json($lockers); 

        return view('content.controls', compact('lockers'));
    }

    public function update(Request $request, $id)
    {
        $locker = Locker::findOrFail($id);
        $locker->status = $request->input('status');
        $locker->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }
}
