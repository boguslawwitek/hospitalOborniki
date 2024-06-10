<?php

namespace App\Http\Controllers;

use App\Models\SystemSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getByKey(string $key)
    {
        return response()->json(SystemSetting::where('key', $key)->get('value')->first());
    }

    public function all()
    {
        return response()->json(SystemSetting::get(['key', 'value'])->all());
    }
}
