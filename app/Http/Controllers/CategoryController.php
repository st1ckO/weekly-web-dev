<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index() {
        Log::info("=== CategoryController index ===");

        $result = DB::table('categories')
            ->select('name', 'status')
            ->find(1);


        $result = DB::table('categories')
            ->pluck('name');
            
        return $result;
    }
}
