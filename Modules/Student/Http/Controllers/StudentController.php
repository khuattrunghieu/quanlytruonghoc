<?php

namespace Modules\Student\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use App\Models\Role;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Modules\Student\Http\Requests\StudentStoreRequest;
use Modules\Student\Http\Requests\StudentUpdateRequest;

class StudentController extends ApiController
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
    public function index(Request $request)
    {
        $students = $this->user->where('account_id', 2)->orderBy('id', 'desc')->get();
        return $this->success('Thành công', $students);
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
    public function store(studentStoreRequest $request)
    {
        $data_student = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'account_id' => 2,
            'password' => Hash::make($request->password)
        ];
        $user = $this->user->create($data_student);
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
        $student = $this->user->find($id);
        if ($student) {
            return $this->success('Thành công', $student);
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
    public function update(studentUpdateRequest $request, $id)
    {
        $student = $this->user->find($id);
        $data_student = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'account_id' => $request->account
        ];
        if ($request->has('password')) {
            $data_student['password'] = Hash::make($request->password);
        }
        $student->update($data_student);
        return $this->success('Thành công', $student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = $this->user->find($id);
        if ($student) {
            $student->delete();
            return $this->success('Thành công', null);
        }
        return $this->show_error('Không tồn tại');        
    }
    public function search(Request $request)
    {
        $students = $this->user->where('account_id', 2)->orderBy('id', 'desc');
        if ($request->has('search') && $search = $request->search) {
            $students = $students->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orWhere('birthday', 'like', '%' . $search . '%');
        }
        $students = $students->get();
        return $this->success('Thành công', $students);
    }
}
