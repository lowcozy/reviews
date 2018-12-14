<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Sentinel;
use App\Http\Requests\Admin\EditUser;

class UserController extends Controller
{
    public function index(Request $request)
    {   

        $users = User::getRole();
        return view('Admin.user.list', ['users' => $users]);
    }

    public function add()
    {
        return view ('Admin.user.add');
    }


    public function search(Request $request)
    {   
         $name = '';
         
         if(isset($_GET['name']))  
         {

            $users = User::getRole($params=['name' => $_GET['name'], 
                'role'=> $_GET['role'],
                'number' => $_GET['number']
            ]);
            $name = $_GET['name'];
         }
         else

         $users = User::getRole(
            $params = [
                 'role'=> $_GET['role'],
                'number' => $_GET['number']
            ]
         );
         return view('Admin.user.search', ['users' => $users, 'name' => $name]);
    }

    public function edit($id)
    {   
        $user = User::getRole($params = ['id' => $id])->first();
        if($user)
        {
            return view('Admin.user.edit', ['user' => $user]);
        }
        else
        {
            return abort(404);
        }
    }

    public function update($id, EditUser $request)
    {
        $role_old = User::getRole($params = ['id'=> $id])->first()->name;
        $role_new = $request->selectRole;
        $user = Sentinel::findById($id);

        $role = Sentinel::findRoleByName($role_old);
        $role->users()->detach($user);
        $role = Sentinel::findRoleByName($role_new);
        $role->users()->attach($user);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->save();
        return redirect()->route('admin.user.list')->with('update', 'Cập nhật thành công!');
    }

    public function delete(Request $request)
    {   
        $role_old = User::getRole($params = ['id'=> $request->idUser])->first()->name;
        $user = Sentinel::findById($request->idUser);  
        $role = Sentinel::findRoleByName($role_old);
        $role->users()->detach($user);
        $user->delete();
        return redirect()->route('admin.user.list')->with('delete', 'Xóa thành công!');

    }
}
