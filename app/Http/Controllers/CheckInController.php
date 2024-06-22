<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\CheckIn;

class CheckInController extends Controller
{
    //index
    public function index()
    {
        $checkins = CheckIn::paginate(10);
        return view('owner.pages.checkins.index', compact('checkins'));
    }

    //destroy
    public function destroy($id)
    {
        $checkin = CheckIn::find($id);
        $checkin->delete();

        return redirect()->route('checkins.index')->with('success', 'Checkin deleted');
    }

    //function view maps
    public function viewMaps()
    {
        return view('owner.pages.checkins.maps');
    }

    //function view maps
    public function viewMapsById($id)
    {
        $checkin = CheckIn::find($id);
        return view('owner.pages.checkins.maps', compact('checkin'));
    }
}
