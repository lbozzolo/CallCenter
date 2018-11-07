<?php

namespace SmartLine\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use SmartLine\Entities\Imagen;
use SmartLine\Entities\Producto;
use SmartLine\User;

class ImagenesController extends Controller
{

    public function index()
    {
        $imagenesProductos = Imagen::where('imageable_type', 'producto')->get();
        $imagenesUsers = Imagen::where('imageable_type', 'user')->get();
        return view('imagenes.index', compact('imagenesProductos', 'imagenesUsers'));
    }

    public function storeImage(Request $request, $id, $model)
    {
        if(!$request->file('img'))
            return redirect()->back()->withErrors('No se ha seleccionado ningún archivo');

        $imageable = ($model == 'producto')? Producto::find($id) : User::find($id);

        // Redirección si supera el máximo de fotos permitido
        if($imageable->images->count() >= config('sistema.imagenes.MAX_NUMBER_IMAGES'))
            return redirect()->back()->withErrors('El número máximo de fotos permitido es '.config('sistema.imagenes.MAX_NUMBER_IMAGES').'. Elimine una foto y vuelva a intentarlo');

        if($request->file('img')){

            $file = $request->file('img');

            // Redirección si excede el máximo tamaño de imagen permitido
            if($file->getClientSize() > config('sistema.imagenes.MAX_SIZE_IMAGE'))
                return redirect()->back()->withErrors('La foto es demasiado grande (Debe ser menor a 2M)');

            // Confirma que el archivo no exista en el destino
            $nombre = $this->changeFileNameIfExists($file);

            $imagen = Imagen::create(['path' => $nombre, 'principal' => 0]);
            $imagen->title = $request->title;
            $file->move(storage_path('imagenes'), $nombre);
            $imageable->images()->save($imagen);

        }
        return redirect()->back()->with('ok', 'Imagen subida con éxito');
    }

    public function verImage($file)
    {
        if (file_exists( storage_path(  "imagenes/".$file))) {
            return response()->make(File::get(storage_path("imagenes/".$file)),200)->header('Content-Type', 'image/jpg');
        } else {
            return response()->make(File::get(storage_path("imagenes/default-profile-picture.jpg")),200)->header('Content-Type', 'image/jpg');
        }

        //return response()->make(File::get(storage_path("imagenes/".$file)),200)->header('Content-Type', 'image/jpg');
    }

    public function principalImage($id)
    {
        $imagen = Imagen::find($id);
        $imageable = ($imagen->imageable_type == 'producto')? Producto::find($imagen->imageable_id): User::find($imagen->imageable_id);

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

        File::delete(storage_path("imagenes/".$imagen->path));

        return redirect()->back()->with('ok', 'Imagen eliminada con éxito');
    }

    public function changeFileNameIfExists($file)
    {
        $nombre = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        if (file_exists( storage_path("imagenes/".$nombre)))
            $nombre = preg_replace('/\\.[^.\\s]{3,4}$/', '', $nombre) . '-' . str_random(4) . '.' . $extension;

        return $nombre;
    }

}
