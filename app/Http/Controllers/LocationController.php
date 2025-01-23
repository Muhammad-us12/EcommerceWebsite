<?php

namespace App\Http\Controllers;

use App\Models\CropAcres;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function getLocation($id)
    {
        $location = Location::find($id);

        return response()->json(['data' => $location]);
    }

    public function locationList()
    {
        $locations = Location::all();

        return view('adminPanel.locations.addLocation', ['locations' => $locations]);
    }

    public static function getAllLocations()
    {
        return Location::all();
    }

    public function addLocation(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $result = Location::create(['name' => $request->name, 'user_id' => Auth::user()->id]);
        if ($result) {
            return redirect()->back()->with(['success' => 'Location Added Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);
        }
    }

    public function updateLocation(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'locationId' => 'required',
        ]);

        $result = Location::find($request->locationId)
            ->update(['name' => $request->name]);
        if ($result) {
            return redirect()->back()->with(['success' => 'Location Updated Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Something Went Wrong Try Again']);
        }
    }

    public function deleteCheck($id)
    {
        $locationId = (int) $id;
        $hasRelatedRecords = CropAcres::where('location_id', $locationId)->exists();

        return response()->json(['can_delete' => ! $hasRelatedRecords]);
    }

    public function destroyLocation($id)
    {
        $locationId = (int) $id;
        Location::destroy($locationId);

        return redirect()->back()->with(['success' => 'Location Deleted Successfully']);
    }
}
