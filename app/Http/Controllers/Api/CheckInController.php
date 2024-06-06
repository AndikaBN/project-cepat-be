<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CheckIn;

class CheckInController extends Controller
{
    //api post checkin
    public function postCheckin(Request $request)
    {
        $request->validate([
            'location_id' => 'required',
            'day' => 'required',
            'status' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'data_otlets_id' => 'required',
            'outlet_name' => 'required',
        ]);

        $checkin = CheckIn::create([
            'location_id' => $request->location_id,
            'day' => $request->day,
            'status' => $request->status,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'data_otlets_id' => $request->outlet_id,
            'outlet_name' => $request->outlet_name,
        ]);

        return response()->json([
            'message' => 'Checkin created',
            'data' => $checkin,
        ] , 200);
    }


    //api get checkin
    public function getCheckin()
    {
        $checkin = CheckIn::where('user_id', auth()->user()->id)->get();

        return response()->json([
            'message' => 'Success',
            'data' => $checkin,
        ] , 200);
    }

    //api get checkin by id
    public function getCheckinById($id)
    {
        $checkin = CheckIn::find($id);

        if (!$checkin) {
            return response()->json([
                'message' => 'Checkin not found',
            ] , 404);
        }

        return response()->json([
            'message' => 'Success',
            'data' => $checkin,
        ] , 200);
    }

    //api update checkin
    public function updateCheckin(Request $request, $id)
    {
        $request->validate([
            'location_id' => 'required',
            'day' => 'required',
            'status' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'data_otlets_id' => 'required',
            'outlet_name' => 'required',
        ]);

        $checkin = CheckIn::find($id);

        if (!$checkin) {
            return response()->json([
                'message' => 'Checkin not found',
            ] , 404);
        }

        $checkin->location_id = $request->location_id;
        $checkin->day = $request->day;
        $checkin->status = $request->status;
        $checkin->latitude = $request->latitude;
        $checkin->longitude = $request->longitude;
        $checkin->data_otlets_id = $request->data_otlets_id;
        $checkin->outlet_name = $request->outlet_name;
        $checkin->save();

        return response()->json([
            'message' => 'Checkin updated',
            'data' => $checkin,
        ] , 200);
    }

    //api delete checkin
    public function deleteCheckin($id)
    {
        $checkin = CheckIn::find($id);

        if (!$checkin) {
            return response()->json([
                'message' => 'Checkin not found',
            ] , 404);
        }

        $checkin->delete();

        return response()->json([
            'message' => 'Checkin deleted',
        ] , 200);
    }
}
