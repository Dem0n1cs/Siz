<?php

namespace App\Http\Controllers;


use App\Models\ReverseSideGive;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $test = ReverseSideGive::query()
            ->with(['reverseSideReturn' => function ($query) {
                $query->select(['id', 'reverse_side_give_id', 'date'])
                    ->where('date',null);
            }])
            ->select(['id', 'personal_card_id', 'ppe_id', 'date'])
            ->where('personal_card_id', '=', 17)
            ->get();
        return response()->json($test);
    }
}
