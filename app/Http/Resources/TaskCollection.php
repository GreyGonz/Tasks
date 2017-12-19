<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($page) {
                return [
                    'id' => $page->id,
                    'name' => $page->name,
                    'description' => $page->description,
                    'completed' => $page->completed == 0 ? false : true,
                    'user_id' => (integer)$page->user_id,
                    'created_at' => $page->created_at->toDateTimeString(),
                    'updated_at' => $page->updated_at->toDateTimeString(),
                ];
            }),
        ];
    }
}
