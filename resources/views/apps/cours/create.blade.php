@extends('layouts.app')

@section('content')

<h2>Ajouter un cours</h2>

<form action="{{ route('cours.store') }}" method="POST">

@csrf

<label>Nom du cours</label>

<input type="text" name="nom">

<br><br>

<label>Matière</label>

<select name="idMatiere">

@foreach($matieres as $matiere)

<option value="{{ $matiere->id }}">
{{ $matiere->nom }}
</option>

@endforeach

</select>

<br><br>

<button type="submit">
Enregistrer
</button>

</form>

@endsection