<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu;
use Illuminate\Support\Carbon;
use DataTables;

class TamuController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax()){
            $data = Tamu::query();

            if ($request->filled('from_date') && $request->filled('to_date'))  {
                $data = $data->whereDate('created_at', '>=', $request->from_date)
                ->whereDate('created_at', '<=', $request->to_date)
                ->get();
                // dd($data);
            }
            return DataTables::of($data)
                ->make(true);
        }
        return view('tables');
    }
}
