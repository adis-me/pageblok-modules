<?php


namespace Pageblok\Users\Controllers;

use Pageblok\Core\Controllers\BaseController;
use Pageblok\Users\Interfaces\UserRepositoryInterface;
use Pageblok\Users\Models\Role;

/**
 * Class UsersController
 * @package Pageblok\Users\Controllers
 * @author Adis Corovic <adis@live.nl>
 */
class UsersController extends BaseController
{


    /**
     * Constructor, set the repository via IoC.
     *
     * @param UserRepositoryInterface $repository
     * @internal param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $this->data = [
            'first_name' => \Input::get('first_name'),
            'last_name' => \Input::get('last_name'),
            'email' => \Input::get('email'),
            'username' => \Input::get('username'),
        ];

        $user = $this->repository->signup(\Input::all());
        dd($user);
        $roles = Role::all();

        if (is_array(\Input::get('roles'))) {
            foreach (\Input::get('roles') as $key => $userRole) {
                $roles->each(
                    function ($role) use ($user, $userRole) {
                        if ($userRole == $role->name) {
                            $user->attachRole($role);
                        }
                    }
                );
            }
        }


    }

    public function edit($id)
    {
        $this->data = [
            'roles' => Role::all(),
        ];

        return parent::edit($id);
    }

    /**
     * @inheritdoc
     */
    public function update($id)
    {
        $this->data = [
            'first_name' => \Input::get('first_name'),
            'last_name' => \Input::get('last_name'),
            'email' => \Input::get('email'),
            'username' => \Input::get('username'),
        ];

        $user = $this->repository->findById($id);
        $roles = Role::all();
        $user->getModel()->detachRoles($roles);
        if (is_array(\Input::get('roles'))) {
            foreach (\Input::get('roles') as $key => $userRole) {
                $roles->each(
                    function ($role) use ($user, $userRole) {
                        if ($userRole == $role->name) {
                            $user->getModel()->attachRole($role);
                        }
                    }
                );
            }
        }

        return parent::update($id);
    }
} 