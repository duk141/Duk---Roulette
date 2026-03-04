<?php
session_start();

// Mật khẩu admin
$adminPassword = "nguvailon2014";

// Xử lý đăng nhập
if (isset($_POST['login'])) {
    if ($_POST['password'] === $adminPassword) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $error = "Mật khẩu không đúng!";
    }
}

// Đăng xuất
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit();
}

// Nếu chưa đăng nhập thì hiện form login
if (!isset($_SESSION['admin_logged_in'])) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập Admin</title>
    <style>
        body {font-family: Arial;background: linear-gradient(135deg,#4CAF50,#2e7d32);display: flex;justify-content: center;align-items: center;height: 100vh;margin:0;}
        .login-container {background: white;padding: 30px;border-radius: 12px;box-shadow: 0 8px 20px rgba(0,0,0,0.2);width: 350px;text-align: center;}
        h2 {color: #333;margin-bottom: 20px;}
        input[type="password"] {width: 100%;padding: 12px;margin: 10px 0;border: 1px solid #ccc;border-radius: 6px;}
        button {width: 100%;padding: 12px;background: #4CAF50;color: white;border: none;border-radius: 6px;font-size: 16px;cursor: pointer;}
        button:hover {background: #45a049;}
        .error {color: red;margin-top: 10px;}
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Đăng nhập Admin</h2>
        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="POST">
            <input type="password" name="password" placeholder="Nhập mật khẩu" required>
            <button type="submit" name="login">ĐĂNG NHẬP</button>
        </form>
    </div>
</body>
</html>
<?php
exit();
}

// File lưu key
$keysFile = 'coconcac.json';
$keysData = file_exists($keysFile) ? json_decode(file_get_contents($keysFile), true) : [];

// Xóa key quá hạn tự động
$today = date('Y-m-d');
$changed = false;
foreach ($keysData as $i => $keyInfo) {
    if (!empty($keyInfo['expiry_date']) && $keyInfo['expiry_date'] < $today) {
        unset($keysData[$i]);
        $changed = true;
    }
}
if ($changed) {
    $keysData = array_values($keysData);
    file_put_contents($keysFile, json_encode($keysData, JSON_PRETTY_PRINT));
}

// Tạo key mới
if (isset($_POST['generate_key'])) {
    $date = $_POST['key_date'] ?? date('Y-m-d');
    $expiryDate = $_POST['expiry_date'] ?? '';
    $key = bin2hex(random_bytes(16));

    $keysData[] = [
        'date' => $date,
        'key' => $key,
        'created_at' => date('Y-m-d H:i:s'),
        'expiry_date' => $expiryDate
    ];

    file_put_contents($keysFile, json_encode($keysData, JSON_PRETTY_PRINT));
    $success = "Đã tạo key mới: <strong>$key</strong>";
}

// Xóa key theo yêu cầu
if (isset($_GET['delete_key'])) {
    $index = intval($_GET['delete_key']);
    if (isset($keysData[$index])) {
        unset($keysData[$index]);
        $keysData = array_values($keysData);
        file_put_contents($keysFile, json_encode($keysData, JSON_PRETTY_PRINT));
        header("Location: admin.php"); // quay lại trang chính
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Key</title>
    <style>
        body {font-family: Arial;background: #f0f2f5;margin:0;padding:20px;}
        .container {max-width: 1100px;margin: auto;background: white;padding: 25px;border-radius: 12px;box-shadow: 0 8px 20px rgba(0,0,0,0.1);}
        h1 {text-align: center;color: #2e7d32;margin-bottom: 20px;}
        .logout-btn {float: right;background: #f44336;color: white;padding: 8px 14px;border-radius: 6px;text-decoration: none;}
        .logout-btn:hover {background: #d32f2f;}
        .success {background: #e8f5e9;color: #2e7d32;padding: 10px;border-radius: 6px;margin: 10px 0;}
        form label {font-weight: bold;display: block;margin-top: 10px;}
        form input[type="date"] {padding: 8px;width: 100%;border: 1px solid #ccc;border-radius: 6px;margin-top: 5px;}
        form button {margin-top: 15px;background: #4CAF50;color: white;padding: 10px 15px;border: none;border-radius: 6px;cursor: pointer;}
        form button:hover {background: #45a049;}
        table {width: 100%;border-collapse: collapse;margin-top: 20px;}
        th, td {padding: 12px;border: 1px solid #ddd;text-align: center;}
        th {background: #4CAF50;color: white;}
        tr:nth-child(even) {background: #f9f9f9;}
        .delete-btn {background: #f44336;color: white;padding: 6px 10px;border-radius: 6px;text-decoration: none;}
        .delete-btn:hover {background: #d32f2f;}
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {display: block;width: 100%;}
            th {position: absolute;top: -9999px;left: -9999px;}
            td {border: none;position: relative;padding-left: 50%;}
            td:before {position: absolute;left: 15px;white-space: nowrap;font-weight: bold;}
            td:nth-of-type(1):before {content: "Ngày áp dụng";}
            td:nth-of-type(2):before {content: "Key";}
            td:nth-of-type(3):before {content: "Ngày tạo";}
            td:nth-of-type(4):before {content: "Ngày hết hạn";}
            td:nth-of-type(5):before {content: "Hành động";}
        }
    </style>
</head>
<body>
<div class="container">
    <a href="?logout" class="logout-btn">Đăng xuất</a>
    <h1>Quản Lý Key Truy Cập</h1>

    <?php if (isset($success)) echo "<div class='success'>$success</div>"; ?>

    <h2>Tạo Key Mới</h2>
    <form method="POST">
        <label>Ngày áp dụng:</label>
        <input type="date" name="key_date" value="<?= date('Y-m-d') ?>" required>
        <label>Ngày hết hạn (không bắt buộc):</label>
        <input type="date" name="expiry_date">
        <button type="submit" name="generate_key">Tạo Key Mới</button>
    </form>

    <h2>Danh Sách Key</h2>
    <?php if (empty($keysData)): ?>
        <p>Chưa có key nào được tạo.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Ngày áp dụng</th>
                <th>Key</th>
                <th>Ngày tạo</th>
                <th>Ngày hết hạn</th>
                <th>Hành động</th>
            </tr>
            <?php foreach ($keysData as $index => $keyInfo): ?>
                <tr>
                    <td><?= htmlspecialchars($keyInfo['date']) ?></td>
                    <td><?= htmlspecialchars($keyInfo['key']) ?></td>
                    <td><?= htmlspecialchars($keyInfo['created_at']) ?></td>
                    <td><?= $keyInfo['expiry_date'] ?: 'Không giới hạn' ?></td>
                    <td><a href="?delete_key=<?= $index ?>" class="delete-btn" onclick="return confirm('Xóa key này?')">Xóa</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
</body>
</html>