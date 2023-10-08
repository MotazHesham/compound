<?php

function getPieceType($type){
    return trans('admins.Pieces');
}

/**
 * @param $quantity
 * @param $piece
 * @param $storeType
 */
function addQuantityToPiece($quantity,$piece,$storeType)
{
    if ($storeType == 1)
        $piece->newStore += $quantity;
    if ($storeType == 2)
        $piece->usedStore += $quantity;
    if ($storeType == 3)
        $piece->damgedStore += $quantity;
    $piece->quantity += $quantity;
    $piece->save();
}

