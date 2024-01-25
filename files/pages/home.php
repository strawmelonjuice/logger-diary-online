<?php
// Initialize the session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
require_once(__DIR__ . "/../scripts/AccountInteractions.php");
require_once(__DIR__ . "/../scripts/EntryPlaceholders.php");
if (!(AccountInteraction($_SESSION['UID'], "Get", "others", "tour", "")) == "true") {
  header("location: /tour/");
} {
  $previewtheme = false;
  // If no theme is set, and no theme is known, just fall back to taupe theme.
  if (empty(AccountInteraction($_SESSION['UID'], "Get", "settings", "set_theme"))) {
    AccountInteraction($_SESSION['UID'], "Write", "settings", "set_theme", "taupe");
    $theme = "taupe";
  } else {
    $theme = AccountInteraction($_SESSION['UID'], "Get", "settings", "set_theme");
  }
  // If we're trying out a new theme, use that!
  if (isset($_GET['themeoverride'])) {
    $theme = $_GET['themeoverride'];
    $previewtheme = true;
  }
}
if ($_SESSION["NewLogin"] = true) {
  $current = AccountInteraction($_SESSION['UID'], "Get", "others", "lastknownclientdate");
  $currentdt = new DateTime($current);
  $past = AccountInteraction($_SESSION['UID'], "Get", "others", "lastrecordedlogin");
  $pastdt = new DateTime($past);
  $interval = $currentdt->diff($pastdt);
  if (!(AccountInteraction($_SESSION["UID"], "Get", "settings", "DisableDailyStreaks", "") == "0")) {
  $NewDay = false;
  if ($interval->days != 0) {
    $NewDay = true;
    if ($interval->days = 1) {
      AccountInteraction($_SESSION['UID'], "Write", "others", "dailystreakinterval", "0");
      $loginstreak = AccountInteraction($_SESSION['UID'], "Get", "others", "loginstreak");
      $loginstreak = ++$loginstreak;
      AccountInteraction($_SESSION['UID'], "Write", "others", "loginstreak", $loginstreak);
    }
    if ($interval->days >= 2) {
      AccountInteraction($_SESSION['UID'], "Write", "others", "dailystreakinterval", $interval->days);
      AccountInteraction($_SESSION['UID'], "Write", "others", "loginstreak", "0");
    }
  }
}
  AccountInteraction($_SESSION['UID'], "Write", "others", "lastrecordedlogin", $current);
  $_SESSION["NewLogin"] = false;
}
if (AccountInteraction($_SESSION['UID'], "Get", "others", "loginstreak") == NULL) {
  AccountInteraction($_SESSION['UID'], "Write", "others", "loginstreak", "0");
}

?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['LANG']['code']; ?>">

<head>
  <?php if ($prod) {
    echo ("<script src=\"https://cdn.jsdelivr.net/gh/strawmelonjuice/logger-diary-online@{$last_commit_ID}/public/js/early.min.js\"></script>");
  } else {
    echo "<script src=\"/js/early.js\"></script>";
  } ?>
  <script>
    <?php
    if ($previewtheme) {
      echo "const previewtheme = true";
    }
    ?>
  </script>
  <meta name="theme-color" content="#<?php echo ThemeColor(); ?>" />
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="/img/logo/icon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include(__DIR__ . "/../scripts/themeload.php");
  include(__DIR__. "/../scripts/LoadUserSettingsToJS.php");
