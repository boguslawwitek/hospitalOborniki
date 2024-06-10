<?php

namespace App\Helpers;

class TemplatesHelper
{
    public static function getTemplatesForContent(): array
    {
        $resourcePath = base_path('resources/views/content');

        $availableTemplates = [];
        foreach (glob($resourcePath . '/*.blade.php') as $view) {
            $path = explode('/', $view);
            $viewName = str_replace('.blade.php', '', end($path));
            $availableTemplates[$viewName] = $viewName;
        }

        return $availableTemplates;
    }
}
