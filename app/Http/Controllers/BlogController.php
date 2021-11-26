<?php

namespace App\Http\Controllers;

class BlogController extends Controller
{
    public function index($name = null)
    {
        if(!is_numeric($name)){
            abort(404);
        }

        if ($name) {

            dd('this is the blog inner page ' . $name);

        } else {
            dd('this is the blog list page');
        }
    }
}
