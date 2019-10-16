<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable= ['title','body'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //mutator
    public function setTitleAttribute($value)
    {
        $this->attributes['title']= $value;
        $this->attributes['slug']=str_slug($value);
    }

    //accessor
    public function getUrlAttribute()
    {
        return route("questions.show",$this->id);
    }
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
     public function getStatusAttribute()
     {
         if($this->best_answer_id != NULL){
             return "answer-accepted";
         }
         elseif($this->answers > 0){
             return "answered";
         }
         else return "unanswered";
     }
}
