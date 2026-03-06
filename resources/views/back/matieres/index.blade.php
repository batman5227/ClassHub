extends('layouts.app')

@section('content')

<h2>Liste des matières</h2>

<a href="{{ route('matieres.create') }}">Ajouter une matière</a>

<table borde="1">

<tr>
<th>Nom</th>
<th>Classe</th>
<th>Actions</th>
</tr>

@foreach($matieres as $matiere)

<tr>

<td>{{ $matiere->nom }}</td>

<td>{{ $matiere->classe->nom ?? '' }}</td>

<td>

<a href="{{ route('matieres.edit',$matiere->id) }}">
Modifier
</a>

<form action="{{ route('matieres.destroy',$matiere->id) }}" method="POST">

@csrf
@method('DELETE')

<button type="submit">
Supprimer
</button>

</form>

</td>

</tr>

@endforeach

</table>

{{ $matieres->links() }}
@endsection