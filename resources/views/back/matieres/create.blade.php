@extends('layouts.master')

@section('content')

<h2>Ajouter une matière</h2>

<form action="{{ route('matieres.store') }}" method="POST">

@csrf

<label>Nom</label>

<input type="text" name="nom">

<br><br>

<label>Classe</label>

<select name="idClasse">

@foreach($classes as $classe)

<option value="{{ $classe->id }}">
{{ $classe->nom }}
</option>

@endforeach

</select>

<br><br>

<button type="submit">
Enregistrer
</button>

</form>

@endsection
