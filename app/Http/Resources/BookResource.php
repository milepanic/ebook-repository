<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'title' => $this->title,
            'author' => $this->author,
            'keywords' => $this->keywords,
            'publication_year' => (string) $this->publication_year,
            'filename' => $this->filename,
            'mime' => $this->mime,
            'created_at' => (string) $this->created_at,
            'category' => $this->category,
        ];
    }
}
