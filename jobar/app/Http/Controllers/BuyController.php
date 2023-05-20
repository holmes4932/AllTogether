<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\BuyService;

/**
 * Class BuyController
 *
 * @package App\Http\Controllers
 */
class BuyController extends Controller {
    /**
     * @var BuyService
     */
    protected $buyService;

    public function __construct(
		BuyService $buyService
	){
		parent::__construct();

		$this->buyService = $buyService;
	}

    public function groupList(Request $request) {

    }

}
?>