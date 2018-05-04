<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Domain as Domain;
use App\Post as Post;
use Google\Cloud\Language\LanguageClient;
use App\Neo4j\Sentiment as Sentiment;

class sentimentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $posts = Post::all();

        foreach($posts as $post)
        {
          $language = new LanguageClient([
              'projectId' => env('GOOGLE_PROJECT_ID')
          ]);

          $annotation = $language->analyzeSentiment($post->body);
          $sentiment = $annotation->sentiment();

          $sentimentModel = Sentiment::on('neo4j')->create(
            [
              'post_id' => $post->id,
              'body' => $post->body,
              'score' => $sentiment['score'],
              'magnitude' => $sentiment['magnitude']
            ]
          );
        }

    }
}
