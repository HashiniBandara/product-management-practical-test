<?php

namespace App\Http\Controllers;

use App\Models\Image as ModelsImage;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{


    public function index()
    {
                return redirect('/login');
    }

}
