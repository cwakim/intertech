<?php
namespace App\Neo4j;

use Vinelab\NeoEloquent\Eloquent\Model as NeoEloquentModel;
use Vinelab\NeoEloquent\Eloquent\SoftDeletes;

class Sentiment extends NeoEloquentModel
{
    use SoftDeletes;
    protected $connection = 'neo4j';

    protected $fillable = ['post_id', 'body', 'score', 'magnitude'];

    public function getConnectionName()
    {
        return 'neo4j';
    }
}
