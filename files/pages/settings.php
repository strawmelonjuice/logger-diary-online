<?php
// Initialize the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$last_commit_ID = trim((shell_exec('git rev-parse --short HEAD')));
require_once(__DIR__ . "/../scripts/AccountInteractions.php");
require_once(__DIR__ . "/../scripts/EntryPlaceholders.php");
if (!(AccountInteraction($_SESSION['UID'], "Get", "others", "tour", "")) == "true") {
    header("location: /tour/");
} {
    // If no theme is set, and no theme is known, just fall back to taupe theme.
    if (empty(AccountInteraction($_SESSION['UID'], "Get", "settings", "set_theme"))) {
        AccountInteraction($_SESSION['UID'], "Write", "settings", "set_theme", "taupe");
        $theme = "taupe";
    } else {
        $theme = AccountInteraction($_SESSION['UID'], "Get", "settings", "set_theme");
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['LANG']['code']; ?>">

<head>
    <?php if ($prod) {
        echo ("<script src=\"https://cdn.jsdelivr.net/gh/strawmelonjuices-logger-diary/online@{$last_commit_ID}/public/js/early.min.js\"></script>");
    } else {
        echo "<script src=\"/js/early.js\"></script>";
    } ?>
    <meta name="theme-color" content="#<?php echo ThemeColor(); ?>" />
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="/img/logo/icon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/themepreviews.css" content-type="text/css" charset="utf-8" />
    <?php include(__DIR__ . "/../scripts/themeload.php");
  include(__DIR__. "/../scripts/LoadUserSettingsToJS.php");
?>
    <title>Logger-Diary&nbsp;Online&nbsp;-&nbsp;
        <?php echo $_SESSION['LANG'][7]; ?>
    </title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link rel="manifest" href="/?api=manifest" />

</head>

<body>
    <div id="theLoggerNav" class="sidenav"><a href="javascript:void(0)" class="closebtn"
            onclick="doHideNav()">&times;</a>
        <a href="/home/"><span class="emojis">🏠</span>&nbsp;
            <?php echo $_SESSION['LANG'][6]; ?>
        </a>
        <a href="/news/"><span class="emojis">🗞️</span>&nbsp;
            <?php echo $_SESSION['LANG'][9]; ?>
        </a>
        <a href="/logout/"><span class="emojis">🚪</span>&nbsp;
            <?php echo $_SESSION['LANG'][48]; ?>
        </a>
        <!-- <?php echo "<a href=\"javascript:void(0)\" id=\"mmlt\" style=\"display: block;\" onclick=\"moreLinks()\">➕{$_SESSION['LANG'][66]}...</a>"; ?>
        <div style="display: none;" id="menumorelinks"><a href="javascript:void(0)" onclick="lessLinks()">➖ <?php echo $_SESSION['LANG'][67]; ?></a></div> -->
    </div>
    <span id="ViewNavButtonSpan"><button onclick="doViewNav()" type="button" id="ViewNavButton">&#9776;</button></span>
    <div id="main">
        <h1>Logger-Diary Online
            <?php echo DiaryDot(); ?>
        </h1>
        <h5>
            <div class="bymarbanner">
                <?php echo $_SESSION['LANG'][3]; ?>&nbsp;<a class="bymarbanner" href="/contributions/">
                    <?php echo $_SESSION['LANG'][4]; ?>
                </a>
            </div>
        </h5>
        <h3>
            <?php echo $_SESSION['LANG'][7]; ?>
        </h3>
        <div class="AddEntryForm">
            <p style="Text-align: center;">
                <?php echo $_SESSION['LANG'][33]; ?> <a href="/home/">
                    <?php echo $_SESSION['LANG'][34]; ?>
                </a>?
            </p>
        </div>
        <div class="readback settingsmain" align="center"><br><a href="/themes/">
                <?php echo $_SESSION['LANG'][35]; ?>
            </a></div>
        <div class="readback settingsmain" align="center">
            <h4>
                <?php echo $_SESSION['LANG'][36] ?>
            </h4>
            <form id="focussetting" action="/set.php" method="POST">
                <label for="focusmode">
                    <?php echo $_SESSION['LANG'][37] . ": ";
                    if (AccountInteraction($_SESSION["UID"], "Get", "settings", "FocusNewEntries", "") == "1") {
                        echo '<code>' . $_SESSION['LANG'][27] . '</code></label>    <input name="focusmode" value="0" type="hidden"><input type="submit" value="' . $_SESSION['LANG'][39] . '" class="button-like">';
                    } else {
                        echo '<code>' . $_SESSION['LANG'][28] . '</code></label>    <input name="focusmode" value="1" type="hidden"><input type="submit" value="' . $_SESSION['LANG'][40] . '" class="button-like">';
                    }
                    ?>
                    <p id="mjdhwb"></p>
                    <script>
                        if (mediamobilescreen()) {
                            getLang(81,'','', function (d) {
                                document.getElementById("mjdhwb").innerText = d;
                            });
                        }
                    </script>
            </form>
            <br></br>
            <form id="le-setting" action="/set.php" method="POST">
                <label for="LongEntries">
                    <?php echo $_SESSION['LANG'][38] . ": ";
                    if (AccountInteraction($_SESSION["UID"], "Get", "settings", "LongEntries", "") == "0") {
                        echo '<code>' . $_SESSION['LANG'][28] . '</code>    <input name="LongEntries" value="1" type="hidden"><input type="submit" value="' . $_SESSION['LANG'][40] . '" class="button-like">';
                    } else {
                        echo '<code>' . $_SESSION['LANG'][27] . '</code>    <input name="LongEntries" value="0" type="hidden"><input type="submit" value="' . $_SESSION['LANG'][39] . '" class="button-like">';
                    }
                    ?>
                    <p id="mjdhxb"></p>
                    <script>
                        if (mediamobilescreen()) {
                            getLang(83,'','', function (d) {
                                document.getElementById("mjdhxb").innerText = d;
                            });
                        }
                    </script>
            </form>
        </div>
        <div class="readback settingsmain" align="center">
            <h4>
                <?php echo $_SESSION['LANG'][41]; ?>
            </h4>
            <form id="donationsetting" action="/set.php" method="POST">
                <label for="askfordonate">
                    <?php echo $_SESSION['LANG'][41] . ": ";
                    if (!(AccountInteraction($_SESSION["UID"], "Get", "others", "askfordonate", "") == "0")) {
                        echo '<code>' . $_SESSION['LANG'][42] . '</code>    <input name="askfordonate" value="0" type="hidden"><input type="submit" value="' . $_SESSION['LANG'][44] . '" class="button-like">';
                    } else {
                        echo '<code>' . $_SESSION['LANG'][43] . '</code>    <input name="askfordonate" value="1" type="hidden"><input type="submit" value="' . $_SESSION['LANG'][45] . '" class="button-like">';
                    }
                    ?>
            </form>
            <p>
                <?php echo $_SESSION['LANG'][75] . ' <a href="https://strawmelonjuice.com/?p=support" target="_blank">' . $_SESSION['LANG'][76] . '</a>'; ?>!
            </p>
        </div>
        <div class="readback settingsmain" align="center">
            <h4><text class="translatable" data-translation_id="79"></text></h4>
            <form id="DisableDailyStreaks" action="/set.php" method="POST">
                <label for="DisableDailyStreaks">
                    <text class="translatable" data-translation_id="80"></text>:
                    <?php
                    if (!(AccountInteraction($_SESSION["UID"], "Get", "settings", "DisableDailyStreaks", "") == "1")) {
                        echo '<code><text class="translatable" data-translation_id="27"></text></code>    <input name="DisableDailyStreaks" value="1" type="hidden"><button type="submit"><text class="translatable" data-translation_id="45"></text></button">';
                    } else {
                        echo '<code><text class="translatable" data-translation_id="28"></text></code>    <input name="DisableDailyStreaks" value="0" type="hidden"><button type="submit"><text class="translatable" data-translation_id="44"></text></button>';
                    }
                    ?>
            </form>
        </div>
        <div class="readback settingsmain" align="center">
            <h4>
                <?php echo $_SESSION['LANG'][70]; ?>
            </h4>
            <form id="languageoverride" action="/set.php" method="GET">
                <select name="languageoverride" class="button-like" style="width: 60%">
                    <?php
                    echo '<option value="auto">' . $_SESSION['LANG'][71]['auto'] . '</option>';
                    foreach (json_decode(file_get_contents(__DIR__ . "/../config/lang/languages.json")) as $result) {
                        echo '<option value="' . $result->langcode . '"';
                        if (AccountInteraction($_SESSION['UID'], "Get", "settings", "PreferedLanguageOverride") == $result->langcode) {
                            echo ' SELECTED';
                        }
                        echo '>' . $result->langname . ' - ' . $_SESSION['LANG'][71][$result->langcode] . '</option>';
                    }
                    ?>
                </select>&nbsp;<input type="submit" value="<?php echo $_SESSION['LANG'][72]; ?>" class="button-like"
                    style="">
            </form>
        </div>
        <div class="readback settingsmain" align="center">
            <h4>
                <?php echo $_SESSION['LANG'][46]; ?>
            </h4>
            <div style="display: grid; width: 40%">
                <a href="/other-settings/passwordreset.php"><button class="btn btn-warning invalid" style="width: 75%">
                        <?php echo $_SESSION['LANG'][47]; ?>
                    </button></a><br>
                <a href="/logout/"><button class="btn" style="width: 75%">
                        <?php echo $_SESSION['LANG'][48]; ?>
                    </button></a>
            </div>
        </div>
    </div>
    <footer class="infofooter">
        <hr>
        <p>
            <?php echo $LoggerInfo; ?>
        </p>
    </footer>
    </div>
    <?php
    if ($theme == 'framework') {
        // Framework Theme code start
        AccountInteraction($_SESSION["UID"], "Write", "settings", "FocusNewEntries", "0");
        ?>
        <script>
            function NewEntryFocus() { }
            function NewEntryUnFocus() { }
        </script>

        <?php
        // Framework Theme code end
    }
    ?>
    <?php
    if ($prod) {
        echo ("<script src=\"https://cdn.jsdelivr.net/combine/gh/strawmelonjuices-logger-diary/online@{$last_commit_ID}/public/js/site.min.js,gh/strawmelonjuices-logger-diary/online@{$last_commit_ID}/public/js/theme.min.js,npm/hl-img@{$_ENV['HLimgVersion']}/hl-img.min.js\"></script>");
    } else {
        echo <<<YEAG
  <script src="/js/site.js"></script>
  <script defer src="/js/theme.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/hl-img@latest/hl-img.js"></script>
  YEAG;
    }
    ?>

</body>

</html>