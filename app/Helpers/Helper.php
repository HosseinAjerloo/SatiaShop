<?php

use \Illuminate\Support\Facades\Route;

function numberFormat($number)
{
    return number_format($number, 0, "/", ",");
}

function getRoutNameWithUri($path = null)
{
    $path = $path ? trim($path, '/') : (request()->headers->get('referer') ? trim(request()->headers->get('referer'), '/') : '/');
    $path = parse_url($path, PHP_URL_PATH);
    $allGetRoutes = Route::getRoutes()->get('GET');
    if (isset($allGetRoutes[trim($path, '/')])) {
        $route = $allGetRoutes[trim($path, '/')];
        return $route->action['as'];
    }
    return null;
}

function changeFormatNumberToDate($date)
{
    return substr($date, 0, 10);
}

function separationOfArraysFromText($value)
{
    $value = array_filter($value, function ($item) use ($value) {
        if (is_array($item)) {
            return $item;
        }
    });
    return $value;
}

function getGrandParentَAll($product)
{
    $category = $product->category;
    if ($category->category_id) {
        $name='';
        while ($category->parent)
        {
            $category=$category->parent;
            $name=$category->removeUnderLine;
        }
        return  $name;
    } else {
        return $category->removeUnderLine;
    }
}
function roundNumber($number){
    return floor($number / 1000) * 1000;
}
