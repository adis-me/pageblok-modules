<?php


namespace Pageblok\Menus\Models;

use Pageblok\Core\Models\ContentModel;

class MenuItem extends ContentModel
{

    protected $table = 'menu_items';

    protected $guarded = array('id');

    protected $fillable
        = array(
            'menu_ref',
            'type',
            'name',
            'description',
            'url',
            'target',
            'template',
            'css_classes',
            'priority',
            'published',
            'updated_at',
            'created_at',
            'created_by',
        );

    /**
     * @inheritdoc
     */
    public function getModelName()
    {
        return "menuitem";
    }

    /**
     * @inheritdoc
     */
    public function getPluralModelName()
    {
        return "menuitems";
    }
}
