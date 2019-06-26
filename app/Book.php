<?php

namespace App;

use App\Category;
use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use ElasticquentTrait;
    
    protected $guarded = [];

    protected $mappingProperties = [
        'title' => [
            'type' => 'text',
            "analyzer" => "standard",
        ],
        'author' => [
            'type' => 'text',
            "analyzer" => "standard",
        ],
        'keywords' => [
            'type' => 'keyword',
            "analyzer" => "standard",
        ],
        'publication_year' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
