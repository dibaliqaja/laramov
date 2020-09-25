<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ViewMovieTest extends TestCase
{
    /** @test */
    public function the_main_page_shows_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->fakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlayingMovies(),
            'https://api.themoviedb.org/3/genre/movie/list' => $this->fakeGenres(),
        ]);

        $response = $this->get(route('movies.index'));

        $response->assertSuccessful();
        $response->assertSee('Popular Movies');
        $response->assertSee('Fake Movie');
        $response->assertSee('Adventure, Drama, Mystery, Science Fiction, Thriller');
        $response->assertSee('Now Playing');
        $response->assertSee('Now Playing Fake Movie');
    }

    /** @test */
    public function the_movie_page_shows_the_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/*' => $this->fakeSingleMovie(),
        ]);

        $response = $this->get(route('movies.show', 12345));
        $response->assertSee('Mulan');
        $response->assertSee('Chris Bender');
        $response->assertSee('Producer');
        $response->assertSee('Liu Yifei');
    }

    /** @test */
    public function the_search_dropdown_works_correctly()
    {
        Http::fake([
            'https://api.themoviedb.org/3/search/movie?query=mulan' => $this->fakeSearchMovies(),
        ]);

        Livewire::test('search-dropdown')
            ->assertDontSee('mulan')
            ->set('search', 'mulan')
            ->assertSee('Mulan');
    }

    private function fakeSearchMovies()
    {
        return Http::response([
            'results' => [
                [
                    "popularity" => 406.677,
                    "vote_count" => 2607,
                    "video" => false,
                    "poster_path" => "/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg",
                    "id" => 419704,
                    "adult" => false,
                    "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                    "original_language" => "en",
                    "original_title" => "Mulan",
                    "genre_ids" => [
                        12,
                        18,
                        9648,
                        878,
                        53,
                    ],
                    "title" => "Mulan",
                    "vote_average" => 6,
                    "overview" => "Fake movie description. The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet earth.",
                    "release_date" => "2019-09-17",
                ]
            ]
        ], 200);
    }

    private function fakePopularMovies()
    {
        return Http::response([
                'results' => [
                    [
                        "popularity" => 406.677,
                        "vote_count" => 2607,
                        "video" => false,
                        "poster_path" => "/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg",
                        "id" => 419704,
                        "adult" => false,
                        "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                        "original_language" => "en",
                        "original_title" => "Fake Movie",
                        "genre_ids" => [
                            12,
                            18,
                            9648,
                            878,
                            53,
                        ],
                        "title" => "Fake Movie",
                        "vote_average" => 6,
                        "overview" => "Fake movie description. The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet earth.",
                        "release_date" => "2019-09-17",
                    ]
                ]
            ], 200);
    }

    private function fakeNowPlayingMovies()
    {
        return Http::response([
                'results' => [
                    [
                        "popularity" => 406.677,
                        "vote_count" => 2607,
                        "video" => false,
                        "poster_path" => "/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg",
                        "id" => 419704,
                        "adult" => false,
                        "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                        "original_language" => "en",
                        "original_title" => "Now Playing Fake Movie",
                        "genre_ids" => [
                            12,
                            18,
                            9648,
                            878,
                            53,
                        ],
                        "title" => "Now Playing Fake Movie",
                        "vote_average" => 6,
                        "overview" => "Now playing fake movie description. The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet earth.",
                        "release_date" => "2019-09-17",
                    ]
                ]
            ], 200);
    }

    public function fakeGenres()
    {
        return Http::response([
                'genres' => [
                    [
                      "id" => 28,
                      "name" => "Action"
                    ],
                    [
                      "id" => 12,
                      "name" => "Adventure"
                    ],
                    [
                      "id" => 16,
                      "name" => "Animation"
                    ],
                    [
                      "id" => 35,
                      "name" => "Comedy"
                    ],
                    [
                      "id" => 80,
                      "name" => "Crime"
                    ],
                    [
                      "id" => 99,
                      "name" => "Documentary"
                    ],
                    [
                      "id" => 18,
                      "name" => "Drama"
                    ],
                    [
                      "id" => 10751,
                      "name" => "Family"
                    ],
                    [
                      "id" => 14,
                      "name" => "Fantasy"
                    ],
                    [
                      "id" => 36,
                      "name" => "History"
                    ],
                    [
                      "id" => 27,
                      "name" => "Horror"
                    ],
                    [
                      "id" => 10402,
                      "name" => "Music"
                    ],
                    [
                      "id" => 9648,
                      "name" => "Mystery"
                    ],
                    [
                      "id" => 10749,
                      "name" => "Romance"
                    ],
                    [
                      "id" => 878,
                      "name" => "Science Fiction"
                    ],
                    [
                      "id" => 10770,
                      "name" => "TV Movie"
                    ],
                    [
                      "id" => 53,
                      "name" => "Thriller"
                    ],
                    [
                      "id" => 10752,
                      "name" => "War"
                    ],
                    [
                      "id" => 37,
                      "name" => "Western"
                    ],
                ]
            ], 200);
    }

    public function fakeSingleMovie()
    {
        return Http::response([
                "adult" => false,
                "backdrop_path" => "/zzWGRw277MNoCs3zhyG3YmYQsXv.jpg",
                "genres" => [
                    ["id" => 28, "name" => "Action"],
                    ["id" => 12, "name" => "Adventure"],
                    ["id" => 18, "name" => "Drama"],
                    ["id" => 14, "name" => "Fantasy"],
                ],
                "homepage" => "https://movies.disney.com/mulan-2020",
                "id" => 12345,
                "overview" => "When the Emperor of China issues a decree that one man per family must serve in the Imperial Chinese Army to defend the country from Huns, Hua Mulan, the eldest daughter of an honored warrior, steps in to take the place of her ailing father. She is spirited, determined and quick on her feet. Disguised as a man by the name of Hua Jun, she is tested every step of the way and must harness her innermost strength and embrace her true potential.",
                "poster_path" => "/aKx1ARwG55zZ0GpRvU2WrGrCG9o.jpg",
                "release_date" => "2020-09-10",
                "runtime" => 115,
                "title" => "Mulan",
                "vote_average" => 7.4,
                "credits" => [
                    "cast" => [
                        [
                            "cast_id" => 12,
                            "character" => "Hua Mulan",
                            "credit_id" => "5a1f27efc3a3680b930821c6",
                            "gender" => 1,
                            "id" => 122503,
                            "name" => "Liu Yifei",
                            "order" => 0,
                            "profile_path" => "/cL6JccAYqiZQEAIEFObEUC9LTt7.jpg"
                        ]
                    ],
                    "crew" => [
                        [
                            "credit_id" => "57f4a5dd9251411c7e00241d",
                            "department" => "Production",
                            "gender" => 2,
                            "id" => 298,
                            "job" => "Producer",
                            "name" => "Chris Bender",
                            "profile_path" => null
                        ]
                    ]
                ],
                "videos" => [
                    "results" => [
                        [
                            "id" => "5d221db394d8a87d3441b212",
                            "iso_639_1" => "en",
                            "iso_3166_1" => "US",
                            "key" => "01ON04GCwKs",
                            "name" => "Disney's Mulan - Official Teaser",
                            "site" => "YouTube",
                            "size" => 1080,
                            "type" => "Teaser"
                        ]
                    ]
                ],
                "images" => [
                    "backdrops" => [
                        [
                            "aspect_ratio" => 1.778656126482213,
                            "file_path" => "/zzWGRw277MNoCs3zhyG3YmYQsXv.jpg",
                            "height" => 1771,
                            "iso_639_1" => null,
                            "vote_average" => 5.454,
                            "vote_count" => 3,
                            "width" => 3150
                        ]
                    ],
                ]
            ], 200);
    }

}
