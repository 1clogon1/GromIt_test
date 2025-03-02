<?php

namespace GromIT\Catalog\Models;

use Model;
use October\Rain\Database\Traits\NestedTree;

class Category extends Model
{
    use NestedTree;

    protected $table = 'gromit_catalog_categories';

    protected $fillable = ['name', 'parent_id', 'wbs'];

    public $rules = [
        'name' => 'required|string|max:255',
    ];

    public function afterSave()
    {
        $this->generateWbs();
        $this->saveQuietly();

        $this->updateChildWbs();
    }

    private function generateWbs()
    {
        if (!$this->parent_id) {
            $this->wbs = (string)$this->id;
        } else {
            $this->load('parent');
            $parentWbs = $this->parent->wbs;

            $siblings = $this->parent->children()->orderBy('id')->get();
            $position = $siblings->search(function ($sibling) {
                    return $sibling->id === $this->id;
                }) + 1;

            $this->wbs = $parentWbs . '.' . $position;
        }
    }

    private function updateChildWbs()
    {
        foreach ($this->children as $child) {
            $child->generateWbs();
            $child->saveQuietly();
            $child->updateChildWbs();
        }
    }
}
