<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Todo extends JsonResource
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
           'todo' => $this->todo_name,
           'description' => $this->todo_description,
           'date' => $this->todo_date,
           'time' => $this->todo_time,
           'status' => $this->is_already_todo,
           'created_date' => (string)$this->created_at->format('m/d/Y')
       ];
    }
}
