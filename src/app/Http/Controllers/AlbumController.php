<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Album;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class AlbumController extends Controller implements HasMiddleware
{
    // call auth middleware
	public static function middleware(): array
	{
		return [
		'auth',
		];
	}
	
	// display all Albums
	public function list(): View
	{
		$items = Album::orderBy('name', 'asc')->get();
		return view(
			'album.list',
			[
			'title' => 'Albūmi',
			'items' => $items
			]
		);
	}
	
	// display new Album form
	public function create(): View
	{
		$authors = Author::orderBy('name', 'asc')->get();
		return view(
		'album.form',
		[
		'title' => 'Pievienot albūmu',
		'album' => new Album(),
		'authors' => $authors,
		]
		);
	}
	
	// create new Album entry
	public function put(Request $request): RedirectResponse
	{
		$validatedData = $request->validate([
			'name' => 'required|min:3|max:256',
			'author_id' => 'required',
			'description' => 'nullable',
			'price' => 'nullable|numeric',
			'year' => 'numeric',
			'image' => 'nullable|image',
			'display' => 'nullable',
		]);
		$album = new Album();
		$album->name = $validatedData['name'];
		$album->author_id = $validatedData['author_id'];
		$album->description = $validatedData['description'];
		$album->price = $validatedData['price'];
		$album->year = $validatedData['year'];
		$album->display = (bool) ($validatedData['display'] ?? false);
		
		if ($request->hasFile('image')) {
			// šeit varat pievienot kodu, kas nodzēš veco bildi, ja pievieno jaunu
			 $uploadedFile = $request->file('image');
			 $extension = $uploadedFile->clientExtension();
			 $name = uniqid();
			 $album->image = $uploadedFile->storePubliclyAs(
			 '/',
			 $name . '.' . $extension,
			 'uploads'
			 );
		}
		
		$album->save();
		return redirect('/albums');
	}

	// display Album edit form
	public function update(Album $album): View
	{
		$authors = Author::orderBy('name', 'asc')->get();
		return view(
		'album.form',
		[
		'title' => 'Rediģēt albūmu',
		'album' => $album,
		'authors' => $authors,
		]
		);
	}
	
	// update Album data
	public function patch(Album $album, Request $request): RedirectResponse
	{
		$validatedData = $request->validate([
			'name' => 'required|min:3|max:256',
			'author_id' => 'required',
			'description' => 'nullable',
			'price' => 'nullable|numeric',
			'year' => 'numeric',
			'image' => 'nullable|image',
			'display' => 'nullable',
		]);
		$album->name = $validatedData['name'];
		$album->author_id = $validatedData['author_id'];
		$album->description = $validatedData['description'];
		$album->price = $validatedData['price'];
		$album->year = $validatedData['year'];
		$album->display = (bool) ($validatedData['display'] ?? false);
		
		if ($request->hasFile('image')) {
			// šeit varat pievienot kodu, kas nodzēš veco bildi, ja pievieno jaunu
			 $uploadedFile = $request->file('image');
			 $extension = $uploadedFile->clientExtension();
			 $name = uniqid();
			 $album->image = $uploadedFile->storePubliclyAs(
			 '/',
			 $name . '.' . $extension,
			 'uploads'
			 );
		}
		
		$album->save();
		//return redirect('/albums/update/' . $album->id);
		return redirect('/albums');
	}
	
	// delete Album
	public function delete(Album $album): RedirectResponse
	{
		if ($album->image) {
		unlink(getcwd() . '/images/' . $album->image);
		}
		
		$album->delete();
		return redirect('/albums');
	}

	
}
