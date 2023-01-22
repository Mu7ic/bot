<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    const HELLO = 'HELLO';
    const AUTH = 'AUTH';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'text'
    ];

    /**
     * Выборка сообщений
     *
     * @param $type
     * @return string
     */
    public static function getMessage($type): string
    {
        $message = self::query()->where('type', $type)->pluck('text')->toArray();
        return $message[0];
    }
}
