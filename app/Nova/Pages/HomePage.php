<?php

namespace App\Nova\Pages;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Resource;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;


class HomePage extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Pages\HomePage';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * The group that the resource belongs to.
     * 
     * @var group
     */
    public static $group = "Pages";

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            new Panel(
                'Subheading',
                [Text::make('Subheading')]
            ),

            new Panel('About Us', [
                Text::make('About Us Title'),
                Trix::make('About Us Text')->alwaysShow(),
            ]),

            new Panel('Our Products', [
                Text::make('Our Products Title'),
                Trix::make('Our Products Text')->alwaysShow(),
            ]),

            new Panel('Contact Us', [
                Text::make('Contact Us Title'),
                Trix::make('Contact Us Text')->alwaysShow(),
            ]),

            new Panel('Footer', [
                Images::make('Images', 'footer-image'), // second parameter is the media collection name
                Text::make('Footer Title'),
                Trix::make('Footer Text')->alwaysShow(),
            ]),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Home Page';
    }
}
