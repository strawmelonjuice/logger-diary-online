<!DOCTYPE html>
<html lang="<?php echo $_SESSION['LANG']['code']; ?>">
<head>
      <?php if ($prod) {
  echo ("<script src=\"https://cdn.jsdelivr.net/gh/strawmelonjuice/logger-diary-online@{$last_commit_ID}/public/js/early.min.js\"></script>");
} else {
  echo "<script src=\"/js/early.js\"></script>";
}?>
    <meta charset="UTF-8">

        <meta media="(prefers-color-scheme: light)" name="theme-color" content="#f7bd768d" />
    <meta media="(prefers-color-scheme: dark)" name="theme-color" content="#3c1c1c" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/img/logo/icon.ico" />
    <link  media="(prefers-color-scheme: light)" rel="stylesheet" href="/?getcss=themes/jellybean.css" content-type="text/css" charset="utf-8" />
    <link  media="(prefers-color-scheme: dark)" rel="stylesheet" href="/?getcss=themes/rouge.css" content-type="text/css" charset="utf-8" />
    <title>Logger-Diary Online - Register</title>
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
    <link rel="manifest" href="/?api=manifest" />
        
</head>
<body>
    <div id="theLoggerNav" class="sidenav"><a href="javascript:void(0)" class="closebtn" onclick="doHideNav()">&times;</a>
    <a href="/"><span class="emojis">👀</span>&nbsp;<?php Echo $_SESSION['LANG'][64]; ?></a>
    <a href="/login/"><span class="emojis">🗝️</span>&nbsp;<?php Echo $_SESSION['LANG'][49]; ?></a>
    <a href="/news/"><span class="emojis">🗞️</span>&nbsp;<?php Echo $_SESSION['LANG'][9]; ?></a>
    <a href="javascript:void(0)" id="mmlt" style="display: block;" onclick="moreLinks()">➕ <?php Echo $_SESSION['LANG'][66]; ?>...</a>
    <div style="display: none;" id="menumorelinks">
    <a href="javascript:void(0)" onclick="lessLinks()">➖ <?php Echo $_SESSION['LANG'][67]; ?></a>
    <a href="/contributions/"><span class="emojis">👷</span>&nbsp;<?php Echo $_SESSION['LANG'][11]; ?></a>
</div>
    </div>
        <span id="ViewNavButtonSpan"><button onclick="doViewNav()" type="button" id="ViewNavButton">&#9776;</button></span>
        <div class="headinglogo"><a href="/home/"><img src="/img/logo/logo_446x446.png" alt="Logger-Diary Online" class="headinglogo"></a><span style="text-align: center;"><div class="bymarbanner"><?php Echo $_SESSION['LANG'][3]; ?>&nbsp;<a class="bymarbanner" href="/contributions/"><?php Echo $_SESSION['LANG'][4]; ?></a>.</div></span></div>
        <div id="main">
        <h2><span class="emojis">👋</span>&nbsp;<?php Echo $_SESSION['LANG'][57]; ?></h2><div class="AddEntryForm">
        <p align="center"><?php Echo $_SESSION['LANG'][65]; ?></p>
        </div><div class="readback settingsmain" align="center">
            <form id="setstyles" action="/register.php" method="post">
            <div class="form-group">
                <label><?php Echo $_SESSION['LANG'][55]; ?></label>
                <input type="text" name="username" class="LoginForm" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label><?php Echo $_SESSION['LANG'][56]; ?></label>
                <input type="password" name="password" class="LoginForm <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label><?php Echo $_SESSION['LANG'][63]; ?></label>
                <input type="password" name="confirm_password" class="LoginForm <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="LoginForm LoginButton" value="GO!">
                <input type="reset" class="LoginForm LoginButton" value="Reset">
            </div>
            <p><?php Echo $_SESSION['LANG'][62]; ?> <a href="/login/"><?php Echo $_SESSION['LANG'][49]; ?></a>.</p>
        </form>
        </div>
        <footer class="infofooter">
            <hr>
            <p><?php echo $LoggerInfo; ?></p>
        </footer>
    </div>
<?php
if ($prod) {
  echo ("<script src=\"https://cdn.jsdelivr.net/combine/gh/strawmelonjuice/logger-diary-online@{$last_commit_ID}/public/js/site.min.js,gh/strawmelonjuice/logger-diary-online@{$last_commit_ID}/public/js/theme.min.js,npm/hl-img@{$_ENV['HLimgVersion']}/hl-img.min.js\"></script>");
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