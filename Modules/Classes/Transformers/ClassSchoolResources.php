<?php

namespace Modules\Classes\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\School\Transformers\SchoolResources;

class ClassSchoolResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'school' => new SchoolResources($this->classSchool),
        ];
    }
}
