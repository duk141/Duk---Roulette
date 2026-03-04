<?php
header('Content-Type: application/json');

$source = isset($_GET['source']) ? $_GET['source'] : '';

if ($source === 'luckywin') {
    // Fetch data from Luckywin API
    $apiUrl = 'https://okluck-preuxct.onrender.com/api/taixiu/Lottery';
    $data = json_decode(file_get_contents($apiUrl), true);
    
    // Format the response
    $response = [
        'id' => $data['id'] ?? 'binhtool90',
        'Phien' => $data['Phien'] ?? '0',
        'Xuc_xac_1' => $data['Xuc_xac_1'] ?? 0,
        'Xuc_xac_2' => $data['Xuc_xac_2'] ?? 0,
        'Xuc_xac_3' => $data['Xuc_xac_3'] ?? 0,
        'Tong' => $data['Tong'] ?? 0,
        'Ket_qua' => $data['Ket_qua'] ?? 'Xỉu',
        'Pattern' => $data['Pattern'] ?? '',
        'Du_doan' => $data['Du_doan'] ?? 'Chưa đủ dữ liệu',
        'Do_tin_cay' => $data['Do_tin_cay'] ?? '0%'
    ];
    
    echo json_encode($response);
} elseif ($source === 'sumclub') {
    // Fetch data from SUMCLUB API
    $apiUrl = 'https://cailonma-sumcc.onrender.com/api/taixiu/lucky';
    $data = json_decode(file_get_contents($apiUrl), true);
    
    // Format the response
    $response = [
        'id' => $data['id'] ?? 'binhtool90',
        'Phien' => $data['Phien'] ?? 0,
        'Xuc_xac_1' => $data['Xuc_xac_1'] ?? 0,
        'Xuc_xac_2' => $data['Xuc_xac_2'] ?? 0,
        'Xuc_xac_3' => $data['Xuc_xac_3'] ?? 0,
        'Tong' => $data['Tong'] ?? 0,
        'Ket_qua' => $data['Ket_qua'] ?? 'Xỉu',
        'Pattern' => $data['Pattern'] ?? '',
        'Du_doan' => $data['Du_doan'] ?? 'Tài',
        'MD5' => $data['MD5'] ?? ''
    ];
    
    echo json_encode($response);
} elseif ($source === 'xd88') {
    // Fetch data from XD88 API
    $apiUrl = 'https://d-predict.onrender.com/api/taixiu';
    $data = json_decode(file_get_contents($apiUrl), true);
    
    // Format the response
    $response = [
        'id' => $data['id'] ?? 'binhtool90',
        'Phien' => $data['Phien'] ?? 0,
        'Xuc_xac_1' => $data['Xuc_xac_1'] ?? 0,
        'Xuc_xac_2' => $data['Xuc_xac_2'] ?? 0,
        'Xuc_xac_3' => $data['Xuc_xac_3'] ?? 0,
        'Tong' => $data['Tong'] ?? 0,
        'Ket_qua' => $data['Ket_qua'] ?? 'Xỉu',
        'Pattern' => $data['Pattern'] ?? '',
        'Du_doan' => $data['Du_doan'] ?? 'Xỉu'
    ];
    
    echo json_encode($response);
} else {
    // Invalid source
    echo json_encode(['error' => 'Invalid source parameter']);
}
?>