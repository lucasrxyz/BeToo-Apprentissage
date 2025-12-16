<?php

require_once __DIR__ . '/../../models/DbContext.php';
require_once __DIR__ . '/queries.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>API</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        form { margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; }
        input, select { margin: 5px 0; }
        pre { background: #f4f4f4; padding: 10px; }
    </style>
</head>
<body>
<h1>TABLE <span style="color:#0000FE;font-weight:bold;">student</span></h1>




<!-- Tous les formulaires -->
<form method="post">
    <input type="hidden" name="action" value="getAll">
    <button type="submit">getAll()</button>
</form>

<form method="post">
    <input type="hidden" name="action" value="getAllByID">
    <input type="text" name="id" placeholder='$id' required>
    <button type="submit">getAllByID($id)</button>
</form>

<form method='post'>
    <input type='hidden' name='action' value='insertTest'>
    <button type='submit'>insertTest()</button>
</form>

<form method="post">
    <input type="hidden" name="action" value="deleteStudent">
    <input type="text" name="id" placeholder='$id' required>
    <button type="submit">deleteStudent($id)</button>
</form>

<form method="post">
    <input type="hidden" name="action" value="insertStudent">

    <input type="text" name="lastname" placeholder="lastname" required>
    <input type="text" name="firstname" placeholder="firstname" required>
    <input type="email" name="email" placeholder="email" required>
    <input type="password" name="password" placeholder="password" required>
    <input type="number" name="idOptions" placeholder="idOptions" required>

    <button type="submit">insertStudent($lastname, $firstname, $email, $password, $idOptions)</button>
</form>





<!-- Résultat -->
<?php 

if ($responseBody !== null): ?>
    <h3><span style="color:#0000FE"><b>JSON</b></span> response body</h3>
    <pre><?php
    echo json_encode($responseBody, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    ?></pre>

<?php endif; ?>