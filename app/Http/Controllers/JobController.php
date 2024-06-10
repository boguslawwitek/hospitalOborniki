<?php

namespace App\Http\Controllers;

use Advoor\NovaEditorJs\NovaEditorJs;
use App\Models\Job;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function renderAll() {
        $jobs = Job::orderBy('id', 'desc')->get();
        $title = SystemSetting::getSettingValueByKey('page.name');

        view()->share('active_menu_id', 5); //TODO : jakos to pomapowac
        view()->share('active_article_id', null);

        return view('job.list', compact('jobs', 'title'));
    }
    public function all()
    {
        return response()->json(Job::all());
    }
}
