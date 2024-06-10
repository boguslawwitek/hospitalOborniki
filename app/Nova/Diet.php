<?php

namespace App\Nova;

use Advoor\NovaEditorJs\NovaEditorJsField;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Diet extends Resource
{
    public static $model = \App\Models\Diet::class;

    public static $title = 'title';

    public static $search = [
        'id',
    ];


    public static function label()
    {
        return 'Diety';
    }

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Nazwa', 'title'),
            Boolean::make('Pokazuj na stronie', 'is_active'),
            Date::make('Data obowiazywania diety', 'when'),
            NovaEditorJsField::make('Śniadanie', 'breakfast')->hideFromIndex(),
            Image::make('Zdjęcie sniadania' , 'breakfast_photo')->path('diets'),
            NovaEditorJsField::make('Obiad', 'diner')->hideFromIndex(),
            Image::make('Zdjęcie obiadu' , 'diner_photo')->path('diets'),
            File::make('Załacznik', 'attachment')->path('diets'),

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
