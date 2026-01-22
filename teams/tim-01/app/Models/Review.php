<?php
class Review extends Model
{
    protected $fillable = [
        'destination_id',
        'rating',
        'comment'
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}

