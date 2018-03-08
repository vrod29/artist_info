@extends('master')

@section('title')
    1 Stop Music
@endsection

@section('content')

<style>

p, h1 {
    color: white;

}
</style>







<!-- Header Jumbotron -->
<section id="top" class="jumbotron jumbotron-fluid @if (empty($response)) fullscreen @endif">


        <div class="container">
            <div class="row"">
                <div class="col-6">
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <img src= "/images/NewSupermanPic.jpg" class="rounded-circle" width="450px" height="350px">
                        <h1 class="text-center">Javier Duarte</h1>
                </div>

                <div class="col-6">
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <img src="/images/VictorPic.png" class="rounded-circle" width="450px" height="350px">
                    <h1 class="text-center">Victor Rodriguez</h1>
                </div>
                <p>
                    We are Valley Tech Academy alumni's, eager and overly excited to work as a team and create challenging projects.

                </p>
            </div>
        </div>

</section>






@endsection
