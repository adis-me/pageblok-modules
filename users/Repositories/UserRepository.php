<?php

namespace Pageblok\Users\Repositories;

use Illuminate\Database\Eloquent\Model;
use Pageblok\Pageblok\Interfaces\Illuminate;
use Pageblok\Users\Interfaces\UserRepositoryInterface;
use Pageblok\Users\Models\User;

/**
 * Class UserRepository
 *
 * @package Pageblok\Users\Repositories
 * @author Adis Corovic <adis@live.nl>
 */
class UserRepository extends ConfideRepository implements UserRepositoryInterface
{


    /**
     * @var \Pageblok\Core\Models\BaseModel
     */
    protected $model;

    /**
     * @inheritdoc
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Convenient method to get the model
     * @return \Pageblok\Core\Models\BaseModel
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param User $model
     * @return User
     */
    public function setModel(User $model)
    {
        return $this->model = $model;
    }

    /**
     * @inheritdoc
     */
    public function allPaged()
    {
        return $this->model->paginate($this->model->getPageSize());
    }


    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        return $this->findById($id)->fill($data)->save();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}