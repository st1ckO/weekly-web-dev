<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusesController extends Controller
{
    public function index() {
        $result = DB::table('statuses')
            ->get();
            
        return $result;
    }
}
