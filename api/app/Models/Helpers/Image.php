<?php

namespace App\Models\Helpers;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function saveLocal($request):string
    {
        $filenameWithExt = $request->file('image')->getClientOriginalName();

        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        $extention = $request->file('image')->getClientOriginalExtension();

        $fileNameToStore = "image/".$filename."_".time().".".$extention;

        return $request->file('image')->storeAs('public/', $fileNameToStore);
    }

}
