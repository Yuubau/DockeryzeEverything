<?php
require_once(__DIR__."/../server/config.php");

function findAllBooks(){
    $pdo = getPdo();
    $request = "SELECT * FROM book";
    return find($pdo, $request);
}

function findBookByIsbn($isbn){
    $pdo = getPdo();
    $request = "SELECT * FROM book WHERE isbn = " . strval($isbn);
    return find($pdo, $request);
}