<?php


namespace Pageblok\Menus\Models;


use Pageblok\Core\Models\ContentModel;

class Menu extends ContentModel
{

    protected $table = 'menus';

    protected $guarded = array('id');

    protected $fillable
        = array(
            'menu_group',
            'pb_name',
            'description',
            'template',
            'css_classes',
            'published',
            'updated_at',
            'created_at',
            'created_by',
        );

    /**
     * Get menu items that belong to this menu, ordered by priority and published
     */
    public function items()
    {
        return $this
            ->hasMany('\Pageblok\Menus\Models\MenuItem', 'menu_ref')
            ->where('published', true)
            ->orderBy('priority', 'ASC');
    }

    /**
     * @inheritdoc
     */
    public function getModelName()
    {
        return "menu";
    }

    /**
     * @inheritdoc
     */
    public function getPluralModelName()
    {
        return "menus";
    }
}
