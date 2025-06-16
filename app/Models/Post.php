<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [ //ここ追加
        'user_id',
        'post',
    ];


    // 中間テーブル使ったリレーション
    public function users()
    {
        // 関連するモデルクラス、中間テーブル名、現在のモデルの外部キー、関連するモデルの外部キー
        // return $this->belongsToMany(User::class, 'follow', 'id', 'id');
        return $this->belongsTo(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
