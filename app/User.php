<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getRole($params =[])
    {
       
        $users = self::select('users.*', 'r.name')
        ->leftJoin('role_users as ru', 'ru.user_id', 'users.id')
        ->leftJoin('roles as r', 'r.id' , 'ru.role_id');

        if(isset($params['name']) && $params['name'] !== '')
        {
            $users->where('users.last_name', 'like', '%'.$params['name'].'%')->get();
        }

         if(isset($params['role']) && $params['role'] !== '' && $params['role'] !== 'All')
        {
            $users->where('r.name', $params['role'])->get();
        }
          if(isset($params['id']) && $params['id'] !== '' && $params['id'] >0)
        {
            $users->where('users.id', $params['id'])->get();
        }

         if(isset($params['number']) && $params['number'] >0)
        {
           return $users->paginate($params['number']);
        }

        if(isset($params['number']) && $params['number'] == 0)
        {
           return $users->get();
        }

        return $users->paginate(1);
    }
}
