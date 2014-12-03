<?php


namespace Pageblok\Galleries\Models;

use Pageblok\Core\Models\ContentModel;

class Gallery extends ContentModel
{

    protected $table = 'galleries';

    protected $guarded = array('id');

    protected $fillable
        = array(
            'pb_name',
            'title',
            'template',
            'description',
            'class_name',
            'published',
            'updated_at',
            'created_at',
            'created_by',
        );

    /**
     * Get gallery items that belong to this gallery
     */
    public function items()
    {
        return $this->hasMany('\Pageblok\Galleries\Models\GalleryItem', 'gallery_ref');
    }

    /**
     * @inheritdoc
     */
    public function getModelName()
    {
        return "gallery";
    }

    /**
     * @inheritdoc
     */
    public function getPluralModelName()
    {
        return "galleries";
    }
}