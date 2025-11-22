<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthorController extends Controller
{
    // display all Authors
	public function list(): View
	{
	$items = Author::orderBy('name', 'asc')->get();
	return view(
	'author.list',
	[
	'title' => 'Artists',
	'items' => $items,
	]
	);
	}
	
	// display new Author form
	public function create(): View
	{
	return view(
	'author.form',
	[
	'title' => 'Add new artist',
	'author' => new Author()
	]
	);
	}

// create new Author
	public function put(Request $request): RedirectResponse
	{
	$validatedData = $request->validate([
	'name' => 'required|string|max:255',
	]);
	$author = new Author();
	$author->name = $validatedData['name'];
	$author->save();
	return redirect('/authors');
	}

// display Author editing form
	public function update(Author $author): View
	{
	 return view(
	 'author.form',
	 [
	 'title' => 'Edit artist',
	 'author' => $author
	 ]
	 );
	}

// update existing Author data
	public function patch(Author $author, Request $request): RedirectResponse
	{
	 $validatedData = $request->validate([
	 'name' => 'required|string|max:255',
	 ]);
	 $author->name = $validatedData['name'];
	 $author->save();
	 return redirect('/authors');
	}

	public function delete(Author $author): RedirectResponse
	{
	 // this is a good place to check if author has related Book items and if so, prevent deletion
	 $author->delete();
	 return redirect('/authors');
	}


}
