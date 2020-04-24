<?php


namespace App\Services;


use App\Models\File;

class FileService
{
    public function add($request, $uploadHandler)
    {
        $user = \Auth::user();
        if($file = $request->file) {
            $type = $file->getClientOriginalExtension() == 'docx' ? 'docx' : 'txt';
            $result = $uploadHandler->save($file, 'files', $user->id);
            $data = File::create([
                'type' => $type,
                'user_id' => $user->id,
                'path' => $request['path']
            ]);
        }

        return $data;
    }
}
