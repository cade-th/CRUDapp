<?php

//I think I don't need this in here but apparently I don't for CORS
/*
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Max-Age: 86400");
*/
header('Content-Type: application/json');

//console errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//table
$host = 'db';
$db   = 'book_catalog';
$user = 'root';
$pass = 'password';
$charset = 'utf8mb4';

//sql setup
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);

//big switch statement for each operation Im so cool 
switch ($_SERVER['REQUEST_METHOD']) {
    //get action

    case 'GET':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            error_log("ID from GET request: " . $id); //debug log
            $stmt = $pdo->prepare('SELECT id, title, author, year_published, genre FROM book_catalog WHERE id = ?');
            $stmt->execute([$id]);
            $book = $stmt->fetch(PDO::FETCH_ASSOC);
            //cade put more error handling error handling will make you happy pls
            error_log("Query result: " . print_r($book, true)); //debug log
            if ($book) {
                echo json_encode(["book" => $book, "success" => true]);
            } else {
                echo json_encode(["message" => "Failed to fetch book frick you.", "success" => false]);
            }
        } else {
            $stmt = $pdo->query('SELECT id, title, author, year_published, genre FROM book_catalog');
            if ($stmt) {
                $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode(["books" => $books, "success" => true]);
            } else {
                echo json_encode(["message" => "Failed to fetch bookss your bad at coding cade ", "success" => false]);
            }
        }
        break; 

    //post action
    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true); //I'm not really sure why this works
        $sql = "INSERT INTO book_catalog (title, author, year_published, genre) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$input['title'], $input['author'], $input['year_published'], $input['genre']])) {
            echo json_encode(["message" => "Book created successfully but sql will fuck shit up probably.", "success" => true]);
        } else {
            echo json_encode(["message" => "Failed to create book.", "success" => false]);
        }
        break;        

    //put action
    case 'PUT':
        $input = json_decode(file_get_contents('php://input'), true);
        $sql = "UPDATE book_catalog SET title=?, author=?, year_published=?, genre=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$input['title'], $input['author'], $input['year_published'], $input['genre'], $_GET['id']])) {
            echo json_encode(["message" => "Book updated successfully maybe.", "success" => true]);
        } else {
            echo json_encode(["message" => "Failed to update book.", "success" => false]);
        }
        break;
        
    //delete action omfg this shit took so long why didn't I use laravel 
    case 'DELETE':
        $id = $_GET['id'];
        $sql = "DELETE FROM book_catalog WHERE id=?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$id])) {
            echo json_encode(["message" => "Book might have been deleted successfully  god .", "success" => true]);
        } else {
            echo json_encode(["message" => "Failed to delete book.", "success" => false]);
        }
        break;
        
}
?>
