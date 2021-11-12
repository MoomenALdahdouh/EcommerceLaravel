<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function adminBrand(){
        $brand = Brand::all();
        return view('admin.brand.index',compact('brand'));
    }
}
