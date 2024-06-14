<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Account;
use Modules\School\Entities\School;


class InternalController extends ApiController
{
    public function account()
    {
        $accounts = Account::all();
        return $this->success('Thành công', $accounts);
    }
    public function category()
    {
        $categories = Category::all();
        return $this->success('Thành công', $categories);
    }
    public function updateRole($id, Request $request)
    {
        Role::where('user_id', $id)->delete();
        foreach ($request->roles as $role) {
            Role::create([
                'user_id' => $id,
                'category_id' => $role['category_id'],
                'view' => $role['view'],
                'add' => $role['add'],
                'edit' => $role['edit'],
                'delete' => $role['delete'],
            ]);
        }
        return $this->success('Thành công', $id);
    }
}
