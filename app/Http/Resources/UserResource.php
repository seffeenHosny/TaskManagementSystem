<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $arr = [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'role' => $this->getRoleNames()[0] ?? '',
            'permissions'=>PermissionResource::collection($this->getAllPermissions()),
            'created_at'=>$this->created_at
        ];

        if($this->relationLoaded('tasks')){
            $arr['tasks'] = TaskResource::collection($this->tasks);
        }

        return $arr;
    }
}
