<?php

namespace Snijenhuis\Modules\Auth\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Sentinel;
use Exception;
use Illuminate\Http\Request;
use \InvalidArgumentException;
use Snijenhuis\Modules\Auth\Exceptions\SignupDisabledException;
use Snijenhuis\Modules\Auth\Repositories\UserRepository;

class SocialController extends Controller
{


    protected $redirectToRoute;

    public function __construct()
    {
        $this->redirectToRoute = config('snijenhuis.auth.route.after_login');
    }
    /**
     * @param $provider
     * @return mixed
     */
    public function redirectToProvider($provider)
    {
        try{
            $socialite = socialite()->driver($provider);

            if($scopes = config("services.{$provider}.scopes")) {
                $socialite->scopes($scopes);
            }
            if($with = config("services.{$provider}.with")) {
                $socialite->with($with);
            }
            if($fields = config("services.{$provider}.fields")) {
                $socialite->fields($fields);
            }

            return $socialite->redirect();
        } catch(InvalidArgumentException $e) {
            $error = 'You cannot login with this service.';
        } catch(Exception $e) {
            $error = 'Something went wrong, please try again.';
        }
        return redirect()->back()->withMessage($error);
    }

    public function handleProviderCallback(UserRepository $userRepository, Sentinel $sentinel, $provider)
    {
        try{
            $response = socialite()->driver($provider)->user();

            $user = $userRepository->findOrCreateSocial($response, $provider);

            if($sentinel->loginAndRemember($user)) {
                return redirect()->route($this->redirectToRoute);
            }

        } catch(InvalidArgumentException $e) {
            $error = 'You cannot login with this service.';
        } catch(SignupDisabledException $e) {
            $error = 'You don\'t have an account yet and registering is disabled at the moment.';
        } catch(Exception $e) {
            $error = 'Something went wrong, please try again.';
        }

        return redirect()->back()->withMessage($error);

    }
}
