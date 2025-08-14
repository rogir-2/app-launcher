<?php
    require_once 'includes/db-config.php';
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT name, description, icon_path, link, shortcut_key FROM apps ORDER BY shortcut_key ASC";
        $result = $conn->query($sql);

    $apps = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $apps[] = $row;
        }
    }
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php require_once 'includes/config.php'; echo $title;?></title>

    <!-- CSS Style -->
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/style.css">

</head>
    <body class="dark">
        <!-- Header -->
        <header>
            <h1 tabindex="0"><?php require_once 'includes/config.php'; echo $title;?></h1>
            
            <button id="themeBtn" area-pressed="true" aria-label="Toggle light mode">
                <span id="themeIcon">☀️</span>
            </button>
        </header>

        <!-- Search Box -->
        <div id="searchWrapper">
            <input id="searchInput" type="search" placeholder="Search apps (Ctrl / Command + /)" aria-label="Search apps (Shortcut: Control / Command plus slash)">
        </div>

        <!-- Main Body Content -->
        <main>
            <!-- All Apps Link Card -->
            <div id="grid" class="app-grid" role="list">
                <?php if (empty($apps)): ?>
                    <div class="no-apps">
                        <p>No apps available. <a href="admin/">Add some apps</a> to get started.</p>
                    </div>
                <?php else: ?>
                    <?php foreach($apps as $app): ?>
                        <a href="<?= htmlspecialchars($app['link']) ?>"
                        class="app-btn"
                        role="listitem"
                        tabindex="0"
                        data-shortcut="<?= htmlspecialchars($app['shortcut_key']) ?>"
                        aria-label="<?= htmlspecialchars($app['name']) ?>. <?= htmlspecialchars($app['description']) ?>. Shortcut Control or Command plus <?= htmlspecialchars($app['shortcut_key']) ?>">
                            <img src="<?= htmlspecialchars($app['icon_path']) ?>" 
                                alt="<?= htmlspecialchars($app['name']) ?> icon" 
                                class="app-icon"
                                onerror="this.src='assets/images/default-app.png'">
                            <h3 class="app-name"><?= htmlspecialchars($app['name']) ?></h3>
                            <p class="shortcut-hint">Ctrl+<?= htmlspecialchars($app['shortcut_key']) ?></p>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </main>

        <!-- Screen reader announcements -->
        <div id="live" 
            aria-live="polite" 
            aria-atomic="true" 
            style="position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden;">
        </div>

        <script src="assets/js/app.js"></script>
    </body>
</html>