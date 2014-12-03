<?php


namespace Pageblok\Users\Models;


use Pageblok\Core\Models\BaseModel;
use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;

class User extends \Eloquent implements ConfideUserInterface
{

    use ConfideUser;
    use HasRole;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * Guarded properties
     * @var array
     */
    protected $guarded = array('id');

    /**
     * Construct full name based on first name and lastname
     * @return mixed|string
     */
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @inheritdoc
     */
    public function getModelName()
    {
        return "user";
    }

    /**
     * @inheritdoc
     */
    public function getPluralModelName()
    {
        return "users";
    }

    public function getPageSize()
    {
        return 20;
    }
}