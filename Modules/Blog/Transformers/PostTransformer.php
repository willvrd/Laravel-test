<?php

namespace Modules\Blog\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class PostTransformer extends JsonResource
{
    public function toArray($request)
    {

        $item = [
            'id' => $this->when($this->id, $this->id),
            'options' => $this->when($this->options, $this->options),
            'createdAt' => $this->when($this->created_at, $this->created_at),
            'updatedAt' => $this->when($this->updated_at, $this->updated_at)
        ];

        return $item;

    }
}
