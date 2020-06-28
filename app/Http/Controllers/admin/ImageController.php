<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\models\Image;
use App\models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image_file = $request->all();
        // dd($image_file);
        $image = new Image();
        $image->product_id = $request->id;


        if ($request->hasFile('image')) {
            $img = $request->image;
            if (File::exists($image->image)) {
                $image_path = $image->image;
                File::delete($image_path);
            }


            $imagename = Storage::disk(env('STORAGE_DISK'))->put('slider', $img);
            $imgArr = explode('/', $imagename);
            $image_name = $imgArr[1];
            $image->image = env('STORAGE_PATH') . '/products/' . $image_name;

            // $imagename = Storage::disk('public')->put('products', $img);
            // $imgArr = explode('/', $imagename);
            // $image_name = $imgArr[1];
            // $image->image = '/storage/products/' . $image_name;


            $image->save();
            return $image;
        }
        return 'error';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function images(Request $request, $id)
    {
        // dd(Storage::disk(env('STORAGE_DISK'))->delete('/swap/products/1MniNbpPc6XXwZJkbxQ8Sriuz2X66EjR42E3FK8x.jpeg'));
        // return ;

        // return $request->all();
        // dd($image);

        if ($request->hasFile('image')) {
            $image = Image::where('product_id', $id)->where('display', 1)->first();
            if (!$image) {
                $image_file = $request->all();
                $image = new Image();
            } else {
                $image_display = Image::where('product_id', $id)->where('display', 1)->get();
                foreach ($image_display as  $image_update) {
                    $image_update->display = false;
                    $image_update->save();
                }
                // $file_arr = explode('.com', $image->image);
                // dd($file_arr);
                $image_path = $image->image;
                // dd($file_arr);
                if (Storage::disk(env('STORAGE_DISK'))->exists($image_path)) {
                    $image_path = $image->image;
                    Storage::disk(env('STORAGE_DISK'))->delete($image_path);
                }
            }
            $image->product_id = $id;

            $img = $request->image;
            $imagename = Storage::disk(env('STORAGE_DISK'))->put('/products', $img);
            $imgArr = explode('/', $imagename);
            // dd($imgArr);
            $image_name = $imgArr[1];
            $uploaded_img = env('STORAGE_PATH') . '/products/' . $image_name;
            $image->image = $uploaded_img;
            $image->display = true;
            $image->save();
            return $image;
        }
        return 'error';
    }

    public function product_image(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $image = Image::where('product_id', $id)->where('display', 0)->first();
            if (!$image) {
                $image_file = $request->all();
                $image = new Image();
            } else {
                $image_display = Image::where('product_id', $id)->where('display', 0)->get();
                foreach ($image_display as  $image_update) {
                    $image_update->display = false;
                    $image_update->save();
                }
                $file_arr = explode('.com', $image->image);
                $image_path = $file_arr[1];
                // dd($file_arr);
                if (Storage::disk(env('STORAGE_DISK'))->exists($image_path)) {
                    $image_path = $image->image;
                    Storage::disk(env('STORAGE_DISK'))->delete($image_path);
                }
            }
            $image->product_id = $id;

            $img = $request->image;
            $imagename = Storage::disk(env('STORAGE_DISK'))->putFile('swap/productImages', $img, 'public');
            $imgArr = explode('/', $imagename);
            $image_name = $imgArr[2];
            $uploaded_img = env('STORAGE_PATH') . 'swap/productImages/' . $image_name;
            $image->image = $uploaded_img;
            $image->display = false;
            $image->save();
            return $image;
        }
        return 'error';
    }
}
