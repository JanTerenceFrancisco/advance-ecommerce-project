<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function BrandView()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }

    public function BrandStore(Request $request)
    {
        $request->validate(
            [
                'brand_name' => 'required|',
                'brand_image' => 'required',
            ],
            [
                'brand_name.required' => 'Input Brand Name',
            ]
        );

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/brand/' . $name_gen);
        $save_url = 'upload/brand/' . $name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            'brand_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Brand Added',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function BrandEdit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    public function BrandUpdate(Request $request)
    {
        $brand_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('brand_image')) {

            unlink($old_image);
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/brand/' . $name_gen);
            $save_url = 'upload/brand/' . $name_gen;

            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Brand Updated',
                'alert-type' => 'success',
            );

            return redirect()->route('all.brand')->with($notification);
        } else {
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            ]);

            $notification = array(
                'message' => 'Brand Updated',
                'alert-type' => 'success',
            );

            return redirect()->route('all.brand')->with($notification);
        }
    }

    public function BrandDelete($id)
    {
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);

        Brand::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Brand Deleted',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }
}
