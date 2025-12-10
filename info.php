<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>System Info</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .info-block { background: #f4f4f4; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Системна інформація</h2>
    <div class="info-block">
        <?php
        echo "<p><strong>Версія PHP:</strong> " . phpversion() . "</p>";
        echo "<p><strong>Операційна система сервера:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
        echo "<p><strong>IP адреса клієнта:</strong> " . $_SERVER['REMOTE_ADDR'] . "</p>";
        echo "<p><strong>Браузер (User Agent):</strong> " . $_SERVER['HTTP_USER_AGENT'] . "</p>";
        ?>
    </div>

    <h2>Повна конфігурація PHP (phpinfo)</h2>
    <?php
    phpinfo();
    ?>
</body>
</html>
