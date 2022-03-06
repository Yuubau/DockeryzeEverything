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
