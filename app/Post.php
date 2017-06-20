<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

  // Hace referencia a la tabla que esta Class va a usar
  protected $table = 'posts';

  protected $fillable = ['title', 'description', 'url'];
}
