<?php

namespace Snijenhuis\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Sentinel;
use Snijenhuis\Modules\Auth\Http\Requests\LoginRequest;
use Snijenhuis\Modules\Auth\Http\Requests\RegisterRequest;
use Snijenhuis\Modules\Auth\Repositories\UserRepository;

class AuthController extends Controller
{


    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectToRoute;
    protected $sentinel;
    protected $userRepository;

    public function __construct(Sentinel $sentinel, UserRepository $userRepository)
    {
        $this->sentinel = $sentinel;
        $this->userRepository = $userRepository;
        $this->redirectToRoute = config('snijenhuis.auth.route.after_login');
    }

    /**
     * Shows the login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('auth::pages.login');
    }

    /**
     * Attempts to log a user in.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(LoginRequest $request)
    {
        try {
            $user = $this->sentinel->authenticate([
                'email' => $request->get('email'),
                'password' => $request->get('password')
            ], $request->has('remember'));

            if($user) {
                // This prevents people accidently logging in manually on a social account.
                if(is_null($user->providers->first())) {
                    return redirect()->route($this->redirectToRoute);
                }
                $error = "You can only use social login with this e-mail.";
            } else {
                $error = 'Invalid email or password.';
            }


        } catch (NotActivatedException $e){
            $error = "Account is not activated!";
        } catch (ThrottlingException $e)
        {
            $delay = $e->getDelay();
            $error = "Your account is blocked for {$delay} second(s).";
        }

        $errors = ['login_attempt' => $error];

        return redirect()->back()->withInput()->withErrors($errors);
    }

    public function getRegister()
    {
        return view('auth::pages.register');
    }

    /**
     * @param RegisterRequest $request
     */
    public function postRegister(RegisterRequest $request)
    {
        $user = $this->userRepository->register($request->only([
            'email',
            'password',
            'first_name',
            'last_name'
        ]));
        
        if($user->registered) {
            return redirect()->route('auth.login.get')->withMessage($user->message);
        }
        
        return redirect()->back()->withInput()->withErrors(['register_attempt' => $user->error]);
    }

    public function getActivate($code)
    {
        $user = $this->userRepository->activate($code);
        if($user->activated) {
            return redirect()->route('auth.login.get')->withMessage($user->message);
        }
        return view('auth::pages.activation')->withErrors($user->error);
    }
    /**
     * Logs the user out
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        $this->sentinel->logout();
        return redirect()->route('auth.login.get');
    }
}
