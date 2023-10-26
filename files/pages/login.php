<!DOCTYPE html>
<html lang="<?php echo $_SESSION['LANG']['code']; ?>">
<head>
      <?php if ($prod) {
  echo ("<script src=\"https://cdn.jsdelivr.net/gh/strawmelonjuices-logger-diary/online@{$last_commit_ID}/public/js/early.min.js\"></script>");
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
    <title>Logger-Diary Online - <?php Echo $_SESSION['LANG'][49] ?></title>
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
    <link rel="manifest" href="/?api=manifest" />
        
</head>
<body>
    <div id="theLoggerNav" class="sidenav"><a href="javascript:void(0)" class="closebtn" onclick="doHideNav()">&times;</a>
    <a href="/"><span class="emojis">👀</span>&nbsp;<?php Echo $_SESSION['LANG'][64]; ?></a>
    <a href="/register/"><span class="emojis">👋</span>&nbsp;<?php Echo $_SESSION['LANG'][57]; ?></a>
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
            <h2><span class="emojis">🗝️</span>&nbsp;<?php Echo $_SESSION['LANG'][49]; ?></h2>
            <div class="AddEntryForm">
        <p align="center"><?php Echo $_SESSION['LANG'][61] ?>.</p>
</div>
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <div class="readback settingsmain" align="center">
            <form id="setstyles" action="/login.php" method="post">
            <div class="form-group">
                <label><h4><?php Echo $_SESSION['LANG'][55]; ?></h4></label>
                <input type="text" name="username" class="LoginForm <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label><h4><?php Echo $_SESSION['LANG'][56]; ?></h4></label>
                <input type="password" name="password" class="LoginForm <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
                <div class="form-group">
                      <input type="checkbox" name="autologin" value="1">
                      <label for="autologin"> <?php Echo $_SESSION['LANG'][59]; ?> <small style="font-size: 8px"><?php Echo $_SESSION['LANG'][60]; ?></small></label><br>
                </div>
                <div class="form-group"><br></br>
                <input type="submit" class="LoginForm LoginButton" value="Continue!">
            </div>
            <p><?php Echo $_SESSION['LANG'][58]; ?> <a href="/register"><?php Echo $_SESSION['LANG'][57]; ?></a>.</p>
        </form>
        </div>
        <footer class="infofooter">
            <hr>
            <p><?php echo $LoggerInfo; ?></p>
        </footer>
    </div>
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