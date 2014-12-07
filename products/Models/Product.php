<?php


namespace Pageblok\Products\Models;

use Pageblok\Core\Models\ContentModel;


/**
 * Class Product
 * @package Pageblok\Products\Models
 * @author Adis Corovic <adis@live.nl>
 */
class Product extends ContentModel
{

    /**
     * Table name
     */
    protected $table = 'products';

    /**
     * Guarded properties cannot be assigned
     */
    protected $quarded = array('id');

    /**
     * Fillable properties
     */
    protected $fillable
        = array(
            'name',
            'brand',
            'image_ref',
            'hyperlink',
            'css_classes',
            'template',
            'content_type',
            'content',
            'published',
            'category',
            'price',
            'updated_at',
            'created_at',
            'created_by',
        );

    /**
     * When setting quantity we should update the total price
     * @param $value
     */
    public function setQuantityAttribute($value) {

        $this->attributes['quantity'] = empty($value) ? 0 : $value;

        $this->attributes['totalPrice'] = $value * $this->price;
    }

    /**
     * @inheritdoc
     */
    public function getPluralModelName()
    {
        return "products";
    }

    /**
     * @inheritdoc
     */
    public function getModelName()
    {
        return "product";
    }
} 