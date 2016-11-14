<?php

namespace Snijenhuis\Modules\Admin\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Caffeinated\Modules\Facades\Module;
use Illuminate\Http\Request;

class PageController extends Controller
{

    /**
     * Displays the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('admin::pages.dashboard');
    }

}
