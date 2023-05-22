<?php 

namespace App\Services;

use Carbon\Carbon;
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

			return [
                'id' => $value->groups['id'],
                'name' => $value->groups['name'],
                'owner_user_name' => $ownerUser['name'],
                'max_people' => $value->groups['max_people'],
                'min_people' => $value->groups['min_people'],
                'current_people' => $value->groups['current_people'],
                'deadline' => $value->groups['deadline'],
                'deleted_at' => $value->groups['deleted_at'],
                'created_at' => $value->groups['created_at'],
                'updated_at' => $value->groups['updated_at'],
            ];
		})->filter(function ($value, $key) {
            return $value['deleted_at'] == null;
        });

		return $groups;
	}

	public function getOwnerGroups($userId){

		$groups = $this->groupsRepo->getByWhere([
            'with' => ['ownerUsers'],
            'owner_user_id' => $userId,
            'deleted_at = null' => 1,
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
			'ids <>' => $userHasGroups,
            'deleted_at = null' => 1,
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

    public function updateOrCreateGroup ($userId, $groupId, $data) {

        $data['owner_user_id'] = $userId;

        $this->groupsRepo->updateOrCreate($data);

		return;
	}

    public function deleteGroup ($userId, $groupId) {

        $group = $this->groupsRepo->get($groupId);

        if ($group['owner_user_id'] ==  $userId) {
            
            $data = [
                'id' => $groupId,
                'deleted_at' => Carbon::now(),
            ];

            $this->groupsRepo->updateOrCreate($data);
            return 0;
        }
        else {
            return -1;
        }
	}

    public function joinGroup($userId, $groupId, $data) {

        $data['user_id'] = $userId;
        $data['group_id'] = $groupId;

        $this->userHasGroupRepo->updateOrCreate($data);

        $group = $this->groupsRepo->get($groupId);
        if ($group['current_people'] + $data['people'] > $group['max_people']) return -1;

        $new_group = [
            'id' => $groupId,
            'current_people' => $group['current_people'] + $data['people'],
        ];
        $this->groupsRepo->updateOrCreate($new_group);

        return 0;

    }

}

?>
