<?php

namespace Snijenhuis\Modules\Auth\Repositories;


use Cartalyst\Sentinel\Activations\EloquentActivation;
use Cartalyst\Sentinel\Activations\IlluminateActivationRepository;
use Snijenhuis\Modules\Auth\Exceptions\SignupDisabledException;
use Snijenhuis\Modules\Auth\Events\ActivateUserEvent;
use Snijenhuis\Modules\Auth\Models\User;
use Bosnadev\Repositories\Eloquent\Repository;

class UserRepository extends Repository {

    protected $sentinel;

    /**
     * UserRepository constructor.
     */
    public function __construct(){
        parent::__construct();
        $this->sentinel = sentinel();
    }

    public function model()
    {
        return User::class;
    }

    public function getUser()
    {
        return $this->sentinel->getUser();
    }

    /**
     * Register a new user
     * 
     * @param $data
     */
    public function register($data)
    {
        $user = $this->sentinel->register([
            'email' => $data['email'],
            'password' => $data['password'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
        ]);

        if($user) {
            event(new ActivateUserEvent($user));
            return collect(['registered' => true, 'message' => 'Please check your email to complete your account registration.']);
        }
        return collect(['registered' => false, 'error' => 'Something went wrong, please try again.']);
        
        
    }

    /**
     * Activate a user
     *
     * @param String $code Activation code
     */
    public function activate($code)
    {
        $activationRepository = new IlluminateActivationRepository();
        $activation = new EloquentActivation();
        $activation = $activation->where('code', $code)->first();

        if (!$activation)
        {
            return collect(['activated' => false, 'error' => 'The activation link is invalid.']);
        }

        $user = $this->sentinel->find($activation->user_id);

        if(! $user)
        {
            return collect(['activated' => false, 'error' => 'User not found.']);
        }

        if (!$activationRepository->complete($user, $code))
        {
            if ($activationRepository->completed($user))
            {
                return collect(['activated' => false, 'error' => 'User is already activated. Try to log in.']);
            }
            return collect(['activated' => false, 'error' => 'There was an error, please try again or contact the webmaster.']);
        }
        return collect(['activated' => true, 'message' => 'Your account has been activated. Log in to your account.']);
    }

    /**
     * Find a user based on his email or create one and link him to a provider.
     *
     * @param $response
     * @param $provider
     * @return \Cartalyst\Sentinel\Users\UserInteface
     */
    public function findOrCreateSocial($response, $provider)
    {
        $user = $this->findBy('email', $response->getEmail());


        if(is_null($user)) {
            if(! config('snijenhuis.auth.register.enabled')) {
                throw new SignupDisabledException;
            }
            
            $user = $this->sentinel->registerAndActivate([
                'email' => $response->getEmail(),
                'password' => bcrypt($response->getId()),
                'nickname' => $response->getNickname(),
                'avatar' => $response->getAvatar()
            ]);

        }

        $user->providers()->updateOrCreate(['user_id' => $user->id], [
                'provider' => $provider,
                'provider_user_id' => $response->getId(),
                'token' => $response->token,
        ]);

        return $user;
    }


}