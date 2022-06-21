<?php

namespace App\Services;

//use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

class SpotifyService {

	private $token;
	private $api_url;
	private $client;

	public function __construct()
	{
		$this->api_url = 'https://api.spotify.com/v1/';

		// Get auth token
		$this->client = new Client();

		$response = $this->client->request('POST', 'https://accounts.spotify.com/api/token', [
			'headers' => [ 'Authorization' => 'Basic ' . base64_encode(env('SPOTIFY_CLIENT_ID') . ':' .  env('SPOTIFY_CLIENT_SECRET')) ],
			'form_params' => [ 'grant_type' => 'client_credentials' ],
		]);

		if ($response->getStatusCode() === 200)
		{
			$content = json_decode($response->getBody());
			$token = $content->access_token;
			$ttl = ($content->expires_in / 60);

			//Cache::put('spotify_token', $token, $ttl);
			$this->token = $token;
		}
	}

	private function request($method, $endpoint, $data)
	{
		$token = $this->token;
		$response = $this->client->request($method, $this->api_url . $endpoint, [
			'headers' => [ 'Authorization' => 'Bearer ' . $token ],
			'query' => $data,
		]);

		return $response;

	}

	public function search($query, $types)
	{
		$results = $this->request('GET', 'search', [
			'q' => $query,
			'type' => implode(",", $types),
		]);

		return json_decode($results->getBody());
	}

	public function details($id, $type)
	{
		$response = $this->request('GET', "{$type}/{$id}", []);

		return json_decode($response->getBody());
	}

	public function artistTopTracks($artistId)
	{
		$response = $this->request('GET', "artists/{$artistId}/top-tracks", [
			'market' => 'GB',
		]);

		return json_decode($response->getBody())->tracks;
	}

	public function artistAlbums($artistId)
	{
		$response = $this->request('GET', "artists/{$artistId}/albums", [
			'include_groups' => 'album',
			'market' => 'GB',
		]);

		return json_decode($response->getBody())->items;
	}
	
}