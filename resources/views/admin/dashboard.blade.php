<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if($movies)
        <h3 class="text-center mt-2 mb-3">Here's your favourite movies.</h3>
        <section class="tiles">
            @foreach($movies as $movie)
            <div class="image text-center">
                <div class="favourite" data-id="{{ $movie->movie_id }}"><i class="fas fa-heart"></i></div>
                <img src="https://image.tmdb.org/t/p/original/{{ $movie->poster }}" class="show-movie" alt="{{ $movie->title }}" data-id="{{ $movie->movie_id }}" />
                <h5>{{ $movie->title }}</h5>
                <h6>{{ \Carbon\Carbon::parse($movie->release_date)->format('jS M Y') }}</h6>
            </div>
            @endforeach
        </section>

        <div class="d-flex justify-content-center links">
            {!! $movies->links() !!}
        </div>
        @include('modals.showmovie')
        @include('modals.resultmsg')
    @else
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You do not have any favourites yet
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
