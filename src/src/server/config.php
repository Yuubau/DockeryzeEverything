<?php
function getPdo(){
    try {
        $pdo = new PDO('mysql:host=db;dbname=library;port=3306;', "root", "esgi");
        return $pdo;
    } catch (PDOException $e) {
        return null;
    }
}

function find($pdo, $request){
    $res =  $pdo->query($request, PDO::FETCH_ASSOC);
    return $res->fetchAll();
}

function insert($pdo, $request, $params){
    $res =  $pdo->prepare($request);
    return $res->execute($params);
}

function delete($pdo, $request){
    $res =  $pdo->prepare($request);
    return $res->execute();
}

function update($pdo, $request, $params){
    $res =  $pdo->prepare($request);
    return $res->execute($params);
}

?>