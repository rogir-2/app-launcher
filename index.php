<?php
    $apps = [
        ["name" => "Moodle", "icon" => "assets/images/appicons/moodle.png", "link" => "", "shortcut" => "1"],
        ["name" => "Box4", "icon" => "assets/images/appicons/box4.png", "link" => "", "shortcut" => "2"],
        ["name" => "Office 365", "icon" => "assets/images/appicons/m365.png", "link" => "", "shortcut" => "3"],
        ["name" => "Navigate", "icon" => "assets/images/appicons/navigate.png", "link" => "", "shortcut" => "4"],
        ["name" => "CenturyTech", "icon" => "assets/images/appicons/centurytech.png", "link" => "", "shortcut" => "5"],
        ["name" => "BKSB", "icon" => "assets/images/appicons/bksb.png", "link" => "", "shortcut" => "6"],
        ["name" => "LRC Hub", "icon" => "assets/images/appicons/lrc.png", "link" => "", "shortcut" => "7"],
        ["name" => "ClickView", "icon" => "assets/images/appicons/clickview.png", "link" => "", "shortcut" => "8"]

    ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NWSLC Apps Launcher</title>

    <!-- CSS Style -->
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/style.css">

</head>
    <body class="dark">
        <!-- Header -->
        <header>
            <h1 tabindex="0">NWSLC Apps Launcher</h1>
            
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
                <?php foreach($apps as $app): ?>
                    <a href="<?= htmlspecialchars($app['link']) ?>"
                    class="app-btn"
                    role="listitem"
                    tabindex="0"
                    data-shortcut="<?= htmlspecialchars($app['shortcut']) ?>"
                    aria-label="<?= htmlspecialchars($app['name']) ?>. Shortcut Control or Command plus <?= htmlspecialchars($app['shortcut']) ?>">
                        <img src="<?= htmlspecialchars($app['icon']) ?>" 
                            alt="<?= htmlspecialchars($app['name']) ?> icon" 
                            class="app-icon">
                        <h3 class="app-name"><?= htmlspecialchars($app['name']) ?></h3>
                        <p class="shortcut-hint">Ctrl+<?= htmlspecialchars($app['shortcut']) ?></p>
                    </a>
                <?php endforeach; ?>
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