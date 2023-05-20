<?php 

namespace App\Services;

use App\Repositories\UsersRepo;
use App\Repositories\GroupsRepo;
use App\Repositories\UserHasGroupRepo;

class MqttService 
{
	/**
     * @var UsersRepo
     */
    private $usersRepo;

	/**
     * @var GroupsRepo
     */
    private $groupsRepo;

	/**
     * @var UserHasGroupRepo
     */
    private $userHasGroupRepo;


    public function __construct(
		UsersRepo $usersRepo,
		GroupsRepo $groupsRepo,
		UserHasGroupRepo $userHasGroupRepo
	) 
	{
		$this->usersRepo = $usersRepo;
		$this->groupsRepo = $groupsRepo;
		$this->userHasGroupRepo = $userHasGroupRepo;
	}


    public function getGroups($userId){

		$groups = $this->userHasGroupRepo->getByWhere([
            'with' => 'groups',
            'user_id' => $userId,
        ]);

		return $groups;
	}

}



?>
