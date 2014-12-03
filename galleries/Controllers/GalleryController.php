<?php


namespace Pageblok\Galleries\Controllers;


use Pageblok\Core\Controllers\BaseController;
use Pageblok\Galleries\Interfaces\GalleryRepositoryInterface;


class GalleryController extends BaseController
{

    protected $repository;

    public function __construct(GalleryRepositoryInterface $galleryRepository)
    {
        $this->repository = $galleryRepository;

        parent::__construct();
    }

    /**
     * Show create form for a new gallery.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $this->data = array(
            'templates' => \Pageblok::getTemplates("gallery"),
        );

        return parent::create();
    }

    /**
     * Save a new gallery.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save()
    {
        $this->data = array(
            'pb_name' => \Input::get('pb_name'),
            'title' => \Input::get('title'),
            'description' => \Input::get('description'),
            'template' => \Input::get('template'),
            'class_name' => \Input::get('class_name'),
            'published' => \Input::get('published'),
            'created_by' => \Auth::user()->id,
        );

        return parent::save();
    }

    /**
     * Show edit form for a gallery.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->data = array(
            'templates' => \Pageblok::getTemplates("gallery"),
        );

        return parent::edit($id);
    }


    /**
     * Update an existing gallery to the repository.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $this->data = array(
            'pb_name' => \Input::get('pb_name'),
            'title' => \Input::get('title'),
            'description' => \Input::get('description'),
            'template' => \Input::get('template'),
            'class_name' => \Input::get('class_name'),
            'published' => \Input::get('published'),
            'created_by' => \Auth::user()->id,
        );

        return parent::update($id);
    }
} 