<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('jetete',function(){
    return true;
});

Broadcast::channel('ranking-channel',function(){
   return true;
});

