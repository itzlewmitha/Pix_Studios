<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];
    $siteName = $_POST['siteName'];
    $targetDir = __DIR__ . "/sites/$userId/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // Create user folder if not exists
    }
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo json_encode([
            'success' => true,
            'message' => 'File uploaded successfully',
            'data' => [
                'url' => "https://{$_SERVER['HTTP_HOST']}/tools/hosting/view.php?site=$siteName",
                'path' => $targetFile
            ]
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to move uploaded file'
        ]);
    }
    exit;
} ?>
