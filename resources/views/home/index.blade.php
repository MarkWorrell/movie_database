@extends('layouts.home')

@section('content')
    <div class="header">
        <div class="row">
            <div class="col-md-10">
                <div class="inner">
                    <div class="header-text">Aglet Movie Database</div>
                    <h1>Totally awesome movies to discover. Explore now.</h1>
                </div>
            </div>
            <div class="col-md-2 header-links text-center">
                <a href="#contact-us" style="color: white">Contact Us</a> | 
                <a href="/login" style="color: white">Login</a>
            </div>
        </div>
    </div>

    @if($movies)
        <h3 class="text-center pb-3">Here's our pick of the best releases we're sure will keep you entertained.</h3>
        <section class="tiles">
            @foreach($movies as $movie)
            <div class="image text-center">
                <div class="{{ in_array($movie->movie_id, $favourites) ? 'favourite-set' : 'favourite' }}" id="{{ $movie->movie_id }}" data-id="{{ $movie->movie_id }}"><i class="fas fa-heart"></i></div>
                <img src="https://image.tmdb.org/t/p/original/{{ $movie->poster }}" class="show-movie" alt="{{ $movie->title }}" data-id="{{ $movie->movie_id }}" />
                <h5>{{ $movie->title }}</h5>
                <h6>{{ \Carbon\Carbon::parse($movie->release_date)->format('jS M Y') }}</h6>
            </div>
            @endforeach
        </section>
    @endif

    <div class="d-flex justify-content-center links">
        {!! $movies->links() !!}
    </div>

    <footer id="footer">
        <div class="inner">
            <section>
                <h2 id="contact-us">Get in touch</h2>
                <form id="form-contact-us" name="form-contact-us" method="POST">
                    {{ csrf_field() }}
                    <div class="fields">
                        <div class="field third">
                            <input type="text" name="name" id="name" placeholder="Full Name" required>
                        </div>
                        <div class="field third">
                            <input type="text" name="cell" id="cell" placeholder="Cell Number" required>
                        </div>
                        <div class="field third">
                            <input type="email" name="email" id="email" placeholder="Email" required>
                        </div>
                        <div class="field">
                            <textarea name="social_media" id="social_media" placeholder="Social Media Links" required></textarea>
                        </div>
                        <div class="field">
                            <textarea name="message" id="message" placeholder="Message" required></textarea>
                        </div>
                    </div>

                    <div class="alert alert-success" id="alert-success" style="display: none;">Your message has been sent and we will contact you very soon</div>
                    <div class="alert alert-danger" id="alert-error" style="display: none;">Please complete all of the form</div>
                        
                    <button class="btn btn-success" type="submit">Submit</button>
                </form>
            </section>
            <ul class="copyright">
                <li>&copy; Aglet Movie Database. All rights reserved</li><li>Design: <a href="https://aglet.co.za/" target="_blank">Aglet</a></li>
            </ul>
        </div>
    </footer>

    @include('modals.showmovie')
    @include('modals.resultmsg')
@endsection