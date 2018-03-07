@extends('master')

@section('title')
    1 Stop Music
@endsection

@section('content')

  <!-- Header Jumbotron -->
  <section id="top" class="jumbotron jumbotron-fluid">
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

@endsection
