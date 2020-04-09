<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function index()
    {
//        $path = public_path('uploads/files/202003/21/1_1584797894_MsxreS09Jz.docx');
//        dd(read_docx($path));
        return view('domained::pages.index');
    }
}
