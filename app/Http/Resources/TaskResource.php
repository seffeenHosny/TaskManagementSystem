<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'title'=>$this->title,
            'description'=>$this->description,
            'due_date'=>$this->due_date,
            'status'=>$this->status,
            'priority'=>$this->priority,
            'user_id'=>$this->user_id,
            'created_at'=>$this->created_at
        ];

        if($this->relationLoaded('user')){
            $arr['user'] = new UserResource($this->user);
        }

        return $arr;
    }
}
