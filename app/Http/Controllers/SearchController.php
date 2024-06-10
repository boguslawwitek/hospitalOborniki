<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class SearchController extends Controller
{
    public function searchByString(Request $request)
    {
        $queryString = '%' . $request->post('searchString') . '%';
        $data = [
            'content' => [],
            'wards' => [],
            'employee' => []
        ];

        $contents = \App\Models\Content::where('display_on_menu', 1)->where('title', 'like', $queryString)->orWhere('body', 'like', $queryString)->get();

        foreach ($contents as $content) {
            $art = new stdClass;
            $art->title = $content->title;
            $art->id = $content->id;
            $art->cid = 'c_' . $content->id;
            $art->slug = Str::slug($content->title);
            $art->url = route('main.articles_by_id', ['slug' => $art->slug, $art->id]);
            $art->newTab = false;

            $data['content'][] = $art;
        }


        $wards = \App\Models\Wards::where('title', 'like', $queryString)->orWhere('body', 'like', $queryString)->orWhere('additional_data', 'like', $queryString)
            ->where('contact_data', 'like', $queryString)->orWhere('localization', 'like', $queryString)->get();


        foreach ($wards as $ward)
        {
            $art = new stdClass;
            $art->title = $ward->title;
            $art->id =  $ward->id;
            $art->cid = 'w_' . $ward->id;
            $art->slug = Str::slug($ward->title);
            $art->url = route('main.ward_by_id', [$art->slug, $art->id]);
            $art->newTab = false;

            $data['wards'][] = $art;
        }

        $employees = \App\Models\Employee::where('name', 'like', $queryString)->orWhere('workplace', 'like', $queryString)->orWhere('phone', 'like', $queryString)
            ->orWhere('email', 'like', $queryString)->get();

        foreach ($employees as $employee) {
            $art = new stdClass();
            $art->title = $employee->name . ' ('. $employee->workplace .')';
            $content = $employee->contents->first();
            $art->id = $content->id;
            $art->cid = 'c_' . $content->id;
            $art->slug = Str::slug($content->title);
            $art->url = route('main.articles_by_id', ['slug' => $art->slug, $art->id]);

            $data['employee'][] = $art;
        }

        return $data;
    }
}
