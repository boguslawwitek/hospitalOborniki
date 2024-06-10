<?php

namespace App\Http\Controllers;

use Advoor\NovaEditorJs\NovaEditorJs;
use App\Models\Subsidies;
use App\Models\SubsidiesTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubsidiesController extends Controller
{
    public function subsidesType(string $slug, int $id)
    {
        $subsidesType = SubsidiesTypes::where('id', $id)->first();

        $subsideTypeSlug = Str::slug($subsidesType->title);


        view()->share('active_menu_id', 8); //TODO: Nie działa aktywny link - mainMenu['id] wskazuje ID strony głównej (15)
        view()->share('active_article_id', 'subs' . $subsidesType->id);


        if ($subsideTypeSlug !== $slug) {
            return redirect(route('main.subsidies-types', ['slug' => $subsideTypeSlug, $subsidesType->id]), 301);
        }
        $body = NovaEditorJs::generateHtmlOutput($subsidesType->body);


        return view('subsidies.type', compact('subsidesType', 'body', 'subsideTypeSlug'));
    }

    public function subsides(string $slug, int $id, string $subSlug, int $subId)
    {
        $subsidesType = SubsidiesTypes::where('id', $id)->first();
        $subsideTypeSlug = Str::slug($subsidesType->title);

        /** @var Subsidies $subsidies */
        $subsidies = Subsidies::where('id', $subId)->first();

        if ($subsidies->getSlug() !== $subSlug || $subsideTypeSlug !== $slug) {
            return redirect(route('main.subsidies', ['slug' => $subsideTypeSlug, $subsidesType->id, $subsidies->getSlug(), $subsidies->id]), 301);
        }


        view()->share('active_menu_id', 8); //TODO: Nie działa aktywny link - mainMenu['id] wskazuje ID strony głównej (15)
        view()->share('active_article_id', 'subs' . $subsidesType->id);

        $body = NovaEditorJs::generateHtmlOutput($subsidies->body);


        return view('subsidies.subside', compact('subsidesType', 'body', 'subsideTypeSlug', 'subsidies'));

    }
}
