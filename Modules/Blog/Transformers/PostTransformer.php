<?php

namespace Modules\Blog\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Transformers\UserTransformer;

class PostTransformer extends JsonResource
{
    public function toArray($request)
    {

        $item = [
            'id' => $this->when($this->id, $this->id),
            'user_id' => $this->when($this->user_id, $this->user_id),
            'user' => new UserTransformer($this->whenLoaded('user')),
            'options' => $this->when($this->options, $this->options),
            'createdAt' => $this->when($this->created_at, $this->created_at),
            'updatedAt' => $this->when($this->updated_at, $this->updated_at)
        ];

        return $item;

    }
}
