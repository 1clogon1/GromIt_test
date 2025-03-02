<?php namespace GromIT\Catalog;

use Backend;
use Illuminate\Support\Facades\Route;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'Catalog',
            'description' => 'Плагин для управления вложенной структурой каталога',
            'author' => 'GromIT',
            'icon' => 'icon-leaf'
        ];
    }

    public function register()
    {
        //
    }

    public function boot()
    {
        Route::get('admin/gromit/catalog/categories', 'GromIT\Catalog\Controllers\CategoryController@index');
    }

    public function registerComponents()
    {
        return [];
    }

    public function registerPermissions()
    {
        return [
            'gromit.catalog.*' => [
                'tab' => 'Catalog',
                'label' => 'Управление каталогом'
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'catalog' => [
                'label' => 'Каталог',
                'url' => Backend::url('gromit/catalog/categories'),
                'icon' => 'icon-list',
                'permissions' => ['gromit.catalog.*'],
                'order' => 500,
                'sideMenu' => [
                    'categories' => [
                        'label' => 'Категории',
                        'icon' => 'icon-list',
                        'url' => Backend::url('gromit/catalog/categories'),
                    ],
                ],
            ],
        ];
    }
}
