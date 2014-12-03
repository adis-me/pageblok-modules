<?php


namespace Pageblok\Users\Controllers;

use Pageblok\Users\Interfaces\UserRepositoryInterface;

class UserController extends \Controller
{

    protected $repository;

    /**
     * Constructor, set the repository via IoC.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * Confirm user after registration
     * @param $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm($code)
    {
        if (\Confide::confirm($code)) {
            \Notification::success(
                \Notification::message(\Lang::get('users::app.confirmation_succeeded'))->flash()
            );

            return \Redirect::route('app.session.login');

        } else {
            \Notification::error(
                \Notification::message(\Lang::get('users::app.confirmation_failed'))->flash()
            );

            return \Redirect::route('app.session.login');
        }
    }

    /**
     * Show password forgot form
     * @return \Illuminate\View\View
     */
    public function forgotPassword()
    {
        return \View::make('pageblok::users.forgotPasswordForm');
    }

    /**
     * Handle the forgot password submission. Send reset email or let the user try again.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleForgottenPassword()
    {
        if (\Confide::forgotPassword(\Input::get('email'))) {
            \Notification::success(\Notification::message(\Lang::get('users::app.reset.email.sent'))->flash());

            return \Redirect::route('app.session.login');
        } else {
            \Notification::error(
                \Notification::message(\Lang::get('users::app.error_occurred_try_again'))->flash()
            );

            return \Redirect::route('app.users.forgot.password');
        }
    }

    /**
     * Reset password form
     * @param $token
     * @return \Illuminate\View\View
     */
    public function resetPassword($token)
    {
        return \View::make('pageblok::users.resetPasswordForm', array('token' => $token));
    }

    /**
     * Perform the actual resetting of the password
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleResetPassword()
    {
        $input = array(
            'token' => \Input::get('token'),
            'password' => \Input::get('password'),
            'password_confirmation' => \Input::get('password_confirmation'),
        );

        // By passing an array with the token, password and confirmation
        if ($this->repository->resetPassword($input)) {
            \Notification::success(
                \Notification::message(\Lang::get('users::app.password.reset.succeeded'))->flash()
            );

            return \Redirect::route('app.session.login');
        } else {
            \Notification::error(
                \Notification::message(\Lang::get('users::app.password.reset.error'))->flash()
            );

            return \Redirect::route('app.users.reset.password', array('token' => $input['token']));
        }
    }
} 