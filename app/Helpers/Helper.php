<?php
use \Illuminate\Support\Facades\Route;
function numberFormat($number)
{
    return number_format($number, 0, "/", ",");
}
function getRoutNameWithUri($path=null)
{
    $path=$path?trim($path,'/'):(request()->headers->get('referer')?trim(request()->headers->get('referer'),'/'):'/');
    $path= parse_url($path, PHP_URL_PATH);
    $allGetRoutes=Route::getRoutes()->get('GET');
    if (isset($allGetRoutes[trim($path,'/')]))
    {
        $route=$allGetRoutes[trim($path,'/')];
        return $route->action['as'];
    }
    return null;
}
function changeFormatNumberToDate($date)
{
      return substr($date,0,10);
}


