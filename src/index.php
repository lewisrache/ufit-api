<?php
// TODO - auth
// also what if endpoint doesn't exist?
$endpoint = null;
if (isset($_GET['endpoint'])) {
    $endpoint = $_GET['endpoint'];
}

if (isset($_GET['q'])) {
    $parts = explode('/', $_GET['q']);
    if ($parts[1] === "api") {
        $endpoint = $parts[2] ?? null;
    }
}

switch ($endpoint) {
    case "user":
        echo "I see you'd like a user.<br>";
        break;
    default:
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
        exit();
}
