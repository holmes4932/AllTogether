<?php

namespace App\Repositories;

use Exception;
use App\Models\Users;


/**
 * Class UsersRepo
 *
 * @package App\Repositories\UsersRepo
 */
class UsersRepo
{
    protected $users;
    
    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    /**
     * @param  array  $data
     * @return mixed
     */
    public function add(array $data)
    {
        return Users::create($data);
    }

    /**
     * @param  array  $data
     * @return mixed
     */
    public function addByInsert(array $data)
    {
        return Users::insert($data);
    }

    /**
     * @param  $id
     * @param  array  $data
     * @return mixed
     */
    public function edit($token, array $data)
    {
        return Users::findOrFail($token)
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
        return Users::where($where)->update($data);
    }

    /**
     * @param  array  $ids
     * @param  array  $data
     * @return mixed
     */
    public function updateByIds(array $ids, array $data)
    {
        return Users::whereIn('id', $ids)->update($data);
    }

    /**
     * @param  array  $data
     * @return mixed
     */
    public function updateOrCreate(array $data)
    {
        return Users::updateOrCreate(
            [
                'access_token' => $data['access_token'],
            ],
            $data,
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($tokens)
    {
        return Users::findOrFail($tokens)
            ->delete();
    }

    /**
     * @param  array  $ids
     * @return mixed
     */
    public function deleteByTokenss(array $tokens)
    {
        return Users::whereIn('access_token', $tokens)->delete();
    }

    /**
     * 真刪除
     *
     * @param  array  $where
     * @return mixed
     */
    public function deleteByWhere(array $where)
    {
        return Users::where($where)->forceDelete();
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function get($token)
    {
        return Users::find($token);
    }

    /**
     * @param  array  $where
     * @param  array  $ids
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getByWhere(array $where, array $ids = [])
    {
        $users = Users::query();

        if (!empty($ids)) {
            $users->whereIn('id', $ids);
        }

        if (isset($where['with'])) {
            $users->with($where['with']);
        }

        if (isset($where['name'])) {
            $users->where('name', $where['name']);
        }

        if (isset($where['email'])) {
            $users->where('email', $where['email']);
        }

        if (isset($where['email_verified_at'])) {
            $users->where('email_verified_at', $where['email_verified_at']);
        }

        if (isset($where['remember_token'])) {
            $users->where('remember_token', $where['remember_token']);
        }

        if (!isset($where['sort'])) {
            $where['sort'] = 'id';
        }

        if (isset($where['order']) && $where['order'] == 'desc') {
            $where['order'] = 'desc';
        } else {
            $where['order'] = 'asc';
        }

        $users->orderByRaw($where['sort'].' '.$where['order']);

        if (isset($where['page']) || isset($where['limit'])) {
            if (!isset($where['page']) || $where['page'] < 0) {
                $where['page'] = 1;
            }
            if (!isset($where['limit']) || $where['limit'] < 1) {
                $where['limit'] = 25;
            }

            return $users->paginate($where['limit'], ['*'], 'page', $where['page']);
        }

        return $users->get();
    }

    /**
     * @param  array  $where
     * @return int
     */
    public function getTotal(array $where)
    {
        $users = Users::query();

        if (isset($where['name'])) {
            $users->where('name', $where['name']);
        }

        if (isset($where['email'])) {
            $users->where('email', $where['email']);
        }

        if (isset($where['email_verified_at'])) {
            $users->where('email_verified_at', $where['email_verified_at']);
        }

        if (isset($where['remember_token'])) {
            $users->where('remember_token', $where['remember_token']);
        }

        return $users->count();
    }


}