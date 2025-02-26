<?php

namespace App\Http\Controllers;

use App\Models\ReverseSideReturn;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __invoke(Request $request)
    {
        $reports = ReverseSideReturn::query()
            ->whereNull('reverse_side_returns.date')
            ->leftJoin('reverse_side_gives as reverse_side_gives', 'reverse_side_returns.reverse_side_give_id', '=', 'reverse_side_gives.id')
            ->leftJoin('personal_cards as personal_cards', 'reverse_side_gives.personal_card_id', '=', 'personal_cards.id')
            ->leftJoin('front_sides as front_sides', 'personal_cards.id', '=', 'front_sides.personal_card_id')
            ->leftJoin('heights as heights', 'front_sides.height_id', '=', 'heights.id')
            ->leftJoin('clothing_sizes as clothing_sizes', 'front_sides.clothing_size_id', '=', 'clothing_sizes.id')
            ->leftJoin('users as users', 'personal_cards.user_id', '=', 'users.id')
            ->leftJoin('professions as professions', 'users.profession_id', '=', 'professions.id')
            ->leftJoin('divisions as divisions', 'users.division_id', '=', 'divisions.id')
            ->leftJoin('standards as standards', function ($join) {
                $join->on('professions.id', '=', 'standards.profession_id')
                    ->on('standards.ppe_id', '=', 'reverse_side_gives.ppe_id');
            })
            ->leftJoin('ppes as ppes', 'reverse_side_gives.ppe_id', '=', 'ppes.id')
            ->leftJoin('classifications as classifications', 'ppes.classification_id', '=', 'classifications.id')
            ->whereNotIn('standards.term_wear', ['Дежурный', 'До износа'])
            ->whereRaw("DATE_ADD(reverse_side_gives.date, INTERVAL CAST(standards.term_wear AS SIGNED) MONTH) < CURRENT_DATE")
            ->selectRaw("
            users.last_name AS last_name,
            users.first_name AS first_name,
            users.middle_name AS middle_name,
            divisions.full_title AS division_name,
            professions.title AS profession_name,
            ppes.title AS ppe_name,
            classifications.title AS classification_name,
            standards.quantity AS quantity,
            DATE_FORMAT(reverse_side_gives.date, '%d.%m.%Y') AS give_date,
            standards.term_wear AS term_wear,
            heights.height_range AS height_range,
            clothing_sizes.size_range AS size_range,
            front_sides.shoe_size AS shoe_size
            ")
            ->paginate(15);
        return view('reports.index', compact('reports'));
    }
}
