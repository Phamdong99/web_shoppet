<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadService
{

    public function store($request)
    {
        $files = $request->file('file');
        foreach ($files as $file){
            $name = $file->getClientOriginalName();
            if ($request->hasFile('file')) {
                $path = $file->storeAs(
                    'uploads/' . date('y/m/d'), $name);
            }
        }

        return response()->json(['msg' => $request->hasFile('file')], 200);
    }
}
