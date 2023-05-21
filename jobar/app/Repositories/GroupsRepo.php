<?php

namespace App\Repositories;

use Exception;
use App\Models\Groups;


/**
 * Class GroupsRepo
 *
 * @package App\Repositories\GroupsRepo
 */
class GroupsRepo
{
    protected $groups;
    
    public function __construct(Groups $groups)
    {
        $this->groups = $groups;
    }

    /**
     * @param  array  $data
     * @return mixed
     */
    public function add(array $data)
    {
        return Groups::create($data);
    }

    /**
     * @param  array  $data
     * @return mixed
     */
    public function addByInsert(array $data)
    {
        return Groups::insert($data);
    }

    /**
     * @param  $id
     * @param  array  $data
     * @return mixed
     */
    public function edit($id, array $data)
    {
        return Groups::findOrFail($id)
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
        return Groups::where($where)->update($data);
    }

    /**
     * @param  array  $ids
     * @param  array  $data
     * @return mixed
     */
    public function updateByIds(array $ids, array $data)
    {
        return Groups::whereIn('id', $ids)->update($data);
    }

    /**
     * @param  array  $data
     * @return mixed
     */
    public function updateOrCreate(array $data)
    {
        return Groups::updateOrCreate(
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
        return Groups::updateOrCreate($where, $data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return Groups::findOrFail($id)
            ->delete();
    }

    /**
     * @param  array  $ids
     * @return mixed
     */
    public function deleteByIds(array $ids)
    {
        return Groups::whereIn('id', $ids)->delete();
    }

    /**
     * 真刪除
     *
     * @param  array  $where
     * @return mixed
     */
    public function deleteByWhere(array $where)
    {
        return Groups::where($where)->forceDelete();
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function get($id)
    {
        return Groups::find($id);
    }

    /**
     * @param  array  $where
     * @param  array  $ids
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getByWhere(array $where, array $ids = [])
    {
        $groups = Groups::query();

        if (!empty($ids)) {
            $groups->whereIn('id', $ids);
        }

        if (isset($where['with'])) {
            $groups->with($where['with']);
        }

        if (isset($where['name'])) {
            $groups->where('name', $where['name']);
        }

        if (isset($where['owner_user_id'])) {
            $groups->where('owner_user_id', $where['owner_user_id']);
        }

        if (isset($where['max_people'])) {
            $groups->where('max_people', $where['max_people']);
        }

        if (isset($where['min_people'])) {
            $groups->where('min_people', $where['min_people']);
        }

        if (isset($where['current_people'])) {
            $groups->where('current_people', $where['current_people']);
        }

        if (isset($where['deadline'])) {
            $groups->where('deadline', $where['deadline']);
        }

        if (isset($where['deleted_at'])) {
            $groups->where('deleted_at', $where['deleted_at']);
        }

        if (!isset($where['sort'])) {
            $where['sort'] = 'id';
        }

        if (isset($where['order']) && $where['order'] == 'desc') {
            $where['order'] = 'desc';
        } else {
            $where['order'] = 'asc';
        }

        $groups->orderByRaw($where['sort'].' '.$where['order']);

        if (isset($where['page']) || isset($where['limit'])) {
            if (!isset($where['page']) || $where['page'] < 0) {
                $where['page'] = 1;
            }
            if (!isset($where['limit']) || $where['limit'] < 1) {
                $where['limit'] = 25;
            }

            return $groups->paginate($where['limit'], ['*'], 'page', $where['page']);
        }

        return $groups->get();
    }

    /**
     * @param  array  $where
     * @return int
     */
    public function getTotal(array $where)
    {
        $groups = Groups::query();

        if (isset($where['name'])) {
            $groups->where('name', $where['name']);
        }

        if (isset($where['owner_user_id'])) {
            $groups->where('owner_user_id', $where['owner_user_id']);
        }

        if (isset($where['max_people'])) {
            $groups->where('max_people', $where['max_people']);
        }

        if (isset($where['min_people'])) {
            $groups->where('min_people', $where['min_people']);
        }

        if (isset($where['current_people'])) {
            $groups->where('current_people', $where['current_people']);
        }

        if (isset($where['deadline'])) {
            $groups->where('deadline', $where['deadline']);
        }

        if (isset($where['deleted_at'])) {
            $groups->where('deleted_at', $where['deleted_at']);
        }

        return $groups->count();
    }


}