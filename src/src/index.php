<?php
require_once(__DIR__."/controller/books_controller.php");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

if($uri[2] != "books"){
    http_response_code(404);
    echo "Unknown";
    return;
}
array_shift($uri);array_shift($uri);

switch ($_SERVER['REQUEST_METHOD']) {
    case "GET":
        echo json_encode(parse_get_request($uri));
        break;
    case "POST":
        echo json_encode(parse_post_request($uri));
        break;
    case "DELETE":
        echo json_encode(parse_delete_request($uri));
        break;
    case "PATCH":
        echo json_encode(parse_patch_request($uri));
        break;
    default:
        echo "Unknown";
        break;
}

?>