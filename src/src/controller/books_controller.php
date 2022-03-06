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
