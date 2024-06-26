<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckIn;
use App\Models\User;

class CheckInController extends Controller
{
    // index
    public function index()
    {
        $checkins = CheckIn::selectRaw('user_id, DATE(created_at) as date, MAX(created_at) as latest_checkin')
            ->groupBy('user_id', 'date')
            ->orderBy('latest_checkin', 'desc')
            ->paginate(10);

        return view('owner.pages.checkins.index', compact('checkins'));
    }

    // function view maps
    public function viewMaps()
    {
        return view('owner.pages.checkins.maps');
    }

    // function view maps
    public function viewMapsById($id)
    {
        $checkin = CheckIn::find($id);
        return view('owner.pages.checkins.maps', compact('checkin'));
    }

    // function view maps
    public function viewMapsByDay($day)
    {
        $checkins = CheckIn::where('day', $day)->get();
        return view('owner.pages.checkins.maps', compact('checkins'));
    }

    public function userCheckinLocations($userId, Request $request)
    {
        $date = $request->input('date'); // Retrieve date from query parameters

        $query = CheckIn::where('user_id', $userId);

        if ($date) {
            $query->whereDate('created_at', $date);
        }

        $checkins = $query->select('latitude', 'longitude', 'created_at')->get();
        $user = User::find($userId);

        return view('owner.pages.checkins.maps', compact('checkins', 'user', 'date'));
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

    // method hapus
    public function hapus($id)
    {
        $checkin = CheckIn::findOrFail($id);
        $checkin->delete();

        return redirect()->route('checkin.index')->with('success', 'Data deleted successfully');
    }
}
