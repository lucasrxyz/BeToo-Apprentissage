<?php

require_once __DIR__ . '/../Models/DbContext.php';

//
// TOUT LES ETUDIANTS
//
function getAll() {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT a.*, b.*, c.*
        FROM student a
        LEFT JOIN average b ON b.FK_idStudent = a.id
        LEFT JOIN notes c ON c.FK_idStudent = a.id
    ");
    $stmt->execute();
    return $stmt->fetch();
}
?>