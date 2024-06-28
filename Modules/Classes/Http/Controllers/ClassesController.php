<?php

namespace Modules\Classes\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Modules\Classes\Entities\Classes;
use Modules\Classes\Http\Requests\ClassStoreRequest;
use Modules\Classes\Http\Requests\ClassUpdateRequest;
use Modules\Classes\Transformers\ClassSchoolResourceCollection;
use Modules\Classes\Transformers\ClassSchoolResources;

class ClassesController extends ApiController
{
    public $class;
    public function __construct(Classes $class)
    {
        $this->class = $class;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classes = $this->class->orderBy('id', 'desc');
        if ($request->has('search') && $search = $request->search) {
            $classes = $classes->where('name', 'like', '%' . $search . '%');
        }
        $classesResources = new ClassSchoolResourceCollection($classes->paginate(10));

        return $this->success('Thành công', $classesResources);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassStoreRequest $request)
    {
        $class = $this->class->create([
            'name' => $request->name,
            'school_id' => $request->school,
        ]);
        return $this->success('Thành công', $class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $class = $this->class->find($id);
        if ($class) {
            $classResources = new ClassSchoolResources($class);
            return $this->success('Thành công', $classResources);
        }
        return $this->show_error('Không tồn tại');        
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassUpdateRequest $request, $id)
    {
        $class = $this->class->find($id);
        if ($class) {
            $class->update([
                'name' => $request->name,
                'school_id' => $request->school,

            ]);
            return $this->success('Thành công', $class);
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
        $class = $this->class->find($id);
        if ($class) {
            $class->delete();
            return $this->success('Thành công', null);
        }
        return $this->show_error('Không tồn tại');        
    }
}