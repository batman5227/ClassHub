<?php
namespace App\Http\Controllers;

use App\Models\Matiere;
use App\Models\Classe;
use Illuminate\Http\Request;

class MatiereController extends Controller
{

public function index()
{
$matieres = Matiere::with('classe')->paginate(10);
return view('back.matiere.index',compact('matieres'));
}

public function create()
{
$classes = Classe::all();
return view('back.matiere.create',compact('classes'));
}

public function store(Request $request)
{
$request->validate([
'nom'=>'required',
'idClasse'=>'required'
]);

Matiere::create($request->all());

return redirect()->route('matieres.index');
}

public function edit($id)
{
$matiere = Matiere::findOrFail($id);
$classes = Classe::all();

return view('back.matiere.updat',compact('matiere','classes'));
}
public function show($id)
{
$matiere = Matiere::findOrFail($id);


return view('back.matiere.show',compact('matiere'));
}

public function update(Request $request,$id)
{
$matiere = Matiere::findOrFail($id);

$matiere->update($request->all());

return redirect()->route('matieres.index');
}

public function destroy($id)
{
$matiere = Matiere::findOrFail($id);
$matiere->delete();

return redirect()->route('matieres.index');
}
};




