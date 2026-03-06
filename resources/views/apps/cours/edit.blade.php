@extends('layouts.app')

@section('content')

<h2>Modifier cours</h2>

<form action="{{ route('cours.update',$cours->id) }}" method="POST">

@csrf
@method('PUT')

<label>Nom</label>

<input type="text" name="nom" value="{{ $cours->nom }}">

<br><br>

<label>Matière</label>

<select name="idMatiere">

@foreach($matieres as $matiere)

<option value="{{ $matiere->id }}"
{{ $matiere->id == $cours->idMatiere ? 'selected' : '' }}>

{{ $matiere->nom }}

</option>

@endforeach

</select>

<br><br>

<button type="submit">
Modifier
</button>

</form>

@endsection