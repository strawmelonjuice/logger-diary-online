<?php
// Initialize the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . "/../scripts/AccountInteractions.php");
require_once(__DIR__ . "/../scripts/EntryPlaceholders.php");
if (!(AccountInteraction($_SESSION['UID'],"Get","others","tour","")) == "true") {
  header("location: /tour/");
}

      {
        // If no theme is set, and no theme is known, just fall back to taupe theme.
        if (empty(AccountInteraction($_SESSION['UID'],"Get","settings", "set_theme"))) {
            AccountInteraction($_SESSION['UID'],"Write","settings","set_theme","taupe");
            $theme = "taupe";
        } else {
          $theme = AccountInteraction($_SESSION['UID'],"Get","settings", "set_theme");
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
}?>
    <meta name="theme-color" content="#<?php echo ThemeColor(); ?>" />
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="/img/logo/icon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include(__DIR__ . "/../scripts/themeload.php");
  include(__DIR__. "/../scripts/LoadUserSettingsToJS.php");
?>
    <title>Logger-Diary&nbsp;Online&nbsp;-&nbsp;<?php Echo $_SESSION['LANG'][78]; ?></title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link rel="manifest" href="/?api=manifest" />
        
</head>

<body>
    <div id="theLoggerNav" class="sidenav"><a href="javascript:void(0)" class="closebtn" onclick="doHideNav()">&times;</a>
        <a href="/home/"><span class="emojis">🏠</span>&nbsp;<?php Echo $_SESSION['LANG'][6]; ?></a>
        <a href="/settings"><span class="emojis">&#9881;</span>&nbsp;<?php Echo $_SESSION['LANG'][7]; ?>...</a>
        <a href="/news/"><span class="emojis">🗞️</span>&nbsp;<?php Echo $_SESSION['LANG'][9]; ?></a>
        <a href="javascript:void(0)" id="mmlt" style="display: block;" onclick="moreLinks()"><span class="emojis">➕</span>&nbsp;<?php Echo $_SESSION['LANG'][66]; ?>...</a>
        <div style="display: none;" id="menumorelinks">
          <a href="javascript:void(0)" onclick="lessLinks()"><span class="emojis">➖</span>&nbsp;<?php Echo $_SESSION['LANG'][67]; ?></a>
          <a href="/logout/"><span class="emojis">🚪</span>&nbsp;<?php Echo $_SESSION['LANG'][48]; ?></a>
          <a href="/re-tour/"><span class="emojis">🚗</span>&nbsp;Tour</a>
</div>
    </div>
        <span id="ViewNavButtonSpan"><button onclick="doViewNav()" type="button" id="ViewNavButton">&#9776;</button></span>
    <div class="headinglogo"><a href="/home/"><img src="/img/logo/logo_446x446.png" alt="Logger-Diary Online" class="headinglogo"></a><span style="text-align: center;"><div class="bymarbanner"><?php Echo $_SESSION['LANG'][3]; ?>&nbsp;<a class="bymarbanner" href="/contributions/"><?php Echo $_SESSION['LANG'][4]; ?></a>.</div></span></div>
        <div id="main"><?php include(__DIR__ ."/licence-main.php");?></div>
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
<?php
if  ($theme == 'framework') {
  // Framework Theme code start
  AccountInteraction($_SESSION["UID"],"Write","settings","FocusNewEntries","0");
  ?>
    <script>
        function NewEntryFocus() {}
        function NewEntryUnFocus() {}
    </script>
  
  <?php
  // Framework Theme code end
}
?>
</body>
</html>