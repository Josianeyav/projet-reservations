<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Show extends Model implements Feedable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug', 'title', 'poster_url', 'bookable', 'price'];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shows';

    /**
     * Gets the locations in the locality.
     */
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    /**
     * Gets the representations for the show
     */
    public function representations()
    {
        return $this->hasMany('App\Representation');
    }

    /**
     * Gets the representations for the show
     */
    public function collaborations()
    {
        return $this->hasMany('App\Collaboration');
    }

    /**
     * Gets the authors of the show
     * @return array
     */
    public function authors()
    {
        $authors = [];

        foreach ($this->collaborations as $collaboration) {
            $artisteType = $collaboration->artisteType()->first();
            $type = $artisteType->type()->first();
            if ($type->type == "scènographe") {
                array_push($authors, $artisteType->artist()->first());
            }
        }
        return collect($authors);
    }

    /**
     * @return array|\Spatie\Feed\FeedItem
     */
    public function toFeedItem()
    {
        $summary = "Le spectacle " . $this->title . " se passant à " . $this->location()->first()->designation;
        return FeedItem::create([
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $summary,
            'link' => route('shows.show', $this->id),
            'updated' => $this->updated_at,
            'author' => 'Projet Reservation',
        ]);
    }

    public static function getAllFeedItems()
    {
        return Show::all();
    }
}
