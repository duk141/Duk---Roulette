<?php
header('Content-Type: application/json');

$source = isset($_GET['source']) ? $_GET['source'] : '';

if ($source === 'sunwin') {
    // Fetch data from Sunwin Sicbo API
    $apiUrl = 'https://sucsun-predict.onrender.com/predict';
    $data = json_decode(file_get_contents($apiUrl), true);
    
    // Format the response
    $response = [
        'Id' => $data['Id'] ?? 'binhtool90',
        'Phien' => $data['Phien'] ?? 0,
        'Xuc_xac_1' => $data['Xuc_xac_1'] ?? 0,
        'Xuc_xac_2' => $data['Xuc_xac_2'] ?? 0,
        'Xuc_xac_3' => $data['Xuc_xac_3'] ?? 0,
        'Tong' => $data['Tong'] ?? 0,
        'Ket_qua' => $data['Ket_qua'] ?? 'Xỉu',
        'phien_hien_tai' => $data['phien_hien_tai'] ?? '#0',
        'du_doan' => $data['du_doan'] ?? 'Tài',
        'dudoan_vi' => $data['dudoan_vi'] ?? '0,0,0',
        'do_tin_cay' => $data['do_tin_cay'] ?? '0%',
        'Ghi_chu' => $data['Ghi_chu'] ?? ''
    ];
    
    echo json_encode($response);
} elseif ($source === '789') {
    // Fetch data from 789 Sicbo API
    $apiUrl = 'https://okle-789sic.onrender.com/predict';
    $data = json_decode(file_get_contents($apiUrl), true);
    
    // Format the response
    $response = [
        'Id' => $data['Id'] ?? 'binhtool90',
        'Phien' => $data['Phien'] ?? 0,
        'Xuc_xac_1' => $data['Xuc_xac_1'] ?? 0,
        'Xuc_xac_2' => $data['Xuc_xac_2'] ?? 0,
        'Xuc_xac_3' => $data['Xuc_xac_3'] ?? 0,
        'Tong' => $data['Tong'] ?? 0,
        'Ket_qua' => $data['Ket_qua'] ?? 'Xỉu',
        'Pattern' => $data['Pattern'] ?? '',
        'Du_doan' => $data['Du_doan'] ?? 'Tài',
        'doan_vi' => $data['dudoan_vi'] ?? [0,0,0]
    ];
    
    echo json_encode($response);
} else {
    // Invalid source
    echo json_encode(['error' => 'Invalid source parameter']);
}
?>