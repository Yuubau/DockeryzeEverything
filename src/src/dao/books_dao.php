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

function insertBook($isbn, $title,$author,$overview,$read_count){
    $sql = "INSERT INTO book (isbn,title,author,overview,read_count) VALUES (?,?,?,?,?)";
    $params = [$isbn,$title,$author,$overview,$read_count];

    $pdo = getPdo();
    return insert($pdo, $sql, $params);
}

function deleteBook($isbn){
    $sql = "DELETE FROM book WHERE isbn = " . $isbn;

    $pdo = getPdo();
    return delete($pdo ,$sql);
}

function patchBook($book_isbn,$isbn, $title,$author,$overview,$read_count){
    $params = [$isbn, $title,$author,$overview,$read_count];
    $sql = "UPDATE book SET isbn=?, title=?,author=?,overview=?,read_count=? WHERE isbn=".$book_isbn;
    $pdo = getPdo();
    return update($pdo, $sql, $params);
}

