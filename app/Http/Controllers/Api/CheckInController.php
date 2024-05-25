<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CheckIn;

class CheckInController extends Controller
{
    //api post checkin
    public function checkin(Request $request)
    {
        $request->validate([
            'outlet_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'clock_out' => 'required',
        ]);

        $checkin = CheckIn::create([
            'user_id' => auth()->user()->id,
            'outlet_id' => $request->outlet_id,
            'date' => $request->date,
            'time' => $request->time,
            'clock_out' => $request->clock_out,
        ]);

        return response()->json([
            'message' => 'Checkin success',
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
            'outlet_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'clock_out' => 'required',
        ]);

        $checkin = CheckIn::find($id);

        if (!$checkin) {
            return response()->json([
                'message' => 'Checkin not found',
            ] , 404);
        }

        $checkin->update([
            'user_id' => auth()->user()->id,
            'outlet_id' => $request->outlet_id,
            'date' => $request->date,
            'time' => $request->time,
            'clock_out' => $request->clock_out,
        ]);

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
