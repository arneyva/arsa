<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'is_completed' => $this->is_completed,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at ?? null,
        ];
    }
    public static function paginate(LengthAwarePaginator $paginate)
    {
        return [
            'list' => self::collection($paginate->getCollection()),
            'limit' => $paginate->perPage(),
            'page' => $paginate->currentPage(),
            'total' => $paginate->total(),
        ];
    }
}
