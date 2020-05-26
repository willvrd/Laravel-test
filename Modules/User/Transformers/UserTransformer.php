<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTransformer extends JsonResource
{
    public function toArray($request)
    {
        $item = [
            'id' => $this->when($this->id, $this->id),
            'name' => $this->when($this->name, $this->name),
            'email' => $this->when($this->email, $this->email),
            'emailVerifiedAt' => $this->when($this->email_verified_at, $this->email_verified_at),
            'roles' => RoleTransformer::collection($this->whenLoaded('roles')),
            'createdAt' => $this->when($this->created_at, $this->created_at),
            'updatedAt' => $this->when($this->updated_at, $this->updated_at)
        ];

        return $item;

    }
}
