<?php

namespace App\Nova;

use Advoor\NovaEditorJs\NovaEditorJsField;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Subsidies extends Resource
{
    public static $model = \App\Models\Subsidies::class;

    public static $title = 'title';

    public static $search = [
        'title',
    ];

    public static function label()
    {
        return 'Dofinansowania';
    }

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Tytuł', 'title'),
            NovaEditorJsField::make('Treść', 'body')->hideFromIndex(),
            Image::make('Logo', 'image')->path('subsidies-logos'),
            BelongsTo::make('Sekcja', 'type', SubsidiesTypes::class),
            HasMany::make('Zdjęcia', 'photos', SubsidiesPhotos::class),

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
}
