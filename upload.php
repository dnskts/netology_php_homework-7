<?php

if (empty($_POST['file_name'])) {
    header('Location: index.html');
    exit;
}

if (empty($_FILES['content']['tmp_name']) || $_FILES['content']['error'] !== UPLOAD_ERR_OK) {
    header('Location: index.html');
    exit;
}

$fileName = $_POST['file_name'];

$uploadDir = __DIR__ . '/upload';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$filePath = $uploadDir . '/' . $fileName;

if (move_uploaded_file($_FILES['content']['tmp_name'], $filePath)) {
    $fileSize = filesize($filePath);
    
    echo "Файл успешно загружен!<br>";
    echo "Полный путь: " . $filePath . "<br>";
    echo "Размер файла: " . $fileSize . " байт<br>";
} else {
    echo "Ошибка при сохранении файла.";
}
