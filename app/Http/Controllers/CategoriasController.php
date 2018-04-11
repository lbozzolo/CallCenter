<?php namespace CallCenter\Http\Controllers;

use CallCenter\Http\Requests\CreateCategoriaRequest;
use CallCenter\Entities\Categoria;
use CallCenter\Http\Repositories\CategoriaRepo;

class CategoriasController extends Controller
{
    protected $categoriaRepo;

    public function __construct(CategoriaRepo $categoriaRepo)
    {
        $this->categoriaRepo = $categoriaRepo;
    }

    public function index()
    {
        $categorias = Categoria::whereNull('parent_id')->get()->sortBy('nombre');
        return view('categorias.index', compact('categorias'));
    }

    public function indexSubcategorias()
    {
        $subcategorias = Categoria::whereNotNull('parent_id')->get()->sortBy('nombre');
        $parents = Categoria::whereNull('parent_id')->get()->lists('nombre', 'id');
        return view('categorias.subcategorias', compact('subcategorias', 'parents'));
    }

    public function store(CreateCategoriaRequest $request)
    {
        $subcategoria = $request->subcategoria;
        $categoria = Categoria::create([
            'nombre' => $request->nombre,
            'slug' => $this->categoriaRepo->setToSlug($request->slug, $request->nombre),
            'parent_id' => ($request->parent_id)? $request->parent_id : null,
        ]);


        $parents = Categoria::whereNull('parent_id')->get()->lists('nombre', 'id');

        if($categoria){

            if($subcategoria){
                $subcategorias = Categoria::whereNotNull('parent_id')->get()->sortBy('nombre');
                return view('categorias.subcategorias', compact('subcategorias', 'parents'))
                    ->with('ok', 'La subcategoría '.$categoria->nombre.' ha sido creada con éxito');
            }else{
                $categorias = Categoria::whereNull('parent_id')->get()->sortBy('nombre');
                return view('categorias.index', compact('categorias', 'parents'))
                    ->with('ok', 'La categoría '.$categoria->nombre.' ha sido creada con éxito');
            }

        }else{
            return redirect()->route('categorias.index')->withErrors('No se pudo crear la categoría');
        }
    }

    public function edit($id)
    {
        $categoria = Categoria::find($id);

        if(!$categoria->parent_id){
            $categorias = Categoria::whereNull('parent_id')->get()->sortBy('nombre');
            return view('categorias.edit', compact('categoria', 'categorias', 'parents'));
        }else{
            $subcategorias = Categoria::whereNotNull('parent_id')->get()->sortBy('nombre');
            $parents = Categoria::whereNull('parent_id')->get()->lists('nombre', 'id');
            return view('categorias.subcategorias-edit', compact('categoria', 'subcategorias', 'parents'));
        }


    }

    public function update(CreateCategoriaRequest $request, $id)
    {
        $categoria = Categoria::find($id);

        $categoria->nombre = $request->nombre;
        $categoria->slug = $this->categoriaRepo->setToSlug($request->slug, $request->name);

        if($categoria->parent_id){

            $categoria->parent_id = ($request->parent_id)? $request->parent_id : null;
            $categoria->save();
            return redirect()->route('subcategorias.index')->with('ok', 'La subcategoría se ha actualizado con éxito');

        }

        $categoria->save();

        return redirect()->route('categorias.index')->with('ok', 'La categoría se ha actualizado con éxito');
    }

    public function destroy($id)
    {
        $categoria= Categoria::find($id);

        if($categoria->subcategorias()->count()){

            return redirect()->back()->withErrors('No puede eliminar la categoría porque tiene subcategorías');

        }else{

            if($categoria->parent()->count()){
                $categoria->delete();
                return redirect()->route('subcategorias.index')->with('ok', 'Subategoría eliminada con éxito');
            }else{
                $categoria->delete();
                return redirect()->route('categorias.index')->with('ok', 'Categoría eliminada con éxito');
            }

        }

    }

}