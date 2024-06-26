<?php

namespace Modules\Teacher\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Http\Resources\UserResources;
use App\Models\Category;
use App\Models\Role;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Modules\Teacher\Http\Requests\TeacherStoreRequest;
use Modules\Teacher\Http\Requests\TeacherUpdateRequest;

class TeacherController extends ApiController
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = UserResources::collection($this->user->where('account_id', 1)->orderBy('id', 'desc')->get());
        return $this->success('Thành công', $teachers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherStoreRequest $request)
    {
        $data_teacher = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'account_id' => 1,
            'password' => Hash::make($request->password)
        ];
        $user = $this->user->create($data_teacher);
        $categories = Category::all();
        foreach ($categories as $category) {
            Role::create([
                'user_id' => $user->id,
                'category_id' => $category->id,
            ]);
        }
        return $this->success('Thành công', $user);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = $this->user->find($id);
        if ($teacher) {
            $teacherResources = new UserResources($teacher);
            return $this->success('Thành công', $teacherResources);
        }
        return $this->show_error('Không tồn tại');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherUpdateRequest $request, $id)
    {
        $teacher = $this->user->find($id);
        $data_teacher = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'account_id' => $request->account
        ];
        if ($request->has('password')) {
            $data_teacher['password'] = Hash::make($request->password);
        }
        $teacher->update($data_teacher);
        return $this->success('Thành công', $teacher);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = $this->user->find($id);
        if ($teacher) {
            $teacher->delete();
            return $this->success('Thành công', null);
        } 
        return $this->show_error('Không tồn tại');
    }
    public function search(Request $request)
    {
        $teachers = $this->user->where('account_id', 1)->orderBy('id', 'desc');
        if ($request->has('search') && $search = $request->search) {
            $teachers = $teachers->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orWhere('birthday', 'like', '%' . $search . '%');
        }
        $teachersResources = UserResources::collection($teachers->get());
        return $this->success('Thành công', $teachersResources);
    }
}
