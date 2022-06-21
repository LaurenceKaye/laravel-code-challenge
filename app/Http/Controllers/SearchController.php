<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\SpotifyService;

class SearchController extends Controller
{
    public function index()
    {
        return view('index');
    }


    public function search(Request $request)
    {
        $query = $request->get('query');

        $spotify = new SpotifyService();
        $results = $spotify->search($query, ['track','artist','album']);

        return view('search', [
            'searchTerm' => $query,
            'albums' => $results->albums->items,
            'artists' => $results->artists->items,
            'tracks' => $results->tracks->items,
        ]);
    }

    public function details($type, $id)
    {
        $spotify = new SpotifyService();
        $result = $spotify->details($id, $type);

        if ($type == 'artists') {
            $topTracks = $spotify->artistTopTracks($id);
            $albums = $spotify->artistAlbums($id);
        }

        return view('details', [
            'result' => $result,
            'type' => Str::title(Str::singular($type)),
            'topTracks' => $topTracks ?? null,
            'albums' => $albums ?? null,
        ]);
    }
}
