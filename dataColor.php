<?php

function get_user_color(string $username): string {
    $conn = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
    $statement = $conn->prepare("SELECT `Titkos` FROM `tabla` WHERE `Username` = ?");
    if(!$conn)
    {
        die("failed to connect!");
    }
    $statement->bind_param("s", $username);
    $statement->execute();
    $statement->bind_result($result_data);
    $statement->fetch();
    $conn->close();
    return $result_data;
}

function string_to_color(string $db_color): string {
    return match ($db_color) {
        'piros' => '#e89292',
        'zold' => '#b3f092',
        'sarga' => '#f0d492',
        'kek' => '#5f9ef5',
        'fekete' => '#3b3b3b',
        'feher' => '#f7f7f7',
        default => '#ffffff',
    };
}

?>