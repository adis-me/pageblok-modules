<?php


namespace Pageblok\Galleries\Controllers;

use Pageblok\Galleries\Interfaces\GalleryItemRepositoryInterface;
use Pageblok\Galleries\Interfaces\ItemRepositoryInterface;
use Pageblok\Galleries\Models\GalleryItem;
use Pageblok\Galleries\Models\Item;

class GalleryItemController extends \Controller
{

    protected $repository;

    /**
     * Constructor, set repository.
     *
     * @param GalleryItemRepositoryInterface $galleryItemRepository
     */
    public function __construct(GalleryItemRepositoryInterface $galleryItemRepository)
    {
        $this->repository = $galleryItemRepository;
    }


    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        $data = array(
            'id' => $id,
            'items' => $this->repository->findByGalleryId($id),
        );

        return \View::make('galleries::items.index', $data);
    }

    /**
     * Show create form for a new gallery item.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        $data = array(
            'item' => new GalleryItem(),
            'id' => $id,
            'templates' => \Pageblok::getTemplates("galleryitem"),
            'formRoute' => 'app.admin.galleries.items.save',
        );

        return \View::make('galleries::items.form', $data);
    }

    /**
     * Save item to the repository.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($id)
    {
        $this->data = array(
            'pb_name' => \Input::get('pb_name'),
            'title' => \Input::get('title'),
            'caption' => \Input::get('caption'),
            'template' => \Input::get('template'),
            'gallery_ref' => $id,
            'thumbnail_ref' => \Input::get('thumbnail_ref'),
            'class_name' => \Input::get('class_name'),
            'published' => \Input::get('published'),
            'created_by' => \Auth::user()->id,
        );

        if (\Input::file('image_ref')) {
            $this->data['image_ref'] = \Pageblok::uploadFile(\Input::file('image_ref'));
        }

        $savedItem = $this->repository->create($this->data);

        if (!$savedItem) {
            \Notification::error(" {$this->data['pb_name']} item could not be created, please try again");

            return \Redirect::route('app.admin.galleries.items.create');
        }
        \Notification::success(" {$this->data['pb_name']} item created");

        return \Redirect::route('app.admin.galleries.items', $id);
    }

    /**
     * Show edit form for an existing gallery item.
     *
     * @param int $id  item id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = array(
            'id' => $id,
            'templates' => \Pageblok::getTemplates("galleryitem"),
            'formRoute' => 'app.admin.galleries.items.update',
            'item' => $this->repository->findById($id)
        );

        return \View::make('galleries::items.form', $data);
    }

    /**
     * Update an existing gallery item to the repository.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $this->data = array(
            'pb_name' => \Input::get('pb_name'),
            'title' => \Input::get('title'),
            'caption' => \Input::get('caption'),
            'template' => \Input::get('template'),
            'thumbnail_ref' => \Input::get('thumbnail_ref'),
            'class_name' => \Input::get('class_name'),
            'published' => \Input::get('published'),
        );

        if (\Input::get('remove_image')) {
            $this->data['image_ref'] = null;
        } elseif (\Input::file('image_ref')) {
            $this->data['image_ref'] = \Pageblok::uploadFile(\Input::file('image_ref'));
        }

        $updated = $this->repository->update($id, $this->data);

        if (!$updated) {
            \Notification::error(" item {$this->data['pb_name']} could not be updated, please try again");

            return \Redirect::route('app.admin.galleries.edit', $id);
        }
        \Notification::success(" item {$this->data['pb_name']} updated");

        return \Redirect::route('app.admin.galleries.items', \Input::get('gallery_ref'));
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

                return \Redirect::route("app.admin.galleries");
            }
            $deletionSucceeded .= $this->repository->delete($id);
        }

        if (!$deletionSucceeded) {
            \Notification::error("Gallery could not be deleted, please try again");
        }

        \Notification::success("Deletion succeeded");

        return \Redirect::route("app.admin.galleries");
    }
} 