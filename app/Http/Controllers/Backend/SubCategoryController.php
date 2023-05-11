<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function SubCategoryView()
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = SubCategory::latest()->get();
        return view('backend.category.subcategory_view', compact('subcategory', 'categories'));
    }

    public function SubCategoryStore(Request $request)
    {
        $request->validate(
            [
                'category_id' => 'required|',
                'subcategory_name' => 'required',
            ],
            [
                'category_id.required' => 'Select Category',
                'subcategory_name.required' => 'Select Sub Category',
            ]
        );

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
        ]);

        $notification = array(
            'message' => 'Sub Category Added',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function SubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.category.subcategory_edit', compact('subcategory', 'categories'));
    }

    public function SubCategoryUpdate(Request $request)
    {
        $subcat_id = $request->id;

        SubCategory::findOrFail($subcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
        ]);

        $notification = array(
            'message' => 'Sub Category Updated',
            'alert-type' => 'success',
        );

        return redirect()->route('all.subcategory')->with($notification);
    }

    public function SubCategoryDelete($id)
    {
        SubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Sub Category Deleted',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }



    //Sub Sub Categories


    public function SubSubCategoryView()
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subsubcategories = SubSubCategory::latest()->get();

        return view('backend.category.sub_subcategory_view', compact('categories', 'subsubcategories'));
    }

    public function GetSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($subcat);
    }

    public function SubSubCategoryStore(Request $request)
    {
        $request->validate(
            [
                'category_id' => 'required|',
                'subcategory_id' => 'required|',
                'subsubcategory_name' => 'required',
            ],
            [
                'category_id.required' => 'Select Category',
                'subsubcategory_name.required' => 'Input Sub Sub Category',
            ]
        );

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name' => $request->subsubcategory_name,
            'subsubcategory_slug' => strtolower(str_replace(' ', '-', $request->subsubcategory_name)),
        ]);

        $notification = array(
            'message' => 'Sub Sub Category Added',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function SubSubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name', 'ASC')->get();
        $subsubcategories = SubSubCategory::findOrFail($id);
        return view('backend.category.sub_subcategory_edit', compact('subcategories', 'categories', 'subsubcategories'));
    }

    public function SubSubCategoryUpdate(Request $request)
    {
        $subsubcat_id = $request->id;

        $request->validate(
            [
                'category_id' => 'required|',
                'subcategory_id' => 'required|',
                'subsubcategory_name' => 'required',
            ],
            [
                'category_id.required' => 'Select Category',
                'subsubcategory_name.required' => 'Input Sub Sub Category',
            ]
        );

        SubSubCategory::findOrFail($subsubcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name' => $request->subsubcategory_name,
            'subsubcategory_slug' => strtolower(str_replace(' ', '-', $request->subsubcategory_name)),
        ]);

        $notification = array(
            'message' => 'Sub Sub Category Updated',
            'alert-type' => 'success',
        );

        return redirect()->route('all.subsubcategory')->with($notification);
    }

    public function SubSubCategoryDelete($id)
    {
        SubSubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Sub Sub Category Deleted',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }
}
