<?php


namespace App\Services;


use App\Models\File;

class FileService
{
    public function add($request, $uploadHandler)
    {
        $type = $file->getClientOriginalExtension() == 'docx' ?: 'txt';
        $result = $uploadHandler->save($request->file, 'files', $request->user()->id);
        $file = File::create([
            'type' => $type,
            'user_id' => $request->user()->id,
            'path' => $request['path']
        ]);
        return $file;
    }
}
