<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *      definition="Post",
 *      required={"title", "category_id", "creator_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int64"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *     @SWG\Property(
 *          property="category",
 *          description="category",
 *          type="category",
 *          ref="#/definitions/Category"
 *      ),
 *     @SWG\Property(
 *          property="author",
 *          description="author",
 *          type="string"
 *      ),
 *     @SWG\Property(
 *          property="content",
 *          description="content",
 *          type="string"
 *      ),
 *     @SWG\Property(
 *          property="creator_id",
 *          description="creator_id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Post extends Model
{
    protected $fillable = ['category_id', 'title', 'content'];

    protected $with = ['category', 'author'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    protected static function booted()
    {
        static::saving(function (Post $post) {
            $post->author()->associate(auth()->user());
        });
    }
}
