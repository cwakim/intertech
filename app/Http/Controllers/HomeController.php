<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client as Goutte;
use App\Domain as Domain;
use App\Post as Post;
use Google\Cloud\Language\LanguageClient;
use App\Neo4j\Sentiment as Sentiment;

class HomeController extends Controller
{
    protected $post;
    public function Index()
    {
        return view('index');
    }

    public function Crawl()
    {
        $sentiments = Sentiment::all();
        $returnData = array();


        foreach($sentiments as $sentiment)
        {
            $post = Post::find($sentiment->post_id);
            $returnData[$sentiment->post_id] = array(
              'post_id' => $sentiment->post_id,
              'title' => $post->title,
              'body' => $post->body,
              'image' => $post->image,
              'score' => $sentiment->score,
              'magnitude' => $sentiment->magnitude
            );
        }

        $data = [
          "returnData" => $returnData
        ];
        return \View::make('index', $data);
    }
}
