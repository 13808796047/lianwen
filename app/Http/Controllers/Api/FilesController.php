<?php

namespace App\Http\Controllers\Api;

use App\Handlers\FileUploadHandler;
use App\Http\Requests\Api\FileRequest;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function store()
    {
        return response()->json([
            'message' => '文件来了...'
        ], 200);
        $user = $request->user();
        $result = $uploader->save($request->file, 'files', $user->id);
        return $result;
    }
}
