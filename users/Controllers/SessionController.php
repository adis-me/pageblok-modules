<?php

namespace Pageblok\Users\Controllers;

use Pageblok\Users\Interfaces\UserRepositoryInterface;
use Zizaco\Confide\Confide;

class SessionController extends \Controller
{
    protected $repository;

    /**
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show login form.
     *
     * @return Illuminate\Http\Response
     */
    public function login()
    {
        if (\Confide::user()) {

            return \Redirect::route('app.home');
        } else {
            return \View::make("users::sessions.login");
        }
    }

    /**
     * Attempt to login.
     *
     * @return Illuminate\Http\Response
     */
    public function authenticate()
    {
        $input = \Input::all();
        $input['remember_me'] = true;

        if ($this->repository->login($input)) {
            \Notification::success(
                \Notification::message(\Lang::get('users::app.welcome_back'))->flash()
            );
            return \Redirect::intended('/');
        } else {
            if ($this->repository->isThrottled($input)) {
                \Notification::error(
                    \Notification::message(\Lang::get('users::app.too_many_attempts'))->flash()
                );
            } elseif ($this->repository->existsButNotConfirmed($input)) {
                \Notification::error(
                    \Notification::message(\Lang::get('users::app.not_confirmed'))->flash()
                );
            } else {
                \Notification::error(
                    \Notification::message(\Lang::get('users::app.wrong_credentials'))->flash()
                );
            }

            return \Redirect::route('app.session.login');
        }
    }

    /**
     * Logout a user.
     *
     * @return Illuminate\Http\Response
     */
    public function logout()
    {
        \Confide::logout();

        return \Redirect::route('app.home');
    }

    /**
     * Show registration form.
     *
     * @return Illuminate\Http\Response
     */
    public function register()
    {
        return \View::make("users::sessions.register");
    }

    /**
     * Save a new user.
     *
     * @return Illuminate\Http\Response
     */
    public function handleRegistration()
    {
        $user = $this->repository->signup(\Input::all());

        if ($user->id) {
            if (\Config::get('confide::signup_email')) {
                \Mail::queueOn(
                    \Config::get('confide::email_queue'),
                    \Config::get('confide::email_account_confirmation'),
                    compact('user'),
                    function ($message) use ($user) {
                        $message
                            ->to($user->email, $user->username)
                            ->subject(\Lang::get('confide::confide.email.account_confirmation.subject'));
                    }
                );
            }
            \Notification::success(
                \Notification::message(\Lang::get('users::app.user.registered'))->flash()
            );

            return \Redirect::route('app.session.login');

        } else {
            $errors = $user->errors()->all(':message');

            if (is_array($errors) && $errors) {
                foreach ($errors as $error) {
                    \Notification::error(
                        \Notification::message(\Lang::get($error))->flash()
                    );
                }
            } else {
                \Notification::error(
                    \Notification::message(\Lang::get('users::app.registration.failed'))->flash()
                );
            }


            return \Redirect::route('app.session.register');
        }
    }
} 