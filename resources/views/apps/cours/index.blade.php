@extends('layouts.app')

@section('content')

<h2>Liste des cours</h2>

<a href="{{ route('cours.create') }}">
Ajouter un cours
</a>

<table border="1" width="100%">

<tr>
<th>Nom</th>
<th>Matière</th>
<th>Actions</th>
</tr>

@foreach($cours as $c)

<tr>

<td>{{ $c->nom }}</td>

<td>{{ $c->matiere->nom ?? '' }}</td>

<td>

<a href="{{ route('cours.edit',$c->id) }}">
Modifier
</a>

<form action="{{ route('cours.destroy',$c->id) }}" method="POST">

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

{{ $cours->links() }}
@endsection
