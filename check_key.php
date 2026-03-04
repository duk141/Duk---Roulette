<?php
header('Content-Type: application/json');

// Đọc danh sách key từ file
$keysFile = 'coconcac.json';
if (!file_exists($keysFile)) {
    file_put_contents($keysFile, json_encode([]));
}

$keysData = json_decode(file_get_contents($keysFile), true);
$enteredKey = $_POST['key'] ?? '';

$isValid = false;

// Kiểm tra key nhập vào
foreach ($keysData as $date => $keyInfo) {
    if ($keyInfo['key'] === $enteredKey) {
        // Kiểm tra nếu key có hạn sử dụng
        if (isset($keyInfo['expiry_date'])) {
            if (strtotime($keyInfo['expiry_date']) >= strtotime(date('Y-m-d'))) {
                $isValid = true;
                break;
            }
        } else {
            // Key không có hạn sử dụng
            $isValid = true;
            break;
        }
    }
}

echo json_encode(['valid' => $isValid]);
?>