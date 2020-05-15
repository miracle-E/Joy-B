<?php

namespace App\Http\Resources;

use App\Category;
use App\ContentAccess;
use App\ContentType;
use App\Media;
use App\Topic;
use App\Subject;
use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $media = Media::find($this->media);
        if(isset($media)) $media->first();

        $category = Category::find($this->category);
        if(isset($category)) $category->first();

        $subject = Subject::find($this->subject_id);
        if(isset($subject)) $subject->first();

        $content_type = ContentType::find($this->content_type);
        if(isset($content_type)) $content_type->first();

        $content_access = ContentAccess::find($this->content_access);
        if(isset($content_access)) $content_access->first();

        $empty = array();
        $result = [
            'id' => $this->id ? (string)$this->id : '',
            'title' => $this->title ? (string)$this->title : '',
            'body' => $this->body ? (string)$this->body : '',
            'description' => $this->description ? (string)$this->description : '',
            'is_published' => $this->is_published ? (string)$this->is_published : '',
            'published_date' => (string)$this->published_date,
            'category' => $category->name ? (string)$category->label : null,
            'content_type' => isset($content_type->name) ? (string)$content_type->label : null,
            'content_access' => isset($content_access->name) ? (string)$content_access->label : null,
            'rating' => (string)$this->rating,
            'slug' => (string)$this->slug,
            'tags' => $this->tags ? $this->getTags($this->tags) : null,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            'media_id' => $this->media_id ? $this->media_id : null,
            'subject' => $subject ? $subject->label : null,
            'subject_id' => $this->subject_id ? $this->subject_id : null,
            'media' => isset($media) ? $media[0] : null
        ] ;

        if($result['media'] = null || []) {
            unset($result['media']);
            unset($result['media_id']);
        }
        // if(isset($result['media']) && !count($result['media'])) {
        //     unset($result['media']);
        // }


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
