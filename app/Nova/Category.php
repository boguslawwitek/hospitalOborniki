<?php

namespace App\Nova;

use App\Helpers\TemplatesHelper;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MultiSelect;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Category extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Category::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];



    public static function label()
    {
        return 'Kategorie';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Kategoria', 'name')->withMeta(['placeholder' => 'Nazwa kategorii']),
            Boolean::make('Wyświetlaj w menu', 'display_in_menu'),
            Number::make('Pozycja', 'priority'),
            Select::make('Typ', 'type')->options(function() {
                return [
                    'link' => 'link',
                    'dropDown' => 'dropDown'
                ];
            }),
            MultiSelect::make('Wyświetlane kategorie wewnetrz', 'menus')->options(function() {
                return Category::where('display_in_menu', 0)->pluck('name', 'id');
            }),
            Boolean::make('Listuj artykły z danej kategorii', 'display_articles'),
            Boolean::make('Lącz w jedna listę artykuły z kategorii wewnątrz', 'merge_categories'),
            Text::make('Url', 'url')->placeholder('Tylko w przypadku typu: "link"'),
            HasMany::make('Statyczne linki', 'additionalLinks', StaticMenuLinks::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    public function authorizedToDelete(Request $request)
    {
        return $this->resource->id != 11;
    }
}
