@extends('layout')
@section('content')
 <h1>{{ $title }}</h1>
 @if (count($items) > 0)
 <table class="table table-striped table-hover table-sm">
 <thead class="thead-light">
 <tr>
 <th>ID</td>
<th>Name</td>
<th>&nbsp;</td>
 </tr>
 </thead>
 <tbody>
 @foreach($items as $author)
 <tr>
 <td>{{ $author->id }}</td>
 <td>{{ $author->name }}</td>
 <td>Edit / Delete</td>
 </tr>
 @endforeach
 </tbody>
 </table>
 @else
 <p>No entries found in database</p>
 @endif
 <a href="/author/create" class="btn btn-primary">Add new</a>
@endsection