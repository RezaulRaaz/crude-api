<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\Helpers;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {

        // just for single file
        // $fileNameWithPath = Helpers::fileUpload($request->image,'products');
        $files = [];
        if ($request->image && count($request->image) > 0) {
            $images = $request->image;
            foreach ($images as $image) {
                $fileNameWithPath = Helpers::fileUpload($image, 'products');
                array_push($files, $fileNameWithPath);
            }
        }
        $product = Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'images' => json_encode($files)
        ]);
        return response()->json($product);
    }
}
