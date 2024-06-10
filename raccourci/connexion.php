<?php
// Informations de connexion à la base de données
$host = 'localhost';
$dbname = 'taskmanager';
$username = 'root';
$password = '';

try {
    // Création de l'objet PDO pour la connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

} catch (PDOException $e) {
    // Si une erreur survient, un message d'erreur est affiché
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}