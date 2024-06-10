<?php

namespace App\Http\Controllers;

use Advoor\NovaEditorJs\NovaEditorJs;
use App\Models\Wards;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WardController extends Controller
{

    public function renderById(string $slug, int $id) {
        $ward = Wards::find($id);

        $correctSlug = Str::slug($ward->title);
        if ($correctSlug !== $slug) {
            return redirect(route('main.ward_by_id', ['slug' => $correctSlug, $ward->id]), 301);
        }
        $body = NovaEditorJs::generateHtmlOutput($ward->body);

        view()->share('active_menu_id', $ward->category_id);
        view()->share('active_article_id', 'w_' . $ward->id);


        return view('ward.by_id', compact('ward', 'body'));
    }
    public function getById($id)
    {
        return response()->json(Wards::find($id));
    }
}
