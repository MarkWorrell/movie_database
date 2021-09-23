<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Contact;
use App\Models\Movie;

use App\Mail\AddContactEmail;
use App\Mail\AdminContactEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    private $apikey;
    private $url;
    private $numberPages;
    private $numberMovies;
    private $paginate;

    public function __construct()
    {
        $config = Config::all();

        $this->numberPages = $config[0]->value;
        $this->numberMovies = $config[1]->value;
        $this->paginate = $config[2]->value;
        $this->url = $config[3]->value;
        $this->apikey = $config[4]->value;
        
        $movies = [];

        for($x = 1; $x<=$this->numberPages; $x++){
            $movies[] = self::getMovies($x, $this->apikey);
        }

        if($movies){
            \DB::table('movies')->truncate();

            foreach($movies as $movie){
                $this->insertArrayData($movie);
            }
        }
    }

    public function index()
    {
        $favourites = false;
        $value = \Cookie::get('aglet_movie_database');

        if($value){
            $favourites = explode('::', $value);
        }

        $movies = Movie::where('id', '<', $this->numberMovies)->paginate($this->paginate);

        return view('home.index', ['movies' => $movies, 'favourites' => $favourites]);
    }

    public function contactUs(Request $request)
    {
        if ($request->ajax())
        {
            $result = false;

            $validated = \Validator::make($request->all(), [
                'name' => 'required|max:255',
                'cell' => 'required|numeric',
                'email' => 'required|email',
                'social_media' => 'required',
                'message' => 'required'
            ]);

            if ($validated->passes()) {
                Contact::addContact($request->except('_token'));

                Mail::to($request->email)
                ->send(new AddContactEmail(['contact' => $request->except('_token')]));
                
                Mail::to('mark@kccs.co.za')
                ->send(new AdminContactEmail(['contact' => $request->except('_token')]));

                $result = true;
    
                return response()->json(['result' => $result]); 
            }

            return response()->json(['result' => $result, 'validated' => $validated]);  
        }
    }

    public function setFavourite(Request $request)
    {
        if ($request->ajax())
        {
            $value = \Cookie::get('aglet_movie_database');

            if($value){
                if(strstr($value, $request->id)){
                    $value = str_replace(['::'.$request->id, $request->id.'::', $request->id], '', $value);
                    $update = false;
                }
                elseif(!strstr($value, $request->id)){
                    $value .= '::'.$request->id;
                    $update = true;
                }
    
                \Cookie::queue('aglet_movie_database', $value, 2147483647);
            }
            else{
                \Cookie::queue('aglet_movie_database', $request->id, 2147483647);
            }

            return response()->json(['result' => true, 'cookie' => $value, 'update' => $update]);
        }
    }

    public function getMovie(Request $request)
    {
        if ($request->ajax())
        {
            $client = new Client();
            $response = $client->request('GET', $this->url.$request->id, [
                'headers' => [
                    'Authorization' => 'Bearer '.$this->apikey,
                    'Content-Type' => 'application/json;charset=utf-8'
                ]
            ]);
            
            return response()->json(json_decode($response->getBody()));
        }
    }

    public function getMovies($index)
    {
        $client = new Client();
        $response = $client->request('GET', $this->url.'/popular?page='.$index, [
            'headers' => [
                'Authorization' => 'Bearer '.$this->apikey,
                'Content-Type' => 'application/json;charset=utf-8'
            ]
        ]);

        $movies = json_decode($response->getBody());

        return $movies->results;
    }

    public static function insertArrayData($movies)
    {
        foreach($movies as $key => $movie){
            Movie::addMovie($movie);
        }
    }
}
