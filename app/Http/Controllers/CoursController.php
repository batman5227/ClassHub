<?php
namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Matiere;
use Illuminate\Http\Request;

class CoursController extends Controller
{

public function index()
{
$cours = Cours::with('matiere')->paginate(10);

return view('cours.index',compact('cours'));
}

public function create()
{
$matieres = Matiere::all();

return view('cours.create',compact('matieres'));
}

public function store(Request $request)
{

$request->validate([
'nom'=>'required',
'idMatiere'=>'required'
]);

Cours::create($request->all());

return redirect()->route('cours.index');

}

public function edit($id)
{
$cours = Cours::findOrFail($id);
$matieres = Matiere::all();

return view('cours.edit',compact('cours','matieres'));
}

public function update(Request $request,$id)
{

$cours = Cours::findOrFail($id);

$cours->update($request->all());

return redirect()->route('cours.index');

}

public function destroy($id)
{

$cours = Cours::findOrFail($id);

$cours->delete();

return redirect()->route('cours.index');
}
};
