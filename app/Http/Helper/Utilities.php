<?php

if(!function_exists('sendMail')){
    function sendMail($temp,$to,$subject,$data){
        \Mail::send($temp,$data->toArray(),function($msg) use ($to,$subject){
            $msg->subject($subject);
            $msg->to($to);
            $msg->from('hassanaboeata@gmail.com','DoNotReply');
        });
    }
}
