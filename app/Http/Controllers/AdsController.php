<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function all() {
        $ads = Ads::where('active', '=', 1)->get();
        return response()->json($ads);
    }
}
