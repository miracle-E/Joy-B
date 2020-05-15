<?php

namespace App\Http\Controllers;

use App\Category;
use App\Content;
use App\ContentAccess;
use App\ContentTag;
use App\ContentType;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Topic;
use Illuminate\Support\Facades\Validator;
use App\Traits\CommonTrait;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Str;
use App\Http\Resources\ContentResource;
use App\Http\Resources\ContentsResource;
use App\Subject;
use App\Tag;

class ContentController extends BaseController
{
    use CommonTrait, FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $content = Content::all();
        if ($request->category) {
            $category_id =  $this->columnToId(Str::slug($request->category), 'name', new Category());
            $content = Content::where("category", "=", $category_id)->get();
            return $this->sendResponse(new ContentsResource($content), "successful");
        }
        if ($request->content_type) {
            $content_type_id =  $this->columnToId(Str::slug($request->content_type), 'name', new ContentType());
            $content = Content::where("content_type", "=", $content_type_id)->get();
            return $this->sendResponse(new ContentsResource($content), "successful");
        }
        if ($request->content_access) {
            $content_access_id =  $this->columnToId(Str::slug($request->content_access), 'name', new ContentAccess());
            $content = Content::where("content_access", "=", $content_access_id)->get();
            return $this->sendResponse(new ContentsResource($content), "successful");
        }
        return $this->sendResponse(new ContentsResource($content), "successful");
    }

    public function createContent(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'category' => 'string|min:3',
            'description' => 'string|min:10',
            'is_published' => 'boolean',
            'content_type' => 'min:1',
            'content_access' => 'required',
            'subject_id' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }



        if (isset($input['thumbnail'])) {
            $input['thumbnail'] = $this->getBaseUrl() . $this->uploadFile($request->thumbnail, 'thumbnails');
        }

        if (isset($input['media'])) {
            $input['media_id'] = $this->saveMedia($request->media, 'media', $input['thumbnail'] ? $input['thumbnail'] : NULL);
        } else if (isset($input['media_url'])) {
            $input['media_id'] = $this->saveMediaURL($request->media_url, $input['thumbnail'] ? $input['thumbnail'] : NULL);
        }


        if ($request->content_type == "text") {
            unset($input['media']);
            unset($input['media_url']);
            unset($input['thumbnail']);
        } else if ($request->content_type == "video") {
            unset($input['body']);
        }


        $input['id'] = uniqid("gb", false);
        $input['rating'] = $request->rating ? $request->rating : 0;
        $input['slug'] = Str::limit(Str::slug($input['title']), 60, '') . "-" . Str::random();
        $input['category'] = $request->category ? $this->columnToId($input['category'], 'name', new Category()) : $input['category'];
        $input['content_type'] = $request->content_type ? $this->columnToId(Str::slug($input['content_type']), 'name', new ContentType()) : $input['content_type'];
        $input['content_access'] = $request->content_access ? $this->columnToId(Str::slug($input['content_access']), 'name', new ContentAccess()) : $input['content_access'];
        $input['is_published'] = $request->publish == "on" ? true : false;
        $input['published_date'] = $request->published_date ? $request->published_date : date('Y-m-d H:i:s');
        $content = Content::create($input);


        if($content && isset($input['tags'])){
            $tagNames = explode(',', $input['tags']);
            $tagIds = [];

            // return response($tagNames);
            foreach ($tagNames as $key => $tagName) {
                $tag = Tag::where('name', '=', Str::slug($tagName))->first();
                if(!$tag){
                    return response($tag);
                    $tag = Tag::create(['id' => uniqid("gbt", false) , 'label' => $tagName, 'name' => Str::slug($tagName)]);
                }
                if($tag){
                    ContentTag::create([
                        'content_id' => $content->id,
                        'tag_id' => $tag->id
                    ]);
                }
            }
            // $content->tags()->sync($tagIds);
        }


        if($content && isset($input['tags'])){
            $tagNames = explode(',', $input['tags']);
            $tagIds = [];

            // return response($tagNames);
            foreach ($tagNames as $key => $tagName) {
                $tag = Tag::firstOrCreate(['id' => uniqid("gbt", false) , 'label' => $tagName, 'name' => Str::slug($tagName)]);
                if($tag){
                    $tagIds[] = $tag->id;
                }
            }
            $content->tags()->sync($tagIds);

        }
        return $this->getAll('Content created successfully.');
    }

    public function getAll($message = null){
        $contents = Content::all();
        if(isset($message)){
            return view("pages.content.index")
            ->with('contents', $contents)
            ->with('message', $message);
        }

        return view("pages.content.index")
            ->with('contents', $contents);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $input = $request->all();
        // $validator = Validator::make($request->all(), [
        //     'title' => 'required|string',
        //     'body' => 'string|min:5',
        //     'category' => 'string|min:3',
        //     'description' => 'string|min:10',
        //     'published_date' => 'min:1',
        //     'is_published' => 'boolean',
        //     'content_type' => 'min:1',
        //     'content_access' => 'required',
        //     // 'media' => 'file'
        // ]);

        // if ($validator->fails()) {
        //     return $this->sendError('Validation Error.', $validator->errors());
        // }

        // // return response()->json($request->media,200);
        // // // cache the file
        // // $file = $request->file('media');
        // // // generate a new filename. getClientOriginalExtension() for the file extension
        // // $filename = 'profile-photo-' . time() . '.' . $file->getClientOriginalExtension();
        // // // save to storage/app/photos as the new $filename
        // // $path = $file->storeAs('photos', $filename);

        // // return response($path);


        // $thumbnail = $request->thumbnail ? $this->uploadFile($input['thumbnail'], 'thumbnails') : null;
        // $files = $request->media;
        // if ($files) {
        //     $destinationPath = 'public/thumbnails/'; // upload path
        //     $file = date('YmdHis') . "." . $files->getClientOriginalExtension();
        //     $files->move($destinationPath, $file);
        //     $media['thumbnail'] = "$file";
        //     return response($file);
        // }


        // $input['media_id'] = $this->saveMedia($request->media, 'media', $thumbnail);
        // // $input['media'] = $this->saveFiles($input['media']);
        // return response($input['media_id']);
        // $input['id'] = uniqid("gb", false);
        // $input['slug'] = Str::limit(Str::slug($input['title']), 60, '') . "-" . Str::random();
        // // $input['category'] = $input['category'] ? $this->columnToId($input['category'], 'name', new Category()) : $input['category'];
        // // $input['content_type'] = $input['content_type'] ? $this->columnToId(Str::slug($input['content_type']), 'name', new ContentType()) : $input['content_type'];
        // $content = Content::create($input);
        ///////////////////////////////////////////////////

        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'body' => 'string|min:5',
            'category' => 'string|min:3',
            'description' => 'string|min:10',
            'is_published' => 'boolean',
            'content_type' => 'min:1',
            'content_access' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }



        if (isset($input['thumbnail'])) {
            $input['thumbnail'] = $this->getBaseUrl() . $this->uploadFile($request->thumbnail, 'thumbnails');
        }

        if (isset($input['media'])) {
            $input['media_id'] = $this->saveMedia($request->media, 'media', $input['thumbnail'] ? $input['thumbnail'] : NULL);
        } else if (isset($input['media_url'])) {
            $input['media_id'] = $this->saveMediaURL($request->media_url, $input['thumbnail'] ? $input['thumbnail'] : NULL);
        }


        if ($request->content_type == "text") {
            unset($input['media']);
            unset($input['media_url']);
            unset($input['thumbnail']);
        } else if ($request->content_type == "video") {
            unset($input['body']);
        }


        $input['id'] = uniqid("gb", false);
        $input['slug'] = Str::limit(Str::slug($input['title']), 60, '') . "-" . Str::random();
        $input['category'] = $request->category ? $this->columnToId($input['category'], 'name', new Category()) : $input['category'];
        $input['content_type'] = $request->content_type ? $this->columnToId(Str::slug($input['content_type']), 'name', new ContentType()) : $input['content_type'];
        $input['content_access'] = $request->content_access ? $this->columnToId(Str::slug($input['content_access']), 'name', new ContentAccess()) : $input['content_access'];
        $input['is_published'] = $request->publish == "on" ? true : false;
        $input['published_date'] = $request->published_date ? $request->published_date : date('Y-m-d H:i:s');
        $content = Content::create($input);



        return $this->sendResponse($content, 'Content created successfully.');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $content = Content::findOrFail($id);
        if (isset($content)) {
            // return response($content);
            return view('pages.content.view', compact('content'));
        } else {
            return back()
                ->with('error', 'Content not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $content_types = ContentType::all();
        $subjects = Subject::all();
        $accesses = ContentAccess::all();

        if (isset($categories)) {
            // return response($content);
            return view('pages.content.create', compact('categories', 'content_types', 'subjects', 'accesses'));
        } else {
            return back()
                ->with('error', 'Content not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $content_types = ContentType::all();
        $subjects = Subject::all();
        $accesses = ContentAccess::all();
        $content = Content::where('id','=',$id)->first();
        if (isset($content)) {
            return view('pages.content.edit', compact('content','categories', 'content_types', 'subjects', 'accesses'));
        } else {
            return back()
                ->with('error', 'Content not found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $content = Content::where('id','=',$id)->first();

        if (is_null($content)) {
            return $this->sendError('Content not found.');
        }
        return $this->sendResponse(new ContentResource($content), 'Content retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $content = $input;
        $content->save();

        return $this->sendResponse($content, 'Content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        $content->delete();

        return $this->sendResponse([], 'Content deleted successfully.');
    }
}
