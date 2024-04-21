<?php

namespace Azzarip\Keap\Tests\Classes;

use Azzarip\Keap\Traits\KeapTrait;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use KeapTrait;

    protected $guarded = '';

    public $timestamps = false;

    protected $table = 'contacts';
}
