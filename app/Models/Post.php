<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable=[
        'titulo',
        'descripcion',
        'imagen',
        'user_id'    ];

        //un post pertenece a un usuario
        public function user(){
            return $this->belongsTo(User::class)->select(['name','username']);
        }
        //un post puede tener muchos comentarios
        public function comentarios(){
            return $this->hasMany(Comentario::class);
        }
        public function likes(){
            return $this->hasMany(Like::class);
        }
        public function checkLike(User $user){
            return $this->likes->contains('user_id', $user->id);
            
        }
}
