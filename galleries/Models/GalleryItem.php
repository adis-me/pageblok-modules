<?php


namespace Pageblok\Galleries\Models;

use Pageblok\Core\Models\ContentModel;

class GalleryItem extends ContentModel
{
    protected $table = 'gallery_items';

    protected $guarded = array('id');

    protected $fillable
        = array(
            'gallery_ref',
            'pb_name',
            'title',
            'caption',
            'image_ref',
            'thumbnail_ref',
            'class_name',
            'template',
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
        return "galleryitem";
    }

    /**
     * @inheritdoc
     */
    public function getPluralModelName()
    {
        return "galleryitems";
    }
}