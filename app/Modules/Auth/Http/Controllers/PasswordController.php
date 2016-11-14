<?php

namespace Snijenhuis\Modules\Auth\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Snijenhuis\Modules\Auth\Events\ResetPasswordEvent;
use Snijenhuis\Modules\Auth\Http\Requests\CreatePasswordRequest;
use Snijenhuis\Modules\Auth\Http\Requests\ResetPasswordRequest;
use Snijenhuis\Modules\Auth\Repositories\UserRepository;

class PasswordController extends Controller
{
    protected $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getReset()
    {
        return view('auth::pages.password_reset');
    }

    public function postReset(ResetPasswordRequest $request)
    {
        $user = $this->userRepository->findBy('email', $request->get('email'));

        // We don't give an error if the user is non-existent because this could help
        // someone in the process of hacking somebody
        if ($user) {
            ($reminder = reminder()->exists($user)) || ($reminder = reminder()->create($user));

            event(new ResetPasswordEvent($user, $reminder));
        }

        return redirect()->route('auth.password.reset.get')->withMessage("An email has beent sent to you.");
    }

    /**
     * @param String $code
     * @param $id
     * @return mixed
     */
    public function getCreate($code, $id)
    {
        $user = $this->userRepository->find($id);
        
        if (reminder()->exists($user, $code)) {
            return view('auth::pages.password_create', compact('id', 'code'));
        }

        // TODO: set these strings in a translation file
        return redirect()->route('aut.password.reset.get')->withMessage('This link was invalid.');
    }

    /**
     * @param CreatePasswordRequest $request
     * @param String $code
     * @param $id
     * @return
     */
    public function postCreate(CreatePasswordRequest $request, $code, $id)
    {
        $password = $request->get('password');

        $user = $this->userRepository->find($id);
        $reminder = reminder()->exists($user, $code);

        if (! $reminder) {
            return redirect()->route('aut.password.reset.get')->withMessage('This link was invalid.');
        }

        reminder()->complete($user, $code, $password);
        return redirect()->route('auth.login.get')->withMessage('Succesfully changed your password.');
    }
}
