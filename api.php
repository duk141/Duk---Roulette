<?php
header('Content-Type: application/json');

$source = isset($_GET['source']) ? $_GET['source'] : '';

if ($source === 'sunwin') {
    // Fetch data from Sunwin API
    $sunwinApiUrl = 'https://fullsrc-daynesun.onrender.com/api/taixiu/sunwin';
    $sunwinData = json_decode(file_get_contents($sunwinApiUrl), true);
    
    // Format the response
    $response = [
        'id' => $sunwinData['id'] ?? 'binhtool90',
        'Phien' => $sunwinData['Phien'] ?? 0,
        'Xuc_xac_1' => $sunwinData['Xuc_xac_1'] ?? 0,
        'Xuc_xac_2' => $sunwinData['Xuc_xac_2'] ?? 0,
        'Xuc_xac_3' => $sunwinData['Xuc_xac_3'] ?? 0,
        'Tong' => $sunwinData['Tong'] ?? 0,
        'Ket_qua' => $sunwinData['Ket_qua'] ?? 'Xỉu',
        'du_doan' => $sunwinData['du_doan'] ?? 'Tài',
        'Pattern' => $sunwinData['Pattern'] ?? 'XTXXXXTTTTTXT'
    ];
    
    echo json_encode($response);
} elseif ($source === '789') {
    // Fetch data from 789 API
    $api789Url = 'https://hullic90-789pre.onrender.com/taixiu';
    $data789 = json_decode(file_get_contents($api789Url), true);
    
    // Format the response
    $response = [
        'Phien' => $data789['Phien'] ?? 0,
        'Xuc_xac_1' => $data789['Xuc_xac_1'] ?? 0,
        'Xuc_xac_2' => $data789['Xuc_xac_2'] ?? 0,
        'Xuc_xac_3' => $data789['Xuc_xac_3'] ?? 0,
        'Tong' => $data789['Tong'] ?? 0,
        'Ket_qua' => $data789['Ket_qua'] ?? 'Xỉu',
        'phien_hien_tai' => $data789['phien_hien_tai'] ?? 0,
        'du_doan' => $data789['du_doan'] ?? 'Tài',
        'do_tin_cay' => $data789['do_tin_cay'] ?? 0
    ];
    
    echo json_encode($response);
} else {
    // Invalid source
    echo json_encode(['error' => 'Invalid source parameter']);
}
?>