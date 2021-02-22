<?php

require_once __DIR__ . "/../config/parameters.dist.php";

// Création de la connexion à la base de données
try {
    $connection = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASS, [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4', lc_time_names = 'fr_FR'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
} catch (PDOException $exception) {
    echo "Erreur de connexion à la base de données";
    exit;
}

// Charger les fichiers du dossier entity
foreach (glob(__DIR__ . "/entity/*.php") as $filepath) {
    require_once $filepath;
}

/**
 * Récupérer l'ensemble des ligne d'un table
 * @param string $table Nom de la table
 * @param array $conditions Liste des conditions dans la clause WHERE
 * @param int $limit Nombre de ligne à retourner
 * @return array Liste des données retournées
 */

function getAllRows(string $table, array $conditions = [], int $limit = 0): array
{
    global $connection;

    // Stock la requête SQL dans une variable
    $query = "SELECT * FROM $table";

    //["project_id" => 2, "date_start" => "2019-06-15"]
    $query .= " WHERE 1 = 1";
    foreach ($conditions as $key => $value) {
        $query .= " AND $key = :$key";
    }

    if ($limit > 0) {
        $query = $query . " LIMIT $limit";
    }

    // Préparer la requête SQL
    $stmt = $connection->prepare($query);
    foreach ($conditions as $key => $value) {
        $stmt->bindParam(":$key", $value);
    }
    $stmt->execute(); // Executer la requête

    // Récupérer l'ensemble des résultats de la requête
    return $stmt->fetchAll();
}

/**
 * Récupérer une ligne d'une table
 * @param string $table Nom de la table
 * @param int $id L'identifiant de la ligne
 * @return array    La ligne retournée
 */
function getOneRow(string $table, int $id): array
{
    global $connection;

    $query = "SELECT * FROM $table WHERE id = :id";

    // Préparer la requête SQL
    $stmt = $connection->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute(); // Executer la requête

    // Récupérer l'ensemble des résultats de la requête
    return $stmt->fetch();
}

/**
 * Supprimer une ligne d'un table
 * @param string $table Nom de la table
 * @param int $id L'identifiant de la table
 * @return ?int Null ou code erreur
 */
function deleteRow(string $table, int $id): ?int
{
    global $connection;

    $query = "DELETE FROM $table WHERE id = :id";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":id", $id);

    try {
        $stmt->execute();
    } catch (PDOException $exception) {
        return $exception->getCode();
    }
    return null;
}


