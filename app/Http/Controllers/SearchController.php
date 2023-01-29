<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search_state(Request $request)
    {
        $states = State::where(function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->q . '%');
        });
        $states = $states->get();

        return response()->json(['total_count' => $states->count(), 'items' => $states]);
    }
    public function search_city(Request $request,$id){
        $cities= City::where(function ($query) use ($request,$id) {
            $query->where('name', 'like', '%' . $request->q . '%')
            ->where('state_id',$id);
        });
        $cities = $cities->get();

        return response()->json(['total_count' => $cities->count(), 'items' => $cities]);
    }
}
