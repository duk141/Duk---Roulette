<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$source = isset($_GET['source']) ? $_GET['source'] : '';

if ($source === 'hit') {
    // Fetch data from Hit Club API
    $hitApiUrl = 'https://okem-hitpre.onrender.com/api/taixiu';
    $hitData = @file_get_contents($hitApiUrl);
    
    if ($hitData === FALSE) {
        echo json_encode(['error' => 'Failed to fetch data from Hit Club API']);
        exit;
    }
    
    $hitData = json_decode($hitData, true);
    
    // Format the response
    $response = [
        'Phien' => $hitData['Phien'] ?? 0,
        'Xuc_xac_1' => $hitData['Xuc_xac_1'] ?? 0,
        'Xuc_xac_2' => $hitData['Xuc_xac_2'] ?? 0,
        'Xuc_xac_3' => $hitData['Xuc_xac_3'] ?? 0,
        'Tong' => $hitData['Tong'] ?? 0,
        'Ket_qua' => $hitData['Ket_qua'] ?? 'Xỉu',
        'du_doan' => $hitData['du_doan'] ?? 'Không rõ'
    ];
    
    echo json_encode($response);
} elseif ($source === 'b52') {
    // Fetch data from B52 API
    $b52ApiUrl = 'https://b52-predict.onrender.com/api/taixiu';
    $b52Data = @file_get_contents($b52ApiUrl);
    
    if ($b52Data === FALSE) {
        echo json_encode(['error' => 'Failed to fetch data from B52 API']);
        exit;
    }
    
    $b52Data = json_decode($b52Data, true);
    
    // Format the response
    $response = [
        'Phien' => $b52Data['Phien'] ?? 0,
        'Xuc_xac_1' => $b52Data['Xuc_xac_1'] ?? 0,
        'Xuc_xac_2' => $b52Data['Xuc_xac_2'] ?? 0,
        'Xuc_xac_3' => $b52Data['Xuc_xac_3'] ?? 0,
        'Tong' => $b52Data['Tong'] ?? 0,
        'Ket_qua' => $b52Data['Ket_qua'] ?? 'Xỉu',
        'Du_doan' => $b52Data['Du_doan'] ?? 'Không rõ',
        'Do_tin_cay' => $b52Data['Do_tin_cay'] ?? '--',
        'Streak' => $b52Data['Streak'] ?? '--'
    ];
    
    echo json_encode($response);
} else {
    // Invalid source
    echo json_encode(['error' => 'Invalid source parameter']);
}
?>