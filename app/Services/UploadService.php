<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadService
{

    public function store($request)
    {
        $files = $request->file('file');
        foreach ($files as $file){

            if ($request->hasFile('file')) {
                try{
                    $name = $file->getClientOriginalName();
                    $pathFull = 'uploads/' . date('y/m/d');

                    $path = $file->storeAs(
                        'public/'. $pathFull , $name
                    );

                    return '/storage/'. $pathFull .'/'.$name;
                }catch (\Exception $err){
                    return false;
                }


            }
        }
    }
}
