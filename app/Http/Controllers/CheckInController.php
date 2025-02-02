<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckIn;
use App\Models\User;
use App\Models\Toko;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CheckInController extends Controller
{
    // index
    public function index(Request $request)
    {
        // Get the selected year or default to the current year
        $year = $request->input('year', now()->year);

        // Get the selected month or default to the current month
        $month = $request->input('month', now()->month);

        // Get the selected day or default to null (to fetch all days if not provided)
        $day = $request->input('day', null);

        // Get the number of days in the selected month
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;

        // Query the CheckIn model with filters for user_id, year, month, and day
        $checkins = CheckIn::selectRaw('check_ins.user_id, users.name as user_name, DATE(check_ins.created_at) as date, MAX(check_ins.created_at) as latest_checkin, MAX(check_ins.updated_at) as latest_update')
            ->join('users', 'check_ins.user_id', '=', 'users.id') // Joining with the users table
            ->when($request->input('user_id'), function ($query, $user_id) {
                $query->where('check_ins.user_id', $user_id);
            })
            ->when($day, function ($query, $day) use ($month, $year) {
                $query->whereYear('check_ins.created_at', $year)
                    ->whereMonth('check_ins.created_at', $month)
                    ->whereDay('check_ins.created_at', $day);
            }, function ($query) use ($month, $year) {
                $query->whereYear('check_ins.created_at', $year)
                    ->whereMonth('check_ins.created_at', $month);
            })
            ->groupBy('check_ins.user_id', 'user_name', 'date') // Group by user_id and user_name
            ->orderBy('latest_checkin', 'desc')
            ->get();


        // Calculate the duration for each checkin and transform the result
        $checkins->transform(function ($checkin) {
            $checkin->duration = Carbon::parse($checkin->created_at)->diffInMinutes(Carbon::parse($checkin->updated_at));
            return $checkin;
        });

        // Pass the checkin data and daysInMonth to the view
        return view('owner.pages.checkins.index', compact('checkins', 'daysInMonth', 'month', 'year', 'day'));
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

        $checkins = $query->select('latitude', 'longitude', 'created_at', 'updated_at', 'outlet_name', 'status', 'image')->get();
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
    public function postCheckout(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'location_id' => 'required|integer',
            'day' => 'required|date',
            'status' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'data_otlets_id' => 'required|integer',
            'outlet_name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Tambahkan validasi untuk foto
        ]);

        // Temukan record check-in yang sesuai
        $checkin = CheckIn::where('user_id', $validatedData['user_id'])
            ->where('location_id', $validatedData['location_id'])
            ->where('day', $validatedData['day'])
            ->latest()
            ->first();

        if (!$checkin) {
            return response()->json(['error' => 'Check-in not found'], 404);
        }

        // Perbarui status check-out dan posisi
        $checkin->status = 'checked_out';
        $checkin->latitude = $validatedData['latitude'];
        $checkin->longitude = $validatedData['longitude'];

        // Jika ada foto, simpan dan update path foto pada check-in
        if ($request->hasFile('image')) {
            $fotoPath = $request->file('image')->store('checkin_photos', 'public');
            $checkin->image = $fotoPath;
        }

        $checkin->save();

        return response()->json(['message' => 'Checkout successful']);
    }
}
