<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Album;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\AlbumRequest;

class AlbumController extends Controller implements HasMiddleware
{
	private function saveAlbumData(Album $album, AlbumRequest $request): void
	{
		$validatedData = $request->validated();
		
		$album->fill($validatedData);
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
	}

	
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
	public function put(AlbumRequest $request): RedirectResponse
	{
		$album = new Album();
		$this->saveAlbumData($album, $request);
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
	public function patch(Album $album, AlbumRequest $request): RedirectResponse
	{
		$this->saveAlbumData($album, $request);
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
