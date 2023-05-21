<?php 

namespace App\Services;

use App\Repositories\UsersRepo;
use App\Repositories\GroupsRepo;
use App\Repositories\UserHasGroupRepo;

class BuyService 
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
            'with' => ['groups'],
            'user_id' => $userId,
        ]);

		$groups->transform(function ($value){
			$ownerUser = $this->usersRepo->get($value->groups['owner_user_id']);
			$value->groups['owner_user_name'] = $ownerUser['name'];
			return $value->groups;
		});

		return $groups;
	}

	public function getOwnerGroups($userId){

		$groups = $this->groupsRepo->getByWhere([
            'with' => ['ownerUsers'],
            'owner_user_id' => $userId,
        ]);

		$groups->transform(function ($value){
			$value['owner_user_name'] = $value->ownerUsers['name'];
			return $value;
		});

		return $groups;
	}

	public function getSearchGroups($userId){

		$userHasGroups = $this->userHasGroupRepo->getByWhere([
            'user_id' => $userId,
        ])->pluck('group_id');
		
		$groups = $this->groupsRepo->getByWhere([
            'with' => ['ownerUsers'],
            'owner_user_id <>' => $userId,
			'ids <>' => $userHasGroups
        ]);

		$groups->transform(function ($value){
			$value['owner_user_name'] = $value->ownerUsers['name'];
			return $value;
		});

		return $groups;
	}

	public function getGroupInfo ($userId, $groupId) {

		$group = $this->groupsRepo->getByWhere([
			'with' => ['ownerUsers']], 
			[$groupId]
		)->first();

		if ($group['owner_user_id'] != $userId) return NULL;

		$group['owner_user_name'] = $group->ownerUsers['name'];

		return $group;
	}

}

?>
