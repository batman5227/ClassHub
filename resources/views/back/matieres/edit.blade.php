@extends('layouts.app')

@section('content')

<h2>Modifier matière</h2>

<form action="{{ route('matieres.update',$matiere->id) }}" method="POST">

@csrf
@method('PUT')

<label>Nom</label>

<input type="text" name="nom" value="{{ $matiere->nom }}">

<br><br>

<label>Classe</label>

<select name="idClasse">

@foreach($classes as $classe)

<option value="{{ $classe->id }}"
{{ $classe->id == $matiere->idClasse ? 'selected' : '' }}>

{{ $classe->nom }}

</option>

@endforeach

</select>

<br><br>

<button type="submit">
Modifier
</button>

</form>

@endsection