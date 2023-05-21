<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\BuyService;


/**
 * Class BuyController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller {
    /**
     * @var BuyService
     */
    protected $buyService;


    public function __construct(BuyService $buyService) {
		$this->buyService = $buyService;
	}


    public function index(Request $request) {

        $user = Auth::user();

        if ($user) {
            $groups = $this->buyService->getGroups($user->id);
            return view('home.index', compact('groups'));
        }
        else {
            return view('home.index');
        }

    }
}
