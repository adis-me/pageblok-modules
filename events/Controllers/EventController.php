<?php


namespace Pageblok\Events\Controllers;


use Pageblok\Core\Controllers\BaseController;
use Pageblok\Events\Interfaces\EventRepositoryInterface;
use Pageblok\Pageblok\Controllers\PageblokController;

class EventController extends BaseController
{
    protected $repository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->repository = $eventRepository;

        parent::__construct();
    }


    /**
     * Show create form
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->data = [
            'templates'    => \Pageblok::getTemplates("event"),
            'contentTypes' => \Pageblok::getContentTypes(),
        ];

        return parent::create();
    }

    /**
     * Save a new block to the repository.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save()
    {
        $this->data = [
            'pb_name'        => \Input::get('pb_name'),
            'title'          => \Input::get('title'),
            'subtitle'       => \Input::get('subtitle'),
            'description'    => \Input::get('description'),
            'css_classes'    => \Input::get('css_classes'),
            'image_ref'      => \Pageblok::uploadFile(\Input::file('image_ref')),
            'hyperlink'      => \Input::get('hyperlink'),
            'template'       => \Input::get('template'),
            'content_type'   => \Input::get('content_type'),
            'content'        => \Input::get('content'),
            'published'      => \Input::get('published'),
            'start_datetime' => \Carbon::parse(\Input::get('start_datetime'))->format('Y-m-d H:i:s'),
            'end_datetime'   => \Carbon::parse(\Input::get('end_datetime'))->format('Y-m-d H:i:s'),
            'address'        => \Input::get('address'),
            'city'           => \Input::get('city'),
            'country'        => \Input::get('country'),
            'group'          => \Input::get('group'),
            'created_by'     => \Auth::user()->id,
        ];

        if ($this->data['address'] && $this->data['city']) {
            $this->data['latitude'] = \TsEvent::getLatitudeLongitude(
                \Input::get('address'),
                \Input::get('city'),
                \Input::get('country')
            )['latitude'];
        }
        $this->data['longitude'] = \TsEvent::getLatitudeLongitude(
            \Input::get('address'),
            \Input::get('city'),
            \Input::get('country')
        )['longitude'];

        return parent::save();
    }

    /**
     * Show edit form for an existing event.
     *
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->data = array(
            'templates'    => \Pageblok::getTemplates("event"),
            'contentTypes' => \Pageblok::getContentTypes(),
        );

        return parent::edit($id);
    }

    /**
     * Update an existing block to the repository.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $this->data = [
            'pb_name'        => \Input::get('pb_name'),
            'title'          => \Input::get('title'),
            'subtitle'       => \Input::get('subtitle'),
            'description'    => \Input::get('description'),
            'css_classes'    => \Input::get('css_classes'),
            'hyperlink'      => \Input::get('hyperlink'),
            'template'       => \Input::get('template'),
            'content_type'   => \Input::get('content_type'),
            'content'        => \Input::get('content'),
            'published'      => \Input::get('published'),
            'start_datetime' => \Carbon::parse(\Input::get('start_datetime'))->format('Y-m-d H:i:s'),
            'end_datetime'   => \Carbon::parse(\Input::get('end_datetime'))->format('Y-m-d H:i:s'),
            'address'        => \Input::get('address'),
            'city'           => \Input::get('city'),
            'country'        => \Input::get('country'),
            'latitude'       => \TsEvent::getLatitudeLongitude(
                \Input::get('address'),
                \Input::get('city'),
                \Input::get('country')
            )['latitude'],
            'longitude'      => \TsEvent::getLatitudeLongitude(
                \Input::get('address'),
                \Input::get('city'),
                \Input::get('country')
            )['longitude'],
            'group'          => \Input::get('group'),
            'created_by'     => \Auth::user()->id,
        ];

        if (\Input::get('remove_image')) {
            $this->data['image_ref'] = null;
        } elseif (\Input::file('image_ref')) {
            $this->data['image_ref'] = \Pageblok::uploadFile(\Input::file('image_ref'));
        }

        return parent::update($id);
    }

} 