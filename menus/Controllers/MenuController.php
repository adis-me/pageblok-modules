<?php


namespace Pageblok\Menus\Controllers;


use Pageblok\Core\Controllers\BaseController;
use Pageblok\Menus\Interfaces\MenuRepositoryInterface;
use Pageblok\Menus\Models\Menu;
use Pageblok\Pageblok\Controllers\PageblokController;

class MenuController extends BaseController
{

    /**
     * Set the menu and repository.
     *
     * @param MenuRepositoryInterface $menuRepository
     */
    public function __construct(MenuRepositoryInterface $menuRepository)
    {

        $this->repository = $menuRepository;

        parent::__construct();
    }

    /**
     * Show create form for a new menu.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $this->data = array(
            'templates' => \Pageblok::getTemplates("menu"),
        );

        return parent::create();
    }

    /**
     * Save a new menu.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save()
    {
        $this->data = array(
            'pb_name' => \Input::get('pb_name'),
            'description' => \Input::get('description'),
            'css_classes' => \Input::get('css_classes'),
            'published' => \Input::get('published'),
            'created_by' => \Auth::user()->id,
            'template' => \Input::get('template'),
        );
        return parent::save();
    }

    /**
     * Show edit form for an existing menu.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->data = array(
            'templates' => \Pageblok::getTemplates("menu"),
        );

        return parent::edit($id);
    }

    /**
     * Update an existing menu to the repository.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $data = array(
            'pb_name' => \Input::get('pb_name'),
            'description' => \Input::get('description'),
            'css_classes' => \Input::get('css_classes'),
            'published' => \Input::get('published'),
            'template' => \Input::get('template'),
        );

        return parent::update($id);
    }
} 