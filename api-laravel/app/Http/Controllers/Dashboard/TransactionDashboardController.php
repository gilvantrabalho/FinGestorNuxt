<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class TransactionDashboardController extends Controller
{

    public function sumCards(int $user_id)
    {
        return response()->json([
            'response' => [
                'e_sum' => TransactionRepository::getSumByType($user_id, "E", date('Y-m')),
                's_sum' => TransactionRepository::getSumByType($user_id, "S", date('Y-m')),
                'l_sum' => TransactionRepository::getSubtractionTransaction(date('Y-m'))
            ]
        ]);
    }

    public function eSumByDay(int $user_id) {
        return response()->json([
            'response' => [
                'sum' => TransactionRepository::getSumByDay("E", $user_id)
            ]
        ]);
    }
}
