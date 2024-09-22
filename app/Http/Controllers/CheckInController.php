<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckIn;
use App\Models\User;
use App\Models\Toko;
use Carbon\Carbon;


class CheckInController extends Controller
{
    // index
    public function index()
    {
        $checkins = CheckIn::selectRaw('user_id, created_at, updated_at, DATE(created_at) as date, MAX(created_at) as latest_checkin')
            ->groupBy('user_id', 'date', 'created_at', 'updated_at')
            ->orderBy('latest_checkin', 'desc')
            ->paginate(10);

        $checkins->transform(function ($checkin) {
            $checkin->duration = Carbon::parse($checkin->created_at)->diffInMinutes(Carbon::parse($checkin->updated_at));
            return $checkin;
        });

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
        $date = $request->input('date');
        $query = CheckIn::where('user_id', $userId);
        if ($date) {
            $query->whereDate('created_at', $date);
        }

        $checkins = $query->select('latitude', 'longitude', 'created_at', 'updated_at', 'outlet_name')->get();
        $user = User::find($userId);

        $tokos = Toko::select('latitude', 'longitude', 'nama_toko', 'area', 'daerah')->get();

        return view('owner.pages.checkins.maps', compact('checkins', 'user', 'date', 'tokos'));
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
