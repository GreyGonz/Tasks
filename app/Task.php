<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'description', 'completed', 'user_id'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function toArray()
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'completed' => (boolean) $this->completed,
      'description' => $this->description,
      'user_id' => $this->user->id,
      'created_at' => $this->created_at->toDateTimeString(),
      'updated_at' => $this->updated_at->toDateTimeString(),
    ];
  }
}
