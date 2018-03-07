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

        $data = [
          'response' => $spotifyArtistResponse
        ];
        return view('index')->with($data);
    }
}
