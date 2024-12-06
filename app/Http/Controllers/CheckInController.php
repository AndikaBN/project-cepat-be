<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckIn;
use App\Models\User;
use App\Models\Toko;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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

    // function view maps by id
    public function viewMapsById($id)
    {
        $checkin = CheckIn::find($id);
        return view('owner.pages.checkins.maps', compact('checkin'));
    }

    // function view maps by day
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

    // method untuk menambah check-in
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'location_id' => 'required|string',
            'day' => 'required|string',
            'status' => 'required|in:checkin,checkout',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'data_otlets_id' => 'required|exists:data_otlets,id',
            'outlet_name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $checkinData = $request->only([
            'user_id',
            'location_id',
            'day',
            'status',
            'latitude',
            'longitude',
            'data_otlets_id',
            'outlet_name'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images/checkins', 'public');
            $checkinData['image'] = $path;
        }

        CheckIn::create($checkinData);

        return redirect()->route('checkin.index')->with('success', 'Check-in created successfully');
    }

    // method untuk mengupdate check-in
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'location_id' => 'required|string',
            'day' => 'required|string',
            'status' => 'required|in:checkin,checkout',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'data_otlets_id' => 'required|exists:data_otlets,id',
            'outlet_name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $checkin = CheckIn::findOrFail($id);

        $checkinData = $request->only([
            'user_id',
            'location_id',
            'day',
            'status',
            'latitude',
            'longitude',
            'data_otlets_id',
            'outlet_name'
        ]);

        if ($request->hasFile('image')) {
            if ($checkin->image) {
                Storage::disk('public')->delete($checkin->image);
            }
            $file = $request->file('image');
            $path = $file->store('images/checkins', 'public');
            $checkinData['image'] = $path;
        }

        $checkin->update($checkinData);

        return redirect()->route('checkin.index')->with('success', 'Check-in updated successfully');
    }
}
