<?php

namespace App\Repositories;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionRepository
{
    public static function getSumByType(int $user_id, string $type, $date)
    {
        try {
            return Transaction::select(DB::raw('SUM(value) AS value'), 'type')
                ->whereUserId($user_id)
                ->whereType($type)
                ->where('created_at', 'like', "{$date}%")
                ->groupBy('type')->first();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function getSubtractionTransaction($date)
    {
        return DB::select("SELECT
            (SELECT
                SUM(value) AS value
                FROM transactions
                WHERE type = 'E' AND
                created_at LIKE '{$date}%'
                GROUP BY type)
            -
            (SELECT
                SUM(value) AS value
                FROM transactions
                WHERE type = 'S' AND
                created_at LIKE '{$date}%'
                GROUP BY type) AS subtracao");
    }

    public static function getSumByDay(string $type, int $user_id)
    {
        try {

            return Transaction::select("type", "value")
                ->whereType("'$type'")
                ->groupBy("created_at")
                ->get();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function getGraphicDataByType(string $type)
    {
        return DB::select("SELECT
                DAY(created_at) AS day,
                MONTH(NOW()) AS month,
                YEAR(NOW()) AS year,
                COUNT(*) AS count,
                SUM(value) as total
            FROM transactions
                WHERE type = '{$type}' 
                AND MONTH(created_at) = MONTH(NOW())
                AND YEAR(created_at) = YEAR(NOW())
                GROUP BY DAY(created_at);");
    }
}
