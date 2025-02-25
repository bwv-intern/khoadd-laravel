<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Todo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected function casts() {
        return [
            'updated_at' => 'date',
        ];
    }

    protected function freshness(): Attribute {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $current_dt = new DateTime();
                $elapsed_time = $this->updated_at->diff()->days;
                if ($elapsed_time < 2) {
                    return Freshness::New->value;
                }
                if ($elapsed_time < 5) {
                    return Freshness::Stale->value;
                }

                return Freshness::Old->value;
            },
        );
    }
}

enum Freshness: string
{
    case New = 'new';
    case Stale = 'stale';
    case Old = 'old';
}
