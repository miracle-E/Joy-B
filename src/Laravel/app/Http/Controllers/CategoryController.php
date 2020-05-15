<?php

namespace App\Http\Controllers;

use App\Category;
use App\Content;
use App\ContentAccess;
use App\ContentType;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Subject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Show all employees from the database and return to view
        $category = Category::with('products')->get();
        
    }
    
    public function showAll($message = null)
    {
        $categories = Category::all();
        if (isset($categories)) {
            if(isset($message)){
            return view('pages.categories.index', compact('categories','message'));
            }
            return view('pages.categories.index', compact('categories'));
        } else {
            return back()
                ->with('error', 'Category not found');
        }
    }


    public function showOne($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        if (isset($category)) {
            if(isset($message)){
            return view('pages.categories.view', compact('category','message'));
            }
            return view('pages.categories.view', compact('category'));
        } else {
            return view('pages.categories.index', compact('categories'))
                ->with('error', 'Category not found');
        }
    }


    public function create()
    {
        $accesses = ContentAccess::all();

        if (isset($accesses)) {
            return view('pages.content-category.create', compact('accesses'));
        } else {
            return back()
                ->with('error', 'Content not found');
        }
    }


    public function edit($id, Request $request)
    {
        if($request->label){
            $validator = Validator::make($request->all(), [
                'label' => 'required|string'
            ]);

            if ($validator->fails()) {
                return back()
                    ->with('error', $validator->errors());
            }

            $category = Category::where("id", "=", $request->id)->first();
            // return response($request->all());
            if(isset($category)){
                $category->name = $request->label ? Str::slug($request->label) : $category->name;
                $category->label = $request->label;
                $category->description = $request->description ? $request->description : "";

                $category->save();
                return view('pages.content-category.edit', compact('category'))->with('success', 'update successful');
            } else {
                return back()
                    ->with('error', 'Content not found');
            }
        }

        $category = Category::where('id','=',$id)->first();
        if (isset($category)) {
            return view('pages.content-category.edit', compact('category'));
        } else {
            return back()
                ->with('error', 'Category not found');
        }
    }


    public function addNew(Request $request)
    {
        $input = $request->all();
        $duplicate = Category::where('name','=',Str::slug($input['label']))->first();
        $validator = Validator::make($input, [
            'label' => 'required|string'
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

        // $category = Category::create($input);
        $success = "Category added successfully";

        if ($category = Category::create($input)) {
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
        // $input = new Category();
        $input = $request->all();

        $validator = Validator::make($input, [
            'label' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['id'] = uniqid('gb', false);
        $input['name'] = Str::slug($input['label']);
        $input['label'] = $input['label'];

        $category = Category::create($input);

        return $this->sendResponse($category, 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::with(['subCategories', 'contents'])->where('name', '=', $id)->first();

        if (is_null($category)) {
            return $this->sendError('Category not found.');
        }
        return $this->sendResponse($category, 'Category retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'label' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $category->name = Str::slug($input['label']);
        $category->label = $input['label'];
        $category->save();

        return $this->sendResponse($category, 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return $this->sendResponse([], 'Category deleted successfully.');
    }


    public function delete($id)
    {
        $category = Category::findOrfail($id);


        if ($category->delete()) {
            return back()
                ->with('success', 'category delete successfully');
        } else {
            return back()
                ->with('error', 'failed to delete category!');
        }
    }
}
