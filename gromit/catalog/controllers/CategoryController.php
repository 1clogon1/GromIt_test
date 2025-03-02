<?php

namespace GromIT\Catalog\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use GromIT\Catalog\Models\Category;

class CategoryController extends Controller
{
    public $implement = ['Backend\Behaviors\ListController', 'Backend\Behaviors\FormController'];

    public $listConfig = 'plugins/gromit/catalog/controllers/categories/config_list.yaml';
    public $formConfig = 'plugins/gromit/catalog/controllers/categories/config_form.yaml';

    public $modelClass = \GromIT\Catalog\Models\Category::class;

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('GromIT.Catalog', 'catalog', 'categories');
    }

    public function index()
    {
        $categories = Category::all();
        return $this->makePartial('categories_list', ['categories' => $categories]);
    }

    public function onMoveCategory()
    {
        $nodeId = post('node_id');
        $targetId = post('target_id');

        $node = Category::find($nodeId);
        $target = Category::find($targetId);

        if ($node && $target) {
            $node->makeChildOf($target);
            $node->generateWbs();
            $node->save();
            $node->updateChildWbs();
        }

        return ['success' => true];
    }

    public function listCategories()
    {
        return Category::pluck('name', 'id')->toArray();
    }

    public function onLoadFormData()
    {
        $this->vars['categories'] = $this->listCategories();
    }
}
