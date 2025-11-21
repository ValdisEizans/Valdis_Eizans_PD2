<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ArtistController extends Controller
{
    public function list(): View
	{
	$items = Artist::orderBy('name', 'asc')->get();
	return view(
	'artist.list',
	[
	'title' => 'Artists',
	'items' => $items,
	]
	);
	}
	
	// display new Artist form
	public function create(): View
	{
	return view(
	'artist.form',
	[
	'title' => 'Add new artist'
	]
	);
	}
	
	// create new Artist
	public function put(Request $request): RedirectResponse
	{
	$validatedData = $request->validate([
	'name' => 'required|string|max:255',
	]);
	$artist = new Artist();
	$artist->name = $validatedData['name'];
	$artist->save();
	return redirect('/artists');
	}


}