?>
  <title>Logger-Diary&nbsp;Online&nbsp;-&nbsp;
    <?php echo ($_SESSION["username"]); ?>'s&nbsp;diary
  </title>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <link rel="manifest" href="/?api=manifest" />

  <script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => {
        navigator.serviceWorker.register('/js/sw.js')
          .then((registration) => {
            console.log(`service worker registered succesfully ${registration}`)
          })
          .catch((err) => {
            console.log(`Error registring ${err}`)
          })
      })
    } else {
      console.log(`Service worker is not supported in this browser.`)
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/picmo@latest/dist/umd/index.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@picmo/popup-picker@latest/dist/umd/index.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@picmo/renderer-twemoji@latest/dist/umd/index.js"></script>
  <?php if ($prod) {
    echo ("<script src=\"https://cdn.jsdelivr.net/gh/strawmelonjuice/logger-diary-online@{$last_commit_ID}/public/js/emoji-drawer-2.min.js\"></script>");
  } else {
    echo "<script src=\"/js/emoji-drawer-2.js\"></script>";
  } ?>
</head>

<body onload="tableFromJson()">
  <div id="theLoggerNav" class="sidenav"><a href="javascript:void(0)" class="closebtn" onclick="doHideNav()">&times;</a>
    <a href="/settings"><span class="emojis">&#9881;</span>&nbsp;
      <?php echo $_SESSION['LANG'][7]; ?>...
    </a>
    <a href="/news/"><span class="emojis">🗞️</span>&nbsp;
      <?php echo $_SESSION['LANG'][9]; ?>
    </a>
    <a id="gambiwashere"></a>
    <a href="javascript:void(0)" id="mmlt" style="display: block;" onclick="moreLinks()"><span
        class="emojis">➕</span>&nbsp;
      <?php echo $_SESSION['LANG'][66]; ?>...
    </a>
    <div style="display: none;" id="menumorelinks">
      <a href="javascript:void(0)" onclick="lessLinks()"><span class="emojis">➖</span>&nbsp;
        <?php echo $_SESSION['LANG'][67]; ?>
      </a>
      <a href="/logout/"><span class="emojis">🚪</span>&nbsp;
        <?php echo $_SESSION['LANG'][48]; ?>
      </a>
      <a href="/re-tour/"><span class="emojis">🚗</span>&nbsp;Tour</a>
      <a href="/contributions/"><span class="emojis">👷</span>&nbsp;
        <?php echo $_SESSION['LANG'][11]; ?>
      </a>
    </div>
  </div>
  <span id="ViewNavButtonSpan"><button onclick="doViewNav()" type="button" id="ViewNavButton">&#9776;</button></span>
  <div class="headinglogo outsideofinputfocus"><a href="/home/"><img src="/img/logo/logo_446x446.png"
        alt="Logger-Diary Online" class="headinglogo"></a><span style="text-align: center;">
      <div class="bymarbanner">
        <?php echo $_SESSION['LANG'][3]; ?>&nbsp;<a class="bymarbanner" href="/contributions/">
          <?php echo $_SESSION['LANG'][4]; ?>
        </a>.
      </div><br>
    </span></div>
  <div id="main">
    <div class="outsideofinputfocus id=" secretmain" onclick="doHideNav()">
      <div id="focusmode-salutations">
        <br id="fixstocksamendansen">
        <h1 class="my-5" id="GreetingH"><span id="greeting">
            <?php echo $_SESSION['LANG'][1]; ?>
          </span>, <b id="usernamehighlighted">
            <?php echo htmlspecialchars($_SESSION["username"]); ?>
          </b>
          <?php echo DiaryDot() . "</h1>"; ?>
<div style="color: red; background-color: black;"><p style="font-size: 30px">Warning:</p>
<p style="font-size: 19px">Logger Diary Online will end support in Februari.</p>
  <p>To keep your diary, download the JSON code from <a href="https://logger-diary.strawmelonjuice.com/home//?api=entries-json">here</a> and wait for the rollout of the Logger-Diary App to be released, then import it there.</p>
  <p>More instructions may follow on @strawmelonjuice social media accounts.</p>
</div>
          <?php
          if (!(AccountInteraction($_SESSION["UID"], "Get", "settings", "DisableDailyStreaks", "") == "0")) {
            echo '<p align="center" id="LDDStreakNotif">';
            if ($NewDay === true) {
              echo "First time you log in today!";
            }
            if (AccountInteraction($_SESSION['UID'], "Get", "others", "loginstreak") == "0") {
              echo $_SESSION['LANG'][15] . AccountInteraction($_SESSION['UID'], "Get", "others", "dailystreakinterval") . $_SESSION['LANG'][16];
            } else {
              echo " " . $_SESSION['LANG'][17] . "<b>" . AccountInteraction($_SESSION['UID'], "Get", "others", "loginstreak");
            }
            echo '<b></p>';
            $current = AccountInteraction($_SESSION['UID'], "Get", "others", "lastknownclientdate");
            if ($current != AccountInteraction($_SESSION['UID'], "Get", "others", "LastStreakCelebration")) {
              echo (DayStreakCelebrations(AccountInteraction($_SESSION['UID'], "Get", "others", "loginstreak")));
            }
          } ?>
      </div>
      <h2 id="h2-13">
        <?php echo $_SESSION['LANG'][13]; ?>
      </h2>
    </div>
    <div class="AddEntryForm" id="AddEntryFormDiv" style="align-self: center;" align="center">
      <div id="focusmodealert" style="height: 0px; opacity: 0;">
        <form id="focussetting" action="/set.php?forward=/home/" method="POST"><label for="focusmode">
            <?php echo $_SESSION['LANG'][29]; ?> <code><?php echo $_SESSION['LANG'][27]; ?></code> <input
              name="focusmode" value="0" type="hidden"><input type="submit" value="<?php echo $_SESSION['LANG'][30]; ?>"
              id="focusmode" style="max-height: 20px;max-width: 40px; padding: 0px">
          </label><input type="button" onclick="HideFocusModeAlert()" value="<?php echo $_SESSION['LANG'][44]; ?>" style="max-height: 20px;max-width: 40px; padding: 0px" id="hidefocusmodealertbtn"></form>
        <p>
          <?php echo $_SESSION['LANG'][68] ?>
        </p>
      </div>
      <form action="/add-entry.php" id="baebadoopiiepoopiee" method="post">
        <script>
          ExampleEntry = `<?php echo RandomEntryPlaceholder(); ?>`;
        </script>
        <span id="textbox-placeholder" style="display: contents"></span>&nbsp;&nbsp;
        <button id="feelemojibutton" class="emojis" type="button">⏺️</button>&nbsp;&nbsp;
    <section id="selection-outer" class="empty" style="display: none"><input type="hidden" name="new_entry_feel" id="feelemojiinput" REQUIRED max="1" value="⏺️"></section>
        <input type="submit" id="writedown" class="button-like" value="<?php echo $_SESSION['LANG'][24]; ?>">
      </form>
    </div>
    <?php
    if ($theme == 'framework') {
      // Framework Theme code start
      AccountInteraction($_SESSION["UID"], "Write", "settings", "FocusNewEntries", "0");
      // Framework Theme code end
    }
    ?>
    <span style="display: none" id="ImOnlyHereForYou"></span>
    <div class="outsideofinputfocus">
      <h2>
        <?php echo $_SESSION['LANG'][14]; ?>
      </h2>
      <div class="readback" align="center">
        <span id='ShowEntriesBtn'>
          <p style="vertical-align:bottom"><br>
            <text style="font-size: 2em" class="translatable" data-translation_1="25" data-translation_2="1"></text>&nbsp;
            <img src="/img/animated/1485.gif" class="svgrecolor" width="30em" style="display: inline-block">
          </p>
          <p id="ponsloe" style="font-size: 1.2em"><img src="/img/animated/1484.png" class="svgrecolor" width="20em" style="display: inline-block"></p>
          <input type='button' onclick='tableFromJson()' id="bonsloe" disabled value='<?php echo $_SESSION['LANG'][26]; ?>' style="opacity: 10%; transition: opacity 3s ease-in 0s;">
        </span>

        <span id='showData' id="readbacktable" class="readback" align="center"></span>
      </div>
    </div>
    <script defer type="javascript">
          ParseEntryTimestamps()
        </script>
  </div>
  <footer class="infofooter">
    <hr>
    <p>
      <?php echo $LoggerInfo; ?>
    </p>
  </footer>

  <?php if (AccountInteraction($_SESSION["UID"], "Get", "settings", "FocusNewEntries", "") == "1") {
    echo <<<'GO'
  <script>
    const focusmode = 1;
  </script>
  GO;
  } else {
    echo <<<'GO'
  <script>
    const focusmode = 0;
  </script>
  GO;
  }
  $last_commit_ID = trim((shell_exec('git rev-parse --short HEAD')));
  ?>
  <?php
  if ($prod) {
    echo ("<script src=\"https://cdn.jsdelivr.net/combine/gh/strawmelonjuice/logger-diary-online@{$last_commit_ID}/public/js/site.min.js,gh/strawmelonjuice/logger-diary-online@{$last_commit_ID}/public/js/theme.min.js,npm/hl-img@{$_ENV['HLimgVersion']}/hl-img.min.js\"></script>");
  } else {
    echo <<<YEAG
  <script src="/js/site.js"></script>
  <script src="/js/theme.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/hl-img@latest/hl-img.js"></script>
  YEAG;
  }
  ?>
</body>
<?php
if ($previewtheme) {
  echo <<<YE
  <script defer>
    // document.getElementById("ViewNavButton").style.display = "none";
    document.getElementById("writedown").setAttribute("disabled", "1");
    document.getElementsByClassName("infofooter")[0].style.display = "none";
    setInterval(function () {
    if ((typeof (document.getElementById("bmc-wbtn")) !== 'undefined') && ((document.getElementById("bmc-wbtn")) !== null)) {
      (document.getElementById("bmc-wbtn")).style.display = "none";
      (document.getElementById("bmc-wbtn")).remove;
    } else {
        console.log("could not find bmc");
    }
  }, 1500);
  getLang(50, 10, 1, function (translation) {
    document.getElementById("GreetingH").innerText = translation;
  });
  var linko = document.getElementsByTagName("a");
  for (var i = linko.length - 1; i >= 0; i--) {
    if ((linko[i].getAttribute("href")) != "") {
      linko[i].setAttribute("href", "javascript:void()");
    }}
  </script>
YE;
} ?>
</html>
