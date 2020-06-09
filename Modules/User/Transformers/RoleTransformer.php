<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleTransformer extends JsonResource
{
    public function toArray($request)
    {
        $item = [
            'id' => $this->when($this->id, $this->id),
            'name' => $this->when($this->name, $this->name),
            'guardName' => $this->when($this->guardName, $this->guardName),
            'permissions' => PermissionTransformer::collection($this->whenLoaded('permissions')),
            'users' => UserTransformer::collection($this->whenLoaded('users')),
            'createdAt' => $this->when($this->created_at, $this->created_at),
            'updatedAt' => $this->when($this->updated_at, $this->updated_at)
        ];

        return $item;

    }
}
