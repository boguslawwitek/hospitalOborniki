<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use App\Models\SystemSetting;
use App\Models\TelephoneSection;
use App\Models\Wards;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Slug;
use Advoor\NovaEditorJs\NovaEditorJs;

class ContentController extends Controller
{
    public function renderHomepage() {
        $id = SystemSetting::getSettingValueByKey('main_page.content_id');
        $content = Content::with('category')->
        with('employees')->
        with('notifications')->
        with('photos')
            ->find($id);


        view()->share('active_menu_id', $content->category_id);
        view()->share('active_article_id', $content->id);

        $body = NovaEditorJs::generateHtmlOutput($content->body);
        return view('content.content_homepage', compact('content', 'body'));
    }

    public function renderCovidData() {
        $id = SystemSetting::getSettingValueByKey('covid19.content_id');
        $content = Content::with('category')->
        with('employees')->
        with('notifications')->
        with('photos')
            ->find($id);

        view()->share('active_menu_id', 14); //TODO: Nie działa aktywny link - mainMenu['id] wskazuje ID strony głównej (15)
        view()->share('active_article_id', $content->id);

        $body = NovaEditorJs::generateHtmlOutput($content->body);
        return view('content.' . $content->template, compact('content', 'body'));
    }

    public function renderTelephoneData() {
        $id = SystemSetting::getSettingValueByKey('custom.telephone-id');
        $content = Content::with('category')->
        with('employees')->
        with('notifications')->
        with('photos')
            ->find($id);

        view()->share('active_menu_id', 8); //TODO: Nie działa aktywny link - mainMenu['id] wskazuje ID strony głównej (15)
        view()->share('active_article_id', $content->id);

        $phoneSections = TelephoneSection::all();


        $body = NovaEditorJs::generateHtmlOutput($content->body);
        return view('content.' . $content->template, compact('content', 'body', 'phoneSections'));
    }

    public function renderContentById(string $slug, string $id) {
        $content = Content::with('category')->
        with('employees')->
        with('notifications')->
        with('photos')
            ->find($id);

        view()->share('active_menu_id', $content->category_id);
        view()->share('active_article_id', 'c_' . $content->id);

        $correctSlug = Str::slug($content->title);
        if ($correctSlug !== $slug) {
            return redirect(route('main.articles_by_id', ['slug' => $correctSlug, $content->id]), 301);
        }
        $body = NovaEditorJs::generateHtmlOutput($content->body);


        return view('content.' . $content->template, compact('content', 'body'));
    }

    public function getById(int $id)
    {

       $content = Content::with('category')->
       with('employees')->
       with('notifications')->
       with('photos')
           ->find($id) ;

       return response()->json($content);
    }

    public function getCategory(int $id) {
        $category = Category::find($id);

        $response = [
            'id' => $category->id,
            'name' => $category->name,
            'content' => Content::where('category_id', $category->id)->get(['id', 'title', 'display_on_menu']),
            'ward' => Wards::where('category_id', $category->id)->get(['id', 'title']),
            'slug' => Str::slug($category->name .'-' . $category->id, '-'),
        ];



        return response()->json($response);
    }
}
