<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/search/{query}', function (string $query) {
    $queryString = '%' . $query . '%';
    $data = [
        'content' => [],
        'wards' => [],
        'employee' => []
    ];

    $contents = \App\Models\Content::where('display_on_menu', 1)->where('title', 'like', $queryString)->orWhere('body', 'like', $queryString);

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
});


Route::get('projekty/{slug}-{id}', \App\Http\Controllers\SubsidiesController::class .'@subsidesType')->where('slug', '[a-z-]+')
    ->where('id', '[0-9]+')
    ->name('main.subsidies-types');

Route::get('projekty/{slug}-{id}/{subSlug}-{subId}', \App\Http\Controllers\SubsidiesController::class .'@subsides')->where('slug', '[a-z-]+')
    ->where('id', '[0-9]+')
    ->where('slug', '[a-z-]+')
    ->where('subId', '[0-9]+')
    ->where('subSlug', '[a-z-]+')
    ->name('main.subsidies');

Route::get('informacje/telefony-9', \App\Http\Controllers\ContentController::class .'@renderTelephoneData');
Route::get('/covid-19', \App\Http\Controllers\ContentController::class .'@renderCovidData');
Route::get('/ogloszenia_o_zatrudnieniu', \App\Http\Controllers\JobController::class .'@renderAll');
Route::get('/informacje/{slug}-{id}', \App\Http\Controllers\ContentController::class .'@renderContentById')
    ->where('slug', '[a-z-]+')
    ->where('id', '[0-9]+')
    ->name('main.articles_by_id');


Route::get('/oddzialy/{slug}-{id}', \App\Http\Controllers\WardController::class .'@renderById')
    ->where('slug', '[a-z-]+')
    ->where('id', '[0-9]+')
    ->name('main.ward_by_id');

Route::get('/', \App\Http\Controllers\ContentController::class .'@renderHomepage');