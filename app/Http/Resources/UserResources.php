<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'account' => new AccountResources($this->account),
            'authenticate' => $this->authenticate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
