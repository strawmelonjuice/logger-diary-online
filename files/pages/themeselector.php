<?php
// Initialize the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$last_commit_ID = trim((shell_exec('git rev-parse --short HEAD')));
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
  echo ("<script src=\"https://cdn.jsdelivr.net/gh/strawmelonjuice/logger-diary-online@{$last_commit_ID}/public/js/early.min.js\"></script>");
} else {
  echo "<script src=\"/js/early.js\"></script>";
}?>
    <meta name="theme-color" content="#<?php echo ThemeColor(); ?>" />
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="/img/logo/icon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/themepreviews.css" content-type="text/css" charset="utf-8" />
    <?php include(__DIR__ . "/../scripts/themeload.php");
  include(__DIR__. "/../scripts/LoadUserSettingsToJS.php");
?>
    <title>Logger-Diary&nbsp;Online&nbsp;-&nbsp;<?php Echo $_SESSION['LANG'][7]; ?></title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="manifest" href="/?api=manifest" />
        
</head>

<body>
  <?php
  use Symfony\Component\Yaml\Yaml;

  $themeinfo = Yaml::parseFile(__DIR__ . '/../config/themes.yaml');
  foreach ($themeinfo as $style) {
    $new = "<OPTION VALUE=\"{$style['internal']}\">\"{$_SESSION['LANG'][50][$style['name']][1]}\" — {$_SESSION['LANG'][50][$style['name']][2]}</OPTION>";
    if (!isset($selectablethemes[$style['class']])) {
      $selectablethemes[$style['class']] = $new;
    } else {
      $selectablethemes[$style['class']] = $selectablethemes[$style['class']] . $new;
    }
  }
  echo <<<END
    <div id="theLoggerNav" class="sidenav"><a href="javascript:void(0)" class="closebtn" onclick="doHideNav()">&times;</a>
        <a href="/home/"><span class="emojis">🏠</span>&nbsp;{$_SESSION['LANG'][6]}</a>
        <a href="/news/"><span class="emojis">🗞️</span>&nbsp;{$_SESSION['LANG'][9]}</a>
        <a href="/logout/"><span class="emojis">🚪</span>&nbsp;{$_SESSION['LANG'][48]}</a>
        <!-- <a href=\"javascript:void(0)\" id=\"mmlt\" style=\"display: block;\" onclick=\"moreLinks()\">➕ {$_SESSION['LANG'][66]}...</a>"
        <div style="display: none;" id="menumorelinks"><a href="javascript:void(0)" onclick="lessLinks()">➖ {$_SESSION['LANG'][67]}</a></div> -->
    </div>

    <span id="ViewNavButtonSpan"><button onclick="doViewNav()" type="button" id="ViewNavButton">&#9776;</button></span>
    <div id="main" style="max-width: 100vw;">
    <h1>{$_SESSION['LANG'][35]}</h1>
      <form style="right: 0px;line-height: 40px; display: inline; text-align: center; float: right; max-width: 900px;" action="/set.php" method="GET">
        <button type="submit" id="sendbtn">{$_SESSION['LANG'][72]}</button>
        <select id="themeselector" style="width: 25VW; display: inline;" name="set_theme" onchange="UpdatePreviewAndLogo()" class="button-like">
          <OPTGROUP LABEL="{$_SESSION['LANG'][50][2][1]}">
            {$selectablethemes['default']}
          </OPTGROUP>
          <OPTGROUP LABEL="{$_SESSION['LANG'][50][2][2]}">
            {$selectablethemes['plain']}
          </OPTGROUP>
          <OPTGROUP LABEL="{$_SESSION['LANG'][50][2][3]}">
            {$selectablethemes['colored']}
          </OPTGROUP>
          <OPTGROUP LABEL="{$_SESSION['LANG'][50][2][5]}">
            {$selectablethemes['strawmelonjuice']}
          </OPTGROUP>
          <OPTGROUP LABEL="{$_SESSION['LANG'][50][2][4]}">
            {$selectablethemes['modified']}
          </OPTGROUP>
        </select>
        <input type="hidden" name="forward" value="{$url}">
        <img id="themelogo" style="width: 15VW; display: inline; border: groove 5px; border-radius: 5px">
        </form>
    <br></br></div>
    <div style="text-align: center;"><iframe id="themepreview" style="width: 90vw; max-width: 100vw; margin: 0px; padding: 0px; left: 0px; right: 0px; min-height: 50vh; align-self: center; border-radius: 25px; overflow: auto"></iframe></div>
END;
  ?>
  <script>
  $( "#ViewNavButton" ).on( "click", function() {
       $( "#themepreview" ).css("filter", "brightness(20%) opacity(20%) blur(25px)");
  });
  $( ".closebtn" ).on( "click", function() {
       $( "#themepreview" ).css("filter", "none");
  });
  </script>
    <footer class="infofooter">
            <hr>
            <p><?php echo $LoggerInfo; ?></p>
        </footer>
    <?php
    $themeInfoJSON = json_encode($themeinfo);
    $currentTheme = AccountInteraction($_SESSION['UID'],"Get","settings", "set_theme");
    echo <<<STOP
      <script>
          const themeInfoJSON = `{$themeInfoJSON}`;
          const currentTheme = "{$currentTheme}";
          const themeInfo = JSON.parse(themeInfoJSON);
          console.info("The themes and their info:", themeInfo);
      </script>
    STOP;
?>
<script>
    function UpdatePreviewAndLogo() {
      console.log("Updating preview and logo!\n\n");
      for (let i = 0; i < themeInfo.length; i++) {
        if ((themeInfo[i]['internal']) === (document.getElementById("themeselector").value)) {
          console.log("%cMatch: " + (themeInfo[i]['internal']),"color: green;");
          if ((themeInfo[i]['logo']).startsWith('http')) {
            document.getElementById("themelogo").src = themeInfo[i]['logo'];
          } else {
          document.getElementById("themelogo").src = "/img/theme-icons/" + themeInfo[i]['logo'];
          }
          document.getElementById("themepreview").src = "/home?themeoverride=" + themeInfo[i]['internal'];
        } else {
          console.log("%cNo match: " + (themeInfo[i]['internal']),"color: red");
        }
  }
  if (currentTheme === document.getElementById("themeselector").value) {
    console.log("The selector has the current theme set.");
    document.getElementById("sendbtn").setAttribute("disabled", "1");
    
  } else {
    document.getElementById("sendbtn").removeAttribute("disabled");

  }
}
document.getElementById("themeselector").value = currentTheme;
UpdatePreviewAndLogo();
</script>
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