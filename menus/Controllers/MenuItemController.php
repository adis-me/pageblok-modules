<?php


namespace Pageblok\Menus\Controllers;


use Pageblok\Menus\Interfaces\MenuItemRepositoryInterface;
use Pageblok\Menus\Models\MenuItem;

class MenuItemController extends \Controller
{

    protected $repository;

    /**
     * Default constructor, inject repository.
     *
     * @param MenuItemRepositoryInterface $menuItemRepository
     */
    public function __construct(MenuItemRepositoryInterface $menuItemRepository)
    {
        $this->repository = $menuItemRepository;
    }

    /**
     * Show a list of menu items that are part of a menu.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function index($id)
    {

        $this->data = array(
            'id' => $id,
            'items' => $this->repository->findByMenuId($id),
        );

        return \View::make('menus::items.index', $this->data);
    }

    /**
     * Show the create form for a new menu item.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        $data = array(
            'item' => new MenuItem(),
            'id' => $id,
            'formRoute' => 'app.admin.menus.items.save',
        );

        return \View::make('menus::items.form', $data);
    }

    /**
     * Save a new menu item to the repository.
     *
     * @param $id Menu id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($id)
    {
        $data = array(
            'name' => \Input::get('name'),
            'target' => \Input::get('target'),
            'type' => \Input::get('type'),
            'description' => \Input::get('description'),
            'menu_ref' => $id,
            'url' => \Input::get('url'),
            'priority' => \Input::get('priority'),
            'css_classes' => \Input::get('css_classes'),
            'published' => \Input::get('published'),
            'created_by' => \Auth::user()->id,
        );

        $savedMenuItem = $this->repository->create($data);

        if (!$savedMenuItem) {
            \Notification::error("Menu item {$data['name']} could not be created, please try again");

            \Redirect::route('app.menus.items.create', $id);
        }
        \Notification::success("Menu item {$data['name']} created");

        return \Redirect::route('app.admin.menus.items', $id);
    }

    /**
     * Show edit form for an existing menu item.
     *
     * @param int $id Menu item id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->data = array(
            'id' => $id,
            'formRoute' => 'app.admin.menus.items.update',
            'item' => $this->repository->findById($id),
            'templates' => \Pageblok::getTemplates("galleryitem"),
        );

        return \View::make('menus::items.form', $this->data);
    }

    /**
     * Update and existing menu item to the repository.
     *
     * @param int $id Menu Item id.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $data = array(
            'name' => \Input::get('name'),
            'target' => \Input::get('target'),
            'type' => \Input::get('type'),
            'description' => \Input::get('description'),
            'url' => \Input::get('url'),
            'priority' => \Input::get('priority'),
            'css_classes' => \Input::get('css_classes'),
            'published' => \Input::get('published'),
        );

        $updatedMenuItem = $this->repository->update($id, $data);

        if (!$updatedMenuItem) { // update will return true if successful
            \Notification::error("Menu item {$data['name']} could not be updated, please try again");

            return \Redirect::route('app.admin.galleries.edit', $id);
        }
        \Notification::success("Menu item {$data['name']} updated");

        return \Redirect::route('app.admin.menus.items', \Input::get('menu_ref'));
    }

    /**
     * Delete one or more models by providing the id of the model(s) that should be deleted.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete()
    {
        $listIds = \Input::get('id');

        $deletionSucceeded = false;
        foreach ($listIds as $id) {
            if (is_null($this->repository->findById($id))) {
                \Notification::error("{$this->repository->getModel()->getModelName()} does not exists, already deleted?");

                return \Redirect::route("app.admin.menus");
            }
            $deletionSucceeded .= $this->repository->delete($id);

        }

        if (!$deletionSucceeded) {
            \Notification::error("{$this->repository->getModel()->getModelName()} could not be deleted, please try again");
        }

        \Notification::success("Deletion succeeded");

        return \Redirect::route("app.admin.menus");
    }
}
