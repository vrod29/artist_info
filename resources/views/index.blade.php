@extends('master')

@section('title')
    1 Stop Music
@endsection

@section('content')

</head>

<body>

    <!--  Jumbotron & Navbar -->
  <div class="jumbotron jumbotron-fluid pt-3">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <a class="navbar-brand" href="/">1-Stop Music</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" id="menu-item" href="about">ABOUT US<span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="container mt-5">
      <h1 class="display-4 text-center">Welcome to 1-Stop Music</h1>
      <p class="lead text-center">Your 1-Stop site for artists info, discography, tour info, and videos.</p>
    </div>
    <div class="container">
      <div class="row justify-content-center">
        <div id="search-headings" class="col-6 text-center">
          <h1>Search for an Artist</h1>
          <br>
          <p>Type an artist name and click on "Search".</p>
            <input type="text" id="query" value="" class="form-control" placeholder="Type an Artist Name" />
            <button id="search" class="btn btn-primary" value="">Search</button>
          <div id="results"></div>
        </div>
      </div>
    </div>
  </div>

    <!-- ///pic/bio// -->
  <div class="container">
    <div class="row">
      <div class="col-md-4 text-center">
        <div class="card">
          <img id="artistPic" class="card-img-top" src="brunomarsPic.jpg" alt="Card image cap">
        <div class="card-body">
          <h1 id='artist-name'>Bruno Mars</h1>
        <div id="social-media">
          <a id='twitter' href=""><img class="twitter mx-1" src="assets/twitter.svg" alt="" width="30px" height="30px"></a>
          <a id="facebook" href=""><img class="facebok mx-1" src="assets/facebook.svg" alt="" width="30px" height="30px"></a>
          <a id='instagram' href=""><img class="instagram mx-1" src="assets/instagram.svg" alt="" width="30px" height="30px"></a>
        </div>
        </div>
      </div>
      </div>
      <div class="col-md-8 scroll-discography">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Album Name</th>
              <th scope="col">Rating</th>
              <th scope="col">Tracks</th>
              <th scope="col">Release Date</th>
            </tr>
          </thead>
        <tbody id="discography">
        </tbody>
      </table>
      </div>
    </div>
  </div>
  <hr>
<div class="container">
  <div class="row">
    <div class="col-md-5 text-center">
      <h4>Tour Info</h4>

        <ul id='tour-info' style="list-style: none">
          <li>SEPTEMBER 7, 2018 DENVER, CO PEPSI CENTER</li>
          <li>SEPTEMBER 8, 2018 DENVER, CO PEPSI CENTER</li>
          <li>SEPTEMBER 11, 2018 ST. PAUL, MN XCEL ENERGY CENTER</li>
          <li>SEPTEMBER 12, 2018 ST. PAUL, MN XCEL ENERGY CENTER</li>
          <li>SEPTEMBER 15, 2018 DETROIT, MI LITTLE CAESARS ARENA</li>
          <li>SEPTEMBER 16, 2018 DETROIT, MI LITTLE CAESARS ARENA</li>
          <li>SEPTEMBER 19, 2018 PHILADELPHIA, PA WELLS FARGO CENTER</li>
          <li>SEPTEMBER 20, 2018 PHILADELPHIA, PA WELLS FARGO CENTER</li>
          <li>SEPTEMBER 22, 2018 TORONTO, ON AIR CANADA CENTRE</li>
          <li>SEPTEMBER 23, 2018 TORONTO, ON AIR CANADA CENTRE</li>
          <li>SEPTEMBER 27, 2018 BOSTON, MA TD GARDEN</li>
          <li>SEPTEMBER 2, 2018 BOSTON, MA TD GARDEN</li>
        </ul>

    </div>
    <div class="col-md-7 text-center">
        <h4>Videos</h4>
        <body>
            <iframe width="250" height="250" src="https://www.youtube.com/embed/LsoLEjrDogU">
            </iframe>
            <iframe width="250" height="250" src="https://www.youtube.com/embed/PMivT7MJ41M">
            </iframe>
            <iframe width="250" height="250" src="https://www.youtube.com/embed/UqyT8IEBkvY">
            </iframe>
              <iframe width="250" height="250" src="https://www.youtube.com/embed/nPvuNsRccVw">
            </iframe>
        </body>
    </div>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>

    $("#search").on("click", function(){
      artistName = $("#query").val();
      var artistName = artistName.split(' ').join('+');
      console.log(artistName)
      $("#query").val("");

      $.ajax({
        url: '/php/searchArtist.php?artist=' + artistName,
        method: 'GET'
      })
      .done(function(response) {
        response = JSON.parse(response);
        console.log(response)
        artist = response.message.body.artist_list[0].artist;
        console.log(artist);
        $("#artist-name").html(artist.artist_name);
        $("#twitter").attr("href", artist.artist_twitter_url);

        artistId = artist.artist_id;
        $.ajax({
          url: '/php/searchAlbum.php?artistId=' + artistId,
          method: 'GET'
        })
        .done(function(response) {
          $('#discography').html(""),
          response = JSON.parse(response);
          albums = response.message.body.album_list;
          console.log('these are albums');
          console.log(albums);

          for (var i = 0; i < albums.length; i++) {
            albums[i]

            $('#discography').append("<tr><td>" + albums[i].album.album_name + "</td><td>" + albums[i].album.album_rating + "</td><td>" + albums[i].album.album_track_count + "</td><td>" + albums[i].album.album_release_date + "</td></tr>")

          }
        });
      });
    });


    </script>
</body>

</html>
