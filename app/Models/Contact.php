<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    //性別のスコープ
    public function scopegender($query,$keyword){
        if($keyword == 0){
            return;
        }
        return $query->where('gender', $keyword);
    }

    //名前のスコープ
    public function scopename($query,$keyword){
        return $query->where('fullname', 'LIKE', '%'.$keyword.'%');
    }

    //メールアドレスのスコープ
    public function scopeemail($query,$keyword){
        return $query->where('email', 'LIKE', '%'.$keyword.'%');
    }

    //登録日のスコープ
    public function scopecreated_at($query,$startDate,$endDate){
        switch(true){
            case $startDate == null && $endDate == null:
                return;
            case !$startDate == null && !$endDate == null:
                return $query->wherebetween("created_at", [$startDate, $endDate]);
            case !$startDate == null && $endDate == null:
                return $query->where('created_at','>=',$startDate);
            case $startDate == null && !$endDate == null:
                return $query->where('created_at','<=',$endDate);;
        }
    }
}