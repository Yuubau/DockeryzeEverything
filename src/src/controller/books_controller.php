<?php

require_once(__DIR__."/../dao/books_dao.php");

function parse_get_request($uri) {
    if(count($uri) == 1){
        http_response_code(200);
        return findAllBooks();
    } else {
        $res = findBookByIsbn($uri[1]);
        if(count($res) == 0){
            http_response_code(404);
        } else {
            http_response_code(200);
        }
        return $res;
    }
}


function parse_post_request($uri) {
    $isbn;
    $title;
    $author;
    $overview;
    $read_count;

    $error = "";

    if(isset($_POST["isbn"]) && strlen($_POST["isbn"]) <= 13){
        $isbn = $_POST["isbn"];
    } else {
        $error .= "Invalid ISBN<BR>";
    }
    if(count(findBookByIsbn($isbn)) > 0){
        $error .= "ISBN already exists<BR>";
    }
    if(isset($_POST["title"]) && strlen($_POST["title"]) <= 200){
        $title = $_POST["title"];
    } else {
        $error .= "Invalid title<BR>";
    }
    if(isset($_POST["author"]) && strlen($_POST["author"]) <= 150){
        $author = $_POST["author"];
    } else {
        $error .= "Invalid author<BR>";
    }
    if(isset($_POST["overview"])){
        if(strlen($_POST["overview"]) <= 1500){
            $overview = $_POST["overview"];
        } else {
            $error .= "Invalid overview<BR>";
        }
    } else {
        $overview = "";
    }
    if(isset($_POST["read_count"])){
        $read_count = $_POST["read_count"];
    } else {
        $read_count = 1;
    }

    if($error === ""){
        $res = insertBook($isbn, $title, $author, $overview, $read_count);
        if($res){
            http_response_code(201);
            return findBookByIsbn($isbn);
        } else {
            http_response_code(422);
            return "An error has occured";
        }
    } else {
        http_response_code(422);
        return $error;
    }
}

function parse_delete_request($uri) {
    $isbn = $uri[1];

    $res = findBookByIsbn($isbn);
    if(count($res) < 1){
        http_response_code(404);
        return "ISBN does not exists";
    }

    $res = deleteBook($isbn);
    if($res){
        http_response_code(204);
        return;
    } else {
        http_response_code(422);
        return "An error has occured";
    }
}

function parse_patch_request($uri) {
    $isbn;
    $title;
    $author;
    $overview;
    $read_count;

    $error = "";

    $book = findBookByIsbn($uri[1]);
    if(count($book) < 1){
        $error .= "ISBN does not exists<BR>";
    } else {
        $book = $book[0];
    }

    if(isset($_PATCH["isbn"])){
        $isbn = $_PATCH["isbn"];
        if(strlen($_PATCH["isbn"]) <= 13){
            $error .= "Invalid ISBN<BR>";
        }
    } else {
        $isbn = $book["isbn"];
    }
    if(isset($_PATCH["title"])){
        $title = $_PATCH["title"];
        if(strlen($_PATCH["title"]) <= 200){
            $error .= "Invalid title<BR>";
        }
    } else {
        $title = $book["title"];
    }
    if(isset($_PATCH["author"])){
        $author = $_PATCH["author"];
        if(strlen($_PATCH["author"]) <= 150){
            $error .= "Invalid author<BR>";
        }
    } else {
        $author = $book["author"];
    }
    if(isset($_PATCH["overview"])){
        if(strlen($_PATCH["overview"]) <= 1500){
            $overview = $_PATCH["overview"];
        } else {
            $error .= "Invalid overview<BR>";
        }
    } else {
        $overview = $book["overview"];
    }
    if(isset($_PATCH["read_count"])){
        $read_count = $_PATCH["read_count"];
    } else {
        $read_count = $book["read_count"];
    }

    if($error === ""){
        $res = patchBook($uri[1],$isbn, $title, $author, $overview, $read_count);
        if($res){
            http_response_code(200);
            return findBookByIsbn($isbn);
        } else {
            http_response_code(422);
            return "An error has occured";
        }
    } else {
        http_response_code(422);
        return $error;
    }
}