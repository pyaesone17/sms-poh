<?php 

if (! function_exists('send_smspoh')) {
    function send_smspoh($to, $message, $test=false, $callback=null)
    {
        $smsPoh = app()->make(\pyaesone17\SmsPoh\SmsPoh::class);
        return $smsPoh->send($to, $message, $test, $callback);
    }
}

if (! function_exists('fetch_smspoh')) {
    function fetch_smspoh($page=1)
    {
        $smsPoh = app()->make(\pyaesone17\SmsPoh\SmsPoh::class);
        return $smsPoh->fetch($page);
    }
}