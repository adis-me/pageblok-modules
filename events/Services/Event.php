<?php


namespace Pageblok\Events\Services;


use Pageblok\Events\Interfaces\EventRepositoryInterface;

class Event
{

    protected $blockRepository;

    /**
     * @param EventRepositoryInterface $repository
     */
    public function __construct(EventRepositoryInterface $repository)
    {
        $this->blockRepository = $repository;
    }

    /**
     * Get all published events.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->blockRepository->allPublished();
    }

    public function getLatitudeLongitude($address, $city, $country)
    {
        $result = array(
            'latitude'  => null,
            'longitude' => null,
        );

        if (empty($address) || empty($city) || empty($country)) {
            return $result;
        }

        try {
            $geocode = \Geocoder::geocode($address . ', ' . $city . ', ' . $country);
            $result['latitude'] = $geocode->getLatitude();
            $result['longitude'] = $geocode->getLongitude();
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return $result;
    }
} 