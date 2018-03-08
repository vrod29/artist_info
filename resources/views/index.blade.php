
@extends('master')

@section('title')
    1 Stop Music
@endsection

@section('content')

<?php if (!empty($albums)) dump($albums); ?>

@if (!empty($response));
<style>

 .tour-pic {
   background-image: url(/images/concert.jpg);
   opacity: 0.50;
   height: 650px;
   width: 100%;
   position: absolute;
 }

</style>
@endif

  <!-- Header Jumbotron -->
  <section id="top" class="jumbotron jumbotron-fluid @if (empty($response)) fullscreen @endif">
    <div class="container mt-5">
      <h1 class=" header-text display-4 text-center">Welcome to 1-Stop Music</h1>
      <p class="lead text-center">Your 1-Stop site for artists info, discography, and tour info.</p>
    </div>
    <div class="container">
      <div class="row justify-content-center">
        <div id="search-headings" class="col-6 text-center">
          <h1 class="header-text">Search for an Artist</h1>
          <br>
          <p class="header-p">Type an artist name and click on "Search".</p>
          <form method="POST" action="/get_artist">
              @csrf
            <input name="searchArtist" type="text" id="query" value="" class="form-control" placeholder="Type an Artist Name" />
            <button type="submit" id="search" class="btn btn-lg" value="">Search</button>
          <div id="results"></div>
          </form>
        </div>
      </div>
    </div>
  </section>

    <!-- ///pic/bio// -->
  @if (!empty($response))
  <div class="container">
    <div class="row">
      <div class="col-md-4 text-center">
        <!--Card-->
        <div class="card testimonial-card">

          <!--Avatar-->
          <div class="avatar mx-auto white"><img src="{{ $response['artists']['items'][0]['images'][0]['url'] }}" width=200px height=200px class="rounded-circle">
          </div>
            <div class="card-body">
              <h4 class="card-title">{{ $response['artists']['items'][0]['name']}}</h4>
              <hr>
            <div id="social-media">
              <a href="{{$response['artists']['items'][0]['external_urls']['spotify']}}"><img class="twitter mx-1" src="images/spotify.svg" alt="" width="30px" height="30px"></a>
              <span>Spotify</span>
            </div>
            </div>
        </div>
      </div>
  <!--/.Card-->

  <!-- Discography -->
      <div class="col-md-8 scroll-discography">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>Pic</th>
              <th>Album Name</th>
              <th>Released</th>
              <th></th>
            </tr>
          </thead>
        <tbody id="discography">
            @foreach($albums['items'] as $album )
            <tr>
              <td><img src="{{$album['images'][0]['url']}}"  class="picSize"/></td>
              <td>{{$album['name']}}</td>
              <td>{{$album['release_date']}}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
      </div>
    </div>
  </div>
  @endif

  <br>

<!-- Tour Info -->
@if (!empty($events))
<section>
  <div class="tour-pic">
  </div>
    <div class="container">
      <div class="row">
        <div class="col">
          <h1 class="text-center">{{ $response['artists']['items'][0]['name']}}</h1>
          <p class="text-center">Tour Dates</p>
          <table class="table table-striped">
        </div>
      </div>
    </div>
  <div class="container event-info">
    <div class="row">
      <div class="col">
            <thead>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            @if (!empty($events['resultsPage']['results']['event']))
              @foreach($events['resultsPage']['results']['event'] as $event )
              <tr>
                <td>{{$event['start']['date']}}</td>
                <td>{{$event['venue']['displayName']}}</td>
                <td>{{$event['location']['city']}}</td>
                <td><button type="button" class="btn btn-primary btn-rounded btn-sm my-0">Ticketmaster</button></td>
              </tr>
              @endforeach
             @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
</section>
@endif

@endsection
