<?php

namespace App\Nova;

use Advoor\NovaEditorJs\NovaEditorJsField;
use App\Helpers\TemplatesHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Manogi\Tiptap\Tiptap;
use Stepanenko3\NovaMarkdown\Markdown;

class Content extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Content::class;

    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
    ];

    public static function label()
    {
        return 'Artykuły';
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
            Text::make('Tytuł', 'title')->displayUsing(function ($title) {
                return Str::limit($title, 100);
            }),
            Boolean::make('Pokaż w menu', 'display_on_menu'),
            NovaEditorJsField::make('Treść', 'body')->hideFromIndex(),
            BelongsTo::make('Kategoria', 'category', Category::class)->readonly(function() {
                return $this->resource->category_id == 11;
            }),
            HasMany::make('Załączniki', 'attachments', Attachment::class),
            HasMany::make('Zdjęcia', 'photos', Photos::class),
            BelongsToMany::make('Komunikaty', 'notifications', Notification::class),
            BelongsToMany::make('Pracownicy', 'employees', Employee::class),
            Select::make('Szablon', 'template')->options(function() {
                return TemplatesHelper::getTemplatesForContent();
            })
        ];
    }

    /**
     * Get the cards available for the request.
     *NOO
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
        return $this->resource->category_id != 11;
    }
}
