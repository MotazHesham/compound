<?php

/**
 * @return string
 */
function get_baseUrl()
{
    return url('/');
}


/**
 * @return mixed
 */
function getLang(){
    return Request::segment(1);
}

/**
 * @return string
 */
function arabicSingleWords(){
    return getLang() =='ar' ? 'ال'  : '';
}