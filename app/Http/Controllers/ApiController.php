<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class ApiController extends Controller
{
    public function searchArtist()
    {
        if (!empty($_GET['artist'])) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://api.musixmatch.com/ws/1.1/artist.search?q_artist=" . $_GET['artist'] . "&page_size=5&apikey=8f3df11a62eade09ece60f73582d6b1a");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            echo $response;
        }
    }

    public function searchAlbum()
    {
        if (!empty($_GET['artistId'])) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://api.musixmatch.com/ws/1.1/artist.albums.get?artist_id=".$_GET['artistId']."&s_release_date=desc&apikey=8f3df11a62eade09ece60f73582d6b1a&page_size=100");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            echo $response;
        }
    }

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
        $query = $request->searchArtist;
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
        $data = [
          'response' = $response
        ];
        return view('index')->with($data);
    }
}
