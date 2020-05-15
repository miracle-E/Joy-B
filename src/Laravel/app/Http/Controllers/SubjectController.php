<?php

namespace App\Http\Controllers;

use App\Category;
use App\Content;
use App\ContentAccess;
use App\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\SubjectResource;
use App\Http\Resources\SubjectsResource;
use App\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Traits\CommonTrait;
use App\UserSubject;

class SubjectController extends BaseController
{
    use CommonTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Show all employees from the database and return to view
        $subjects = Subject::with('access')->get();
        return $this->sendResponse(new SubjectsResource($subjects), "successful");
    }

    public function showAll($message = null)
    {
        $subjects = Subject::all();
        if (isset($subjects)) {
            if(isset($message)){
            return view('pages.subject.index', compact('subjects','message'));
            }
            return view('pages.subject.index', compact('subjects'));
        } else {
            return back()
                ->with('error', 'Content not found');
        }
    }

    public function create()
    {
        $categories = Category::all();
        $contents = Content::all();
        $accesses = ContentAccess::all();

        if (isset($categories)) {
            return view('pages.subject.create', compact('categories', 'contents', 'accesses'));
        } else {
            return back()
                ->with('error', 'Content not found');
        }
    }

    public function subscribe(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'subject_id' => 'required|string',
            'user_id' => 'string|required',
            'payment_status' => 'string'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['id'] = uniqid("gb", false);
        $subject = Subject::where('id' ,'=', $input['subject_id'])->with('access')->first();

        if(isset($subject)){
            // Let's determine if subject is free or paid
            $subject_access_status = ContentAccess::findOrFail($subject->access)->first();
            $subject_access_status = $subject_access_status ? $subject_access_status['name'] : 'premium';

            // Subscribe for free or paid subject as case may be
            if($subject_access_status !== 'free' && $input['payment_status'] == 'verified'){
                $user_sub = UserSubject::create([
                   'user_id' => $input['user_id'],
                   'subject_id' => $input['subject_id'],
                   'status' => 'paid'
                   ]);
                   return $this->sendResponse($subject, 'subscription successful');
            }else{
                $user_sub = UserSubject::create([
                    'user_id' => $input['user_id'],
                    'subject_id' => $input['subject_id'],
                    'status' => 'free'
                    ]);
                    return $this->sendResponse($subject, 'subscription successful');
            }

        }else{
            return $this->sendError('Subject not found!', [], 404);
        }

        return $this->sendError('There has been a problem!', [], 500);
    }

    public function edit($id, Request $request)
    {

        $categories = Category::all();
        $contents = Content::all();
        $accesses = ContentAccess::all();

        if($request->label){
            $validator = Validator::make($request->all(), [
                'label' => 'required|string',
                'category' => 'string',
                'rating' => 'max:10',
                'access' => 'string'
            ]);

            if ($validator->fails()) {
                return back()
                    ->with('error', $validator->errors());
            }

            $subject = Subject::findOrfail($request->id);
            $subject->name = Str::slug($request->label);
            $subject->label = $request->label;
            $subject->access = $request->access;
            $subject->category = $request->category;

            $subject->save();
            if (isset($subject)) {
                return view('pages.subject.edit', compact('categories', 'subject', 'contents', 'accesses'))->with('success', 'update successful');
            } else {
                return back()
                    ->with('error', 'Content not found');
            }
        }


        $subject = Subject::where("id", "=", $id)->first();
        if (isset($subject)) {
            return view('pages.subject.edit', compact('categories', 'subject', 'accesses'));
        } else {
            return back()
                ->with('error', 'Content not found');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addNew(Request $request)
    {
        $input = $request->all();
        $duplicate = Subject::where('name','=',Str::slug($input['label']))->first();
        $validator = Validator::make($input, [
            'label' => 'required|string',
            'access' => 'required|string',
            'rating' => 'max:10',
            'category' => 'required|string'
        ]);

        if(isset($duplicate)){
            return back()
                ->with('error', "Duplicate names not supported");
        }
        if ($validator->fails()) {
            return back()
                ->with('error', $validator->errors());
        }

        $input['id'] = uniqid("gb", false);
        $input['name'] = Str::slug($input['label']);
        $input['label'] = $input['label'];
        $input['access'] = $this->columnToId($input['access'], 'name', new ContentAccess()) ? $this->columnToId($input['access'], 'name', new ContentAccess()) : null;
        $input['category'] = $this->columnToId($input['category'], 'name', new Category()) ? $this->columnToId($input['category'], 'name', new Category()) : null;
        $subject = Subject::create($input);
        $success = "Subject added successfully";

        if($subject && isset($input['tags'])){
            $tagNames = explode(',', $input['tags']);
            $tagIds = [];

            // return response($tagNames);
            foreach ($tagNames as $key => $tagName) {
                $tag = Tag::firstOrCreate(['id' => uniqid("gbt", false) , 'label' => $tagName, 'name' => Str::slug($tagName)]);
                if($tag){
                    $tagIds[] = $tag->id;
                }
            }
            $subject->tags()->sync($tagIds);

        }
        if ($subject) {
            $this->showAll($success);
        }else{
           return back()
            ->with('error', 'Error processing request');
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'label' => 'required|string',
            'access' => 'string',
            'category' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['id'] = uniqid("gb", false);
        $input['name'] = Str::slug($input['label']);
        $input['label'] = $input['label'];
        $input['access'] = $this->columnToId($input['access'], 'name', new ContentAccess()) ? $this->columnToId($input['access'], 'name', new ContentAccess()) : null;
        $input->category = $this->columnToId($input['category'], 'name', new Category()) ? $this->columnToId($input['category'], 'name', new Category()) : null;

        $subject = Subject::create($input);

        return $this->sendResponse($subject, 'Subject added successfully.');
    }

    public function view($id)
    {
        $subjects = Subject::findOrFail($id);
        if (isset($subjects)) {
            return view('pages.subject.view', compact('subjects'));
        } else {
            return back()
                ->with('error', 'subjects not found');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::with('access')->where('name', '=', $id)->first();
        if(!isset($subject)){
            $subject = Subject::with('access')->where('id', '=', $id)->first();
        }

        if (is_null($subject)) {
            return $this->sendError('Subject not found.');
        }
        return $this->sendResponse(new SubjectResource($subject), 'Successful.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'label' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $subject->name = Str::slug($input['label']);
        $subject->label = $input['label'];
        $input['access'] = $this->columnToId($input['access'], 'name', new ContentAccess()) ? $this->columnToId($input['access'], 'name', new ContentAccess()) : null;
        $subject->save();

        return $this->sendResponse($subject, 'Subject updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return $this->sendResponse([], 'Subject deleted successfully.');
    }
    public function delete($id)
    {
        $subject = Subject::findOrfail($id);


        if ($subject->delete()) {
            return back()
                ->with('success', 'subject delete successfully');
        } else {
            return back()
                ->with('error', 'failed to delete subject!');
        }
    }
}
