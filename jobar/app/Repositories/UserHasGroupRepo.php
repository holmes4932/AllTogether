<?php

namespace App\Repositories;

use Exception;
use App\Models\UserHasGroup;


/**
 * Class UserHasGroupRepo
 *
 * @package App\Repositories\UserHasGroupRepo
 */
class UserHasGroupRepo
{
    protected $userHasGroup;
    
    public function __construct(UserHasGroup $userHasGroup)
    {
        $this->userHasGroup = $userHasGroup;
    }

    /**
     * @param  array  $data
     * @return mixed
     */
    public function add(array $data)
    {
        return UserHasGroup::create($data);
    }

    /**
     * @param  array  $data
     * @return mixed
     */
    public function addByInsert(array $data)
    {
        return UserHasGroup::insert($data);
    }

    /**
     * @param  $id
     * @param  array  $data
     * @return mixed
     */
    public function edit($id, array $data)
    {
        return UserHasGroup::findOrFail($id)
            ->fill($data)
            ->save();
    }

    /**
     * @param  array  $where
     * @param  array  $data
     * @return mixed
     */
    public function updateByWhere(array $where, array $data)
    {
        return UserHasGroup::where($where)->update($data);
    }

    /**
     * @param  array  $ids
     * @param  array  $data
     * @return mixed
     */
    public function updateByIds(array $ids, array $data)
    {
        return UserHasGroup::whereIn('id', $ids)->update($data);
    }

    /**
     * @param  array  $data
     * @return mixed
     */
    public function updateOrCreate(array $data)
    {
        return UserHasGroup::updateOrCreate(
            [
                'id' => $data['id'],
            ],
            $data
        );
    }

    /**
     * @param  array  $data
     * @param  array  $where
     * @return mixed
     */
    public function updateOrCreateByWhere(array $data, array $where)
    {
        return UserHasGroup::updateOrCreate($where, $data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return UserHasGroup::findOrFail($id)
            ->delete();
    }

    /**
     * @param  array  $ids
     * @return mixed
     */
    public function deleteByIds(array $ids)
    {
        return UserHasGroup::whereIn('id', $ids)->delete();
    }

    /**
     * 真刪除
     *
     * @param  array  $where
     * @return mixed
     */
    public function deleteByWhere(array $where)
    {
        return UserHasGroup::where($where)->forceDelete();
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function get($id)
    {
        return UserHasGroup::find($id);
    }

    /**
     * @param  array  $where
     * @param  array  $ids
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getByWhere(array $where, array $ids = [])
    {
        $userHasGroup = UserHasGroup::query();

        if (!empty($ids)) {
            $userHasGroup->whereIn('id', $ids);
        }

        if (isset($where['with'])) {
            $userHasGroup->with($where['with']);
        }

        if (isset($where['user_id'])) {
            $userHasGroup->where('user_id', $where['user_id']);
        }

        if (isset($where['group_id'])) {
            $userHasGroup->where('group_id', $where['group_id']);
        }

        if (!isset($where['sort'])) {
            $where['sort'] = 'id';
        }

        if (isset($where['order']) && $where['order'] == 'desc') {
            $where['order'] = 'desc';
        } else {
            $where['order'] = 'asc';
        }

        $userHasGroup->orderByRaw($where['sort'].' '.$where['order']);

        if (isset($where['page']) || isset($where['limit'])) {
            if (!isset($where['page']) || $where['page'] < 0) {
                $where['page'] = 1;
            }
            if (!isset($where['limit']) || $where['limit'] < 1) {
                $where['limit'] = 25;
            }

            return $userHasGroup->paginate($where['limit'], ['*'], 'page', $where['page']);
        }

        return $userHasGroup->get();
    }

    /**
     * @param  array  $where
     * @return int
     */
    public function getTotal(array $where)
    {
        $userHasGroup = UserHasGroup::query();

        if (isset($where['user_id'])) {
            $userHasGroup->where('user_id', $where['user_id']);
        }

        if (isset($where['group_id'])) {
            $userHasGroup->where('group_id', $where['group_id']);
        }

        return $userHasGroup->count();
    }


}