<?php

namespace App\Http\Controllers;

use App\Models\Locker;
use Illuminate\Http\Request;

class ApiControlController extends Controller
{
    /*public function index()
    {
        $lockers = Locker::all();

        return view('content.manual', compact('lockers'));
    }

    public function update(Request $request, $id)
    {
        $locker = Locker::findOrFail($id);
        $locker->status = $request->input('status', false);
        $locker->save();

        return response()->json(['message' => 'Status updated successfully.']);
    }*/
    public function index()
    {
        $lockers = Locker::all();

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
