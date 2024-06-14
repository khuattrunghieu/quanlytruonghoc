<?php

namespace Modules\School\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Modules\School\Entities\School;
use Modules\School\Http\Requests\SchoolUpdateRequest;
use Modules\School\Http\Requests\SchoolStoreRequest;
use App\User;

class SchoolController extends ApiController
{
    public $school;

    public $user;
    public function __construct(School $school, User $user)
    {
        $this->school = $school;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $schools = $this->school->orderBy('id', 'desc')->get();
        return $this->success('Thành công', $schools);
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
    public function store(SchoolStoreRequest $request)
    {
        $school = $this->school->create([
            'name' => $request->name,
            'address' => $request->address,
        ]);
        return $this->success('Thành công', $school);
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
        $school = $this->school->find($id);
        if ($school) {
            return $this->success('Thành công', $school);
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
    public function update(SchoolUpdateRequest $request, $id)
    {
        $school = $this->school->find($id);
        if ($school) {
            $school->update([
                'name' => $request->name,
                'address' => $request->address,
            ]);
            return $this->success('Thành công', $school);
        }
        return $this->show_error('Không tồn tại');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = $this->school->find($id);
        if ($school) {
            $school->delete();
            return $this->success('Thành công', null);
        }
        return $this->show_error('Không tồn tại');        
    }
    public function search(Request $request)
    {
        $schools = $this->school->orderBy('id', 'desc');
        if ($request->has('search') && $search = $request->search) {
            $schools = $schools->where('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%');
        }
        $schools = $schools->get();
        return $this->success('Thành công', $schools);
    }
}

