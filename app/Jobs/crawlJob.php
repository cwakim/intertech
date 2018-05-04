<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Domain as Domain;
use App\Post as Post;
use App\Page as Page;
use Goutte\Client as Goutte;

class crawlJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $page;
    protected $post;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $page = $this->page;
        $goutte = new Goutte();
        $goutte->setHeader('User-Agent', "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36");
        $pageId = $page->id;
        $crawler = $goutte->request('GET', $page->link);

        $crawler->filter($page->area)->each(function ($node) use ($pageId) {
           $goutte = new Goutte();
           $this->post = new Post();
           $this->post->body = '';
           $this->post->page_id = $pageId;

           $crawler = $goutte->request('GET', $node->link()->getUri());

           $crawler->filter('h1')->each(function ($node) {
             $this->post->title = $node->text();
           });

           $crawler->filter('.js-image-replace')->each(function ($node) {
             $this->post->image = $node->attr('src');
           });

           $crawler->filter('.story-body__inner p')->each(function ($node) {
             $this->post->body .= $node->html();
           });

           $this->post->save();
        });
    }
}
