<?php


namespace Pageblok\Events\Models;


use Pageblok\Core\Models\ContentModel;

class Event extends ContentModel
{

    /**
     * Table name
     */
    protected $table = 'events';

    /**
     * Guarded properties cannot be assigned
     */
    protected $quarded = array('id');

    /**
     * Fillable properties
     */
    protected $fillable
        = array(
            'pb_name',
            'title',
            'subtitle',
            'image_ref',
            'hyperlink',
            'css_classes',
            'description',
            'template',
            'content_type',
            'content',
            'published',
            'start_datetime',
            'end_datetime',
            'address',
            'city',
            'country',
            'latitude',
            'longitude',
            'updated_at',
            'created_at',
            'created_by',
        );

    /**
     * @inheritdoc
     */
    public function getModelName()
    {
        return "event";
    }

    /**
     * @inheritdoc
     */
    public function getPluralModelName()
    {
        return "events";
    }
}