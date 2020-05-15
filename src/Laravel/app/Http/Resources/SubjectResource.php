<?php

namespace App\Http\Resources;

use App\Category;
use App\ContentAccess;
use Illuminate\Http\Resources\Json\JsonResource;
use PHPUnit\Framework\Constraint\IsEmpty;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $category = Category::find($this->category);
        if(isset($category)) $category->first();

        $content_access = ContentAccess::find($this->access);
        if(isset($content_access)) $content_access->first();

        // return parent::toArray($request);

        $result = [
            'id' => $this->id ? (string)$this->id : '',
            'name' => $this->name ? (string)$this->name : '',
            'label' => $this->label ? (string)$this->label : '',
            'description' => $this->description ? (string)$this->description : '',
            'rating' => $this->rating ? $this->rating : '',
            'category' => $category->name ? (string)$category->label : null,
            'access' => isset($content_access->name) ? $content_access->label : null,
            'rating' => (string)$this->rating,
            'tags' => $this->tags ? $this->getTags($this->tags) : null,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
        ] ;


        if(isset($result['tags']) && !count($result['tags'])) {
            unset($result['tags']);
        }
        return $result;
    }

    private function getTags($tags){
        $result = [];
        if(isset($tags)){
            foreach ($tags as $key => $tag) {
                array_push($result, $tag->label);
            }
            return $result;
        }
        return $result;
    }
}
