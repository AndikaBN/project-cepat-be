<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\CheckIn;
use App\Models\User;

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

    //function view maps
    public function viewMapsByDay($day)
    {
        $checkins = CheckIn::where('day', $day)->get();
        return view('owner.pages.checkins.maps', compact('checkins'));
    }

    public function userCheckinLocations($userId)
    {
        $checkins = CheckIn::where('user_id', $userId)->select('latitude', 'longitude')->get();
        $user = User::find($userId); // Mendapatkan data pengguna berdasarkan ID

        return view('owner.pages.checkins.maps', compact('checkins', 'user'));
    }

    public function viewMapsByUserId($userId)
    {
        $user = User::find($userId);
        $checkins = $user->checkIns()->select('latitude', 'longitude')->get();
        return view('owner.pages.checkins.maps', compact('checkins', 'user'));
    }



    public function ajaxByUserId($userId)
    {
        try {
            $user = User::find($userId);
            $checkins = $user->checkIns()->select('latitude', 'longitude')->get();
            $data = $checkins->map(function ($checkin) {
                return [
                    'lat' => $checkin->latitude,
                    'lng' => $checkin->longitude,
                ];
            });
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Tidak dapat mengambil data check-in.'], 500);
        }
    }


}
