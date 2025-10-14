<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    /**
     * Return enlisted/graduated counts for students and officers.
     *
     * This implementation uses permissive LIKE searches across a few
     * likely columns (students.unit_assingment, students.rank,
     * teachers.rank and users.code) so it will work even if the
     * exact column storing the category varies. Adjust the queries
     * to match your real schema if needed.
     */
    public function enlistedCounts(Request $request)
    {
        try {
            // cache key for a short duration to reduce DB pressure
            $cacheKey = 'dashboard:enlisted_counts';
            $cached = Cache::get($cacheKey);
            if ($cached) {
                return response()->json($cached);
            }
            // Students: search for BSC, ASC, SMC across a few columns
            $dkbsc = DB::table('students')
                ->join('users', 'students.user_id', '=', 'users.id')
                ->where(function ($q) {
                    $q->where('students.unit_assingment', 'like', '%BSC%')
                        ->orWhere('students.rank', 'like', '%BSC%')
                        ->orWhere('users.code', 'like', '%BSC%')
                        ->orWhere('users.permiCode', 'like', '%BSC%');
                })->count();

            $dkasc = DB::table('students')
                ->join('users', 'students.user_id', '=', 'users.id')
                ->where(function ($q) {
                    $q->where('students.unit_assingment', 'like', '%ASC%')
                        ->orWhere('students.rank', 'like', '%ASC%')
                        ->orWhere('users.code', 'like', '%ASC%')
                        ->orWhere('users.permiCode', 'like', '%ASC%');
                })->count();

            $dksmc = DB::table('students')
                ->join('users', 'students.user_id', '=', 'users.id')
                ->where(function ($q) {
                    $q->where('students.unit_assingment', 'like', '%SMC%')
                        ->orWhere('students.rank', 'like', '%SMC%')
                        ->orWhere('users.code', 'like', '%SMC%')
                        ->orWhere('users.permiCode', 'like', '%SMC%');
                })->count();

            // Officers (teachers) counts using similar permissive checks
            $bbffoc = DB::table('teachers')
                ->join('users', 'teachers.user_id', '=', 'users.id')
                ->where(function ($q) {
                    $q->where('teachers.rank', 'like', '%BBFFOC%')
                        ->orWhere('users.code', 'like', '%BBFFOC%')
                        ->orWhere('users.permiCode', 'like', '%BBFFOC%');
                })->count();

            $abffoc = DB::table('teachers')
                ->join('users', 'teachers.user_id', '=', 'users.id')
                ->where(function ($q) {
                    $q->where('teachers.rank', 'like', '%ABFFOC%')
                        ->orWhere('users.code', 'like', '%ABFFOC%')
                        ->orWhere('users.permiCode', 'like', '%ABFFOC%');
                })->count();

            $payload = [
                'DKBSC_GRADUATED' => $dkbsc,
                'DKASC_GRADUATED' => $dkasc,
                'DKSMC_GRADUATED' => $dksmc,
                'BBFFOC_GRADUATED' => $bbffoc,
                'ABFFOC_GRADUATED' => $abffoc,
            ];
            Cache::put($cacheKey, $payload, 30); // seconds
            return response()->json($payload);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Unable to compute counts',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
