<?php


namespace App\Services;


use App\Models\File;

class FileService
{
    public function add($request, $uploadHandler)
    {
        if($file = $request->file) {
            $type = $file->getClientOriginalExtension() == 'docx' ? 'docx' : 'txt';
            $result = $uploadHandler->save($file, 'files', $request->user()->id);
            $data = File::create([
                'type' => $type,
                'user_id' => $request->user()->id,
                'path' => $request['path']
            ]);
        }

        return $data;
    }
}
