<?php

function getAllMembersByProject(int $id): array
{

    global $connection;

    $query = "
        SELECT *
        FROM member
        LEFT JOIN  project_has_member phm ON member.id = phm.member_id
        WHERE phm.project_id = :id
        ";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute(); // Executer la requête

    return $stmt->fetchAll();
}

