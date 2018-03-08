<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class ApiController extends Controller
{
    protected function getSpotifyToken()
    {
        $curl = curl_init();
        $spotifyKey = env("SPOTIFY_API_KEY");

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://accounts.spotify.com/api/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=client_credentials",
            CURLOPT_HTTPHEADER => [
                "Authorization: Basic $spotifyKey",
                "Cache-Control: no-cache",
                "Content-Type: application/x-www-form-urlencoded",
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $spotifyTokenResponse = json_decode($response, true);
        return $spotifyTokenResponse['access_token'];
    }

    protected function getAlbums($artistId, $accessToken)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.spotify.com/v1/artists/$artistId/albums?album_type=album",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer $accessToken",
                "Cache-Control: no-cache",
                "Content-Type: application/x-www-form-urlencoded",
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return json_decode($response, true);
    }

    public function searchSpotify(Request $request)
    {
        $query = urlencode($request->searchArtist);
        $accessToken = self::getSpotifyToken();

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.spotify.com/v1/search?q=$query&type=artist&limit=1",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer $accessToken",
                "Cache-Control: no-cache",
                "Content-Type: application/x-www-form-urlencoded",
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $spotifyArtistResponse = json_decode($response, true);
        $albums = self::getAlbums($spotifyArtistResponse['artists']['items'][0]['id'], $accessToken);
        $events = self::getEvents($query);

        $data = [
          'response' => $spotifyArtistResponse,
          'albums' => $albums,
          'events' => $events
        ];
        return view('index')->with($data);
    }

    protected function getSongKickArtistId($query)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "http://api.songkick.com/api/3.0/search/artists.json?apikey=G2qWkKX1kGGzlYFn&query=$query&per_page=1",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Cache-Control: no-cache",
                "Postman-Token: a69af1b0-d478-af4a-584e-b02c0ce0ac96"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $songKickSearchResponse = json_decode($response, true);

        return $songKickSearchResponse['resultsPage']['results']['artist'][0]['id'];
    }

    protected function getEvents($query)
    {
        $artistId = self::getSongKickArtistId($query);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "http://api.songkick.com/api/3.0/artists/$artistId/calendar.json?apikey=G2qWkKX1kGGzlYFn",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Cache-Control: no-cache",
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $songKickEventsResponse = json_decode($response, true);
        return $songKickEventsResponse;
    }
}
