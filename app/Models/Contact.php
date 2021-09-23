<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public static function addContact($request)
    {
        $contact = new self();

        $contact->name = $request['name'];
        $contact->cell = $request['cell'];
        $contact->email = $request['email'];
        $contact->social_media = $request['social_media'];
        $contact->message = $request['message'];

        $contact->save();
    }
}
