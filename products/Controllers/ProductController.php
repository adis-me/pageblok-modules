<?php


namespace Pageblok\Products\Controllers;


use Pageblok\Core\Controllers\BaseController;
use Pageblok\Products\Interfaces\ProductRepositoryInterface;

/**
 * Class CatalogController
 * @package Pageblok\Products\Controllers
 * @author Adis Corovic <adis@live.nl>
 */
class ProductController extends BaseController
{
    protected $categories;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->repository = $productRepository;
        $this->categories = $productRepository->getCategories();

        parent::__construct();
    }


    /**
     * @inheritdoc
     */
    public function index()
    {
        $category = \Input::get('categories');
        if ($category) {
            $this->data['products'] = $this->repository->getByCategory($category);

        } else {
            $category = \Lang::get("products::app.please.select");
        }

        $this->data['categories'] = $this->categories;
        $this->data['selectedCategory'] = ucfirst($category);

        return parent::index();
    }

    /**
     * Show create form for a new product
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->data = [
            'templates' => \Pageblok::getTemplates("$this->modelName"),
            'contentTypes' => \Pageblok::getContentTypes(),
            'defaultTemplate' => \Block::getDefaultTemplate(),
        ];

        return parent::create();
    }

    /**
     * Save a new product instance
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save()
    {
        $this->data = [
            'name' => \Input::get('name'),
            'brand' => \Input::get('brand'),
            'category' => \Input::get('category'),
            'price' => (float) \Input::get('price'),
            'css_classes' => \Input::get('css_classes'),
            'image_ref' => \Pageblok::uploadFile(\Input::file('image_ref')),
            'hyperlink' => \Input::get('hyperlink'),
            'template' => \Input::get('template'),
            'content_type' => \Input::get('content_type'),
            'content' => \Input::get('content'),
            'published' => \Input::get('published'),
            'group' => \Input::get('group'),
            'created_by' => \Auth::user()->id,
        ];

        if (\Input::file('image_ref')) {
            $this->data['image_ref'] = \Pageblok::uploadFile(\Input::file('image_ref'));
        }

        return parent::save();
    }

    /**
     * Show edit form for a new product
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->data = [
            'templates' => \Pageblok::getTemplates("$this->modelName"),
            'contentTypes' => \Pageblok::getContentTypes(),
            'defaultTemplate' => \Block::getDefaultTemplate(),
        ];

        return parent::edit($id);
    }

    /**
     * Update an existing product
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update($id)
    {
        $this->data = [
            'name' => \Input::get('name'),
            'brand' => \Input::get('brand'),
            'category' => \Input::get('category'),
            'price' => (float) \Input::get('price'),
            'template' => \Input::get('template'),
            'content_type' => \Input::get('content_type'),
            'content' => \Input::get('content'),
            'hyperlink' => \Input::get('hyperlink'),
            'css_classes' => \Input::get('css_classes'),
            'published' => \Input::get('published'),
            'group' => \Input::get('group'),
        ];

        if (\Input::get('remove_image')) {
            $this->data['image_ref'] = null;
        } elseif (\Input::file('image_ref')) {
            $this->data['image_ref'] = \Pageblok::uploadFile(\Input::file('image_ref'));
        }

        return parent::update($id);
    }
}