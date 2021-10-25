<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function allItem(){
        $items = Item::all();
        return view('admin.items.index',compact('items'));
    }
}
