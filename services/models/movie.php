<?php
 require_once 'detail.php';

class movie
{
    public $id;
    public $title;
    public $overview;
    public $poster_path;
    public $backdrop_path;
    public $release_date;
    public $popularity;
    public array $genres;
    public MovieDetail $detail;

    public function __construct($id) {

        $apiUrl = "https://api.themoviedb.org/3/movie/$id?api_key=5596f947d757674db65b85089477fca7";
        $movieData = json_decode(file_get_contents($apiUrl), true);


        $genreNames = [];
        foreach ($movieData['genres'] as $genre) {
            array_push($genreNames,$genre['name']);
        }



        $this->id = $movieData['id'];
        $this->title = $movieData['title'];
        $this->overview = $movieData['overview'];
        $this->poster_path = $movieData['poster_path'];
        $this->backdrop_path = $movieData['backdrop_path'];
        $this->release_date = $movieData['release_date'];
        $this->genres = $genreNames;
        $this->popularity = $movieData['popularity'];
        $this->detail = new MovieDetail($this->id);
    }

}