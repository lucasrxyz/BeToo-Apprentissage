<?php

$responseBody = null;

/**
* TOUT LES ETUDIANTS
*/
function getAll() {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT
            a.id AS student_id,
            a.lastname,
            a.firstname,
            a.email,
            a.password,
            a.date_signup,
            a.FK_idOptions,

            b.id AS average_id,
            b.average,

            c.id AS note_id,
            c.note
        FROM student a
        LEFT JOIN average b ON b.FK_idStudent = a.id
        LEFT JOIN notes c ON c.FK_idStudent = a.id
    ");
    $stmt->execute();
    return $stmt->fetchAll();
}

/**
* TOUT LES ETUDIANTS PAR ID
* @param id INT
*/
function getAllByID($id) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT
            a.id AS student_id,
            a.lastname,
            a.firstname,
            a.email,
            a.password,
            a.date_signup,
            a.FK_idOptions,

            b.id AS average_id,
            b.average,

            c.id AS note_id,
            c.note
        FROM student a
        LEFT JOIN average b ON b.FK_idStudent = a.id
        LEFT JOIN notes c ON c.FK_idStudent = a.id
        WHERE a.id = :id
    ");
    $stmt->execute([":id" => $id]);
    return $stmt->fetch();
}

/**
 * INSERER ETUDIANT
 * @param lastname string
 * @param firstname string
 * @param email string
 * @param password string
 * @param idOptions int
 */
function insertStudent($lastname, $firstname, $email, $password, $idOptions) {
    global $pdo;

    $password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        INSERT INTO student (lastname, firstname, email, date_signup, password, FK_idOptions)
        VALUES (:lastname, :firstname, :email, NOW(), :password, :idOptions)
    ");

    $stmt->execute([
        ":lastname" => $lastname,
        ":firstname" => $firstname,
        ":email" => $email,
        ":password" => $password,
        ":idOptions" => $idOptions
    ]);

    return $pdo->lastInsertId();
}

/**
* INSERT VALEUR DE TEST
*/
function insertTest() {
    $result = insertStudent('insertTestLastName', 'insertTestFirstName', 'test.lucas@test.com', 'France2025!!!', 1);
    return $result;
}

/**
* DELETE UN ETUDIANT
* @param id int 
*/

function deleteStudent($id) {
    global $pdo;

    $stmt = $pdo->prepare("
        DELETE FROM student WHERE id = :id
    ");

    $stmt->execute([":id" => $id]);

    return "Successfully deleted student with ID ".$id;
}


// IF DU SERVEUR
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    if ($_POST['action'] === 'getAll') {
        $responseBody = getAll();
    }

    if ($_POST['action'] === 'getAllByID' && !empty($_POST['id'])) {
        $responseBody = getAllByID($_POST['id']);
    }

    if ($_POST['action'] === 'deleteStudent' && !empty($_POST['id'])) {
        $responseBody = deleteStudent($_POST['id']);
    }
    
    if (
        $_POST['action'] === 'insertStudent' &&
        !empty($_POST['lastname']) &&
        !empty($_POST['firstname']) &&
        !empty($_POST['email']) &&
        !empty($_POST['password']) &&
        !empty($_POST['idOptions'])
    ) {
        $responseBody = [
            "inserted_id" => insertStudent(
                $_POST['lastname'],
                $_POST['firstname'],
                $_POST['email'],
                $_POST['password'],
                $_POST['idOptions']
            )
        ];
    }

    if ($_POST['action'] === 'insertTest') {
    $responseBody = insertTest();
}
}


?>