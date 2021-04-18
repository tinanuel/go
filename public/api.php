<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
require __DIR__ . '/../vendor/autoload.php';

class NotesDB extends SQLite3 {
function __construct() {
$this->open('../notes.db');
}
}
$db = new NotesDB();

$app = AppFactory::create();

$app->get(
'/api/notes',
function (Request $request, Response $response, array $args) use($db) {
$notes = [];
$result = $db->query('select * from note');
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
$notes[] = $row;
}
$payload = json_encode($notes, JSON_UNESCAPED_UNICODE);
$response->getBody()->write($payload);
return $response->withHeader('Content-Type', 'application/json');
}
);

$app->get(
'/api/notes/{noteId}',
function (Request $request, Response $response, array $args) use($db) {
$note = $db->query("select * from note where id = $args[noteId]")->fetchArray(SQLITE3_ASSOC);
if ($note) {
$response->getBody()->write(json_encode($note, JSON_UNESCAPED_UNICODE));
return $response->withHeader('Content-Type', 'application/json');
}
$response->getBody()->write(json_encode(['message' => 'Nie ma takiej notatki']));
return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
}
);

$app->post(
 '/api/notes',
 function (Request $request, Response $response, array $args) use($db) {
 $note = json_decode($request->getBody(), true);
 $date = date('Y-m-d');
 $db->query("insert into note (name, date) values ('$note[name]', '$date')");
 $note['id'] = $db->lastInsertRowId();
 $note['date'] = $date;
 $response->getBody()->write(json_encode($note));
 return $response
->withStatus(201)
->withHeader('Content-Type', 'application/json');
 }
);

$app->run();