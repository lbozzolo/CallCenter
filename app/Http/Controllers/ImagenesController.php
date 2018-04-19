<?php

namespace SmartLine\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use SmartLine\Entities\Imagen;
use SmartLine\Entities\Producto;


class ImagenesController extends Controller
{

    public function index()
    {
        $imagenes = Imagen::all();
        return view('imagenes.index', compact('imagenes'));
    }

    public function storeImage(Request $request, $id, $model)
    {
        if($model == 'producto'){
            $imageable = Producto::find($id);
        }else{
            $imageable = User::find($id);
        }

        if($request->file('img')){
            $file = $request->file('img');
            $nombre = $file->getClientOriginalName();
            $imagen = Imagen::create(['path' => $nombre, 'principal' => 0]);
            $imagen->title = $request->title;
            $file->move(storage_path('app\imagenes'), $nombre);
            $imageable->images()->save($imagen);

        }
        return redirect()->back()->with('ok', 'Imagen subida con éxito');
    }

    public function verImage($file)
    {
        return response()->make(File::get(storage_path("app/imagenes/".$file)),200)
            ->header('Content-Type', 'image/jpg');
    }

    public function principalImage($id)
    {
        $imagen = Imagen::find($id);

        if($imagen->imageable_type == 'producto'){
            $imageable = Producto::find($imagen->imageable_id);
        }else{
            $imageable = User::find($imagen->imageable_id);
        }

        foreach($imageable->images as $img){
            $img->principal = 0;
            $img->save();
        }

        $imagen->principal = 1;
        $imagen->save();

        return redirect()->back();
    }

    public function deleteImage($id)
    {
        $imagen = Imagen::find($id);
        $imagen->delete();

        return redirect()->back()->with('ok', 'Imagen eliminada con éxito');
    }

}
