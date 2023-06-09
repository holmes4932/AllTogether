<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\BuyService;


/**
 * Class HomeController
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

    public function ownGroup(Request $request) {

        $user = Auth::user();

        if ($user) {
            $groups = $this->buyService->getOwnerGroups($user->id);
            return view('home.ownGroup', compact('groups'));
        }
        else {
            return view('home.index');
        }

    }

    public function searchGroup(Request $request) {

        $user = Auth::user();

        if ($user) {
            $groups = $this->buyService->getSearchGroups($user->id);
            return view('home.searchGroup', compact('groups'));
        }
        else {
            return view('home.index');
        }

    }

    public function orderList (Request $request, $groupId) {
        $user = Auth::user();
        if ($user) {
            $groupHasUser = $this->buyService->orderList($user->id, $groupId);
            if ($groupHasUser) {
                return view('home.orderList', compact('groupHasUser'));
            }
            else {
                return view('home.index');
            }
        }
        else {
            return view('home.index');
        }
    }


    public function editGroup(Request $request, $groupId = 0) {

        $user = Auth::user();

        if ($user) {
            if ($groupId) {
                // update current data
                $group = $this->buyService->getGroupInfo($user->id, $groupId);
                $group['submit'] = 'update';
                $group['form'] = '/group/updateOrCreate/'.$group['id'];
                return view('home.editGroup', compact('group'));
            }
            else {
                // create new data
                $group['submit'] = 'create';
                $group['form'] = '/group/updateOrCreate/';
                return view('home.editGroup', compact('group'));
            }
        }
        else {
            return view('home.index');
        }
    }

    public function updateOrCreateGroup(Request $request, $groupId = 0) {

        DB::beginTransaction();
        try {
            $user = Auth::user();
            $data = $request->all();

            if ($user) {
                $this->buyService->updateOrCreateGroup($user->id, $groupId, $data);

                $info = [
                    'redirectUrl' => '/group/own',
                    'message' => 'successful',
                ];
                DB::commit();
                return view('layouts.info-master', compact('info'));
            }
            else {
                DB::rollback();
                return view('home.index');
            }
        } catch (\Exception $e) {
            DB::rollback();
            $info = [
                'redirectUrl' => '/group/own',
                'message' => $e->getMessage(),
            ];
            return view('layouts.info-master', compact('info'));
		}
    }

    public function deleteGroup(Request $request, $groupId) {

        DB::beginTransaction();
        try {
            $user = Auth::user();
            if ($user) {
                if ($this->buyService->deleteGroup($user->id, $groupId) == 0) {
                    $info = [
                        'redirectUrl' => '/group/own',
                        'message' => 'successful',
                    ];
                    DB::commit();
                    return view('layouts.info-master', compact('info'));
                }
                else {
                    $info = [
                        'redirectUrl' => '/group/own',
                        'message' => 'error : not owner',
                    ];
                    DB::rollback();
                    return view('layouts.info-master', compact('info'));
                }
            }
            else {
                return view('home.index');
            }
        } catch (\Exception $e) {
            DB::rollback();
            $info = [
                'redirectUrl' => '/group/own',
                'message' => $e->getMessage(),
            ];
            return view('layouts.info-master', compact('info'));
		}
    }

    public function addInfo(Request $request, $groupId) {
        $user = Auth::user();

        if ($user) {
            $group = [
                'user_id' => $user->id,
                'form' => '/group/join/'.$groupId,
            ];
            return view('home.addInfo', compact('group'));
        }
        else {
            return view('home.index');
        }
    }

    public function joinGroup(Request $request, $groupId) {

        DB::beginTransaction();
        try {
            $user = Auth::user();
            $data = $request->all();

            if ($user) {
                if ($this->buyService->joinGroup($user->id, $groupId, $data) == 0){
                    $info = [
                        'redirectUrl' => '/group/search',
                        'message' => 'successful',
                    ];
                    DB::commit();
                    return view('layouts.info-master', compact('info'));
                }
                else {
                    $info = [
                        'redirectUrl' => '/group/search',
                        'message' => 'error: people overflow',
                    ];
                    DB::rollback();
                    return view('layouts.info-master', compact('info'));
                }
            }
            else {
                DB::rollback();
                return view('home.index');
            }
        } catch (\Exception $e) {
            DB::rollback();
            $info = [
                'redirectUrl' => '/group/search',
                'message' => $e->getMessage(),
            ];
            return view('layouts.info-master', compact('info'));
		}
    }

    public function quitGroup(Request $request, $groupId) {

        DB::beginTransaction();
        try {
            $user = Auth::user();
            if ($user) {

                $this->buyService->quitGroup($user->id, $groupId);

                $info = [
                    'redirectUrl' => '/',
                    'message' => 'successful',
                ];
                DB::commit();
                return view('layouts.info-master', compact('info'));
            }
            else {
                DB::rollback();
                return view('home.index');
            }
        } catch (\Exception $e) {
            DB::rollback();
            $info = [
                'redirectUrl' => '/',
                'message' => $e->getMessage(),
            ];
            return view('layouts.info-master', compact('info'));
		}
    }
}
