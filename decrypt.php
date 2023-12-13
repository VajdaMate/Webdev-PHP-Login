<?php

function fileToArray(string $file): array {
    $encryptedPass = fopen($file, 'rb');
    $fileSize = filesize($file);
    $contents = fread($encryptedPass, $fileSize);
    fclose($encryptedPass);

    $binArray = unpack(sprintf('C%d', $fileSize), $contents);
    $binArray = array_values($binArray);
    
    $binMatrix = array();
    $tempArray = array();
    foreach ($binArray as $byte) {
        if ($byte != 0x0A) {
            $tempArray[] = $byte;
        } else {
            $binMatrix[] = $tempArray;
            $tempArray = array();
        }
    }
    return $binMatrix;
}

function decrypt(array $input): string {
    $offSets = [5, -14, 31, -9, 3];
    $offsetIndex = 0;
    $decryptedLine = '';
    
    foreach ($input as $byte) {
        $decryptedLine = $decryptedLine . chr($byte - $offSets[$offsetIndex]);
        $offsetIndex += 1;
        $offsetIndex = $offsetIndex % count($offSets);
    }
    return $decryptedLine;
}

function get_users(): array {
    $binArray = fileToArray('password.txt');
    $users = array();
    foreach ($binArray as $encryptedLine) {
        $decryptedLine = decrypt($encryptedLine);
        $user = explode('*', $decryptedLine);
        $users[$user[0]] = $user[1];
    }
    return $users;
}

?>