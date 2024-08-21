<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckIn;
use App\Models\User;
use App\Models\Toko;
use App\Models\Order;
use App\Models\Tagihan;

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
        $date = $request->input('date');

        $query = CheckIn::where('user_id', $userId)
            ->selectRaw('location_id, outlet_name, MIN(created_at) as first_checkin, MAX(created_at) as last_checkout, latitude, longitude')
            ->whereDate('created_at', $date)
            ->groupBy('location_id', 'outlet_name', 'latitude', 'longitude')
            ->orderBy('first_checkin', 'asc');

        $checkins = $query->get();
        $user = User::find($userId);
        $tokos = Toko::select('latitude', 'longitude', 'nama_toko', 'area')->get();

        // Tambahkan kolom urutan kunjungan
        $checkins = $checkins->map(function ($checkin, $index) use ($date, $userId) {
            $checkin->visit_order = $index + 1; // Urutan kunjungan

            // Mengambil jumlah transaksi
            $checkin->total_orders = Order::where('data_otlets_id', $checkin->location_id)
                ->whereDate('created_at', $date)
                ->count();

            // Mengambil jumlah tagihan
            $checkin->total_billing = Tagihan::where('user_id', $userId)
                ->where('nama_outlet', $checkin->outlet_name)
                ->whereDate('created_at', $date)
                ->sum('jumlah_tagihan');

            return $checkin;
        });

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
