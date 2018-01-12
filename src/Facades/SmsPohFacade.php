<?php 

namespace pyaesone17\SmsPoh\Facades;

use Illuminate\Support\Facades\Facade;

class SmsPohFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() 
    { 
        return app()->make(\pyaesone17\SmsPoh\SmsPoh::class); 
    }
}