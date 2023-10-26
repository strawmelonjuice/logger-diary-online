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
</head>

<body>
  <div id="theLoggerNav" class="sidenav"><a href="javascript:void(0)" class="closebtn" onclick="doHideNav()">&times;</a>
    <a href="/home/"><span class="emojis">🏠</span>&nbsp;
      <?php echo $_SESSION['LANG'][6]; ?>
    </a>
    <a href="/settings"><span class="emojis">&#9881;</span>&nbsp;
      <?php echo $_SESSION['LANG'][7]; ?>...
    </a>
    <a href="/news/"><span class="emojis">🗞️</span>&nbsp;
      <?php echo $_SESSION['LANG'][9]; ?>
    </a>
    <a href="/logout/"><span class="emojis">🚪</span>&nbsp;
      <?php echo $_SESSION['LANG'][48]; ?>
    </a>
  </div>
  <span id="ViewNavButtonSpan"><button onclick="doViewNav()" type="button" id="ViewNavButton">&#9776;</button></span>
  <div class="headinglogo outsideofinputfocus"><a href="/home/"><img src="/img/logo/logo_446x446.png"
        alt="Logger-Diary Online" class="headinglogo"></a><span style="text-align: center;">
      <div class="bymarbanner">
        <?php echo $_SESSION['LANG'][3]; ?>&nbsp;<a class="bymarbanner" href="/contributions/">
          <?php echo $_SESSION['LANG'][4]; ?>
        </a>.
      </div>
    </span></div>
  <div id="main">
    <div class="AddEntryForm" id="AddEntryFormDiv" style="align-self: center;" align="center">
      <h2 id="dieh2"><text class="translatable" data-translation_1="tour" data-translation_2="0" data-translation_3="1">Are you new
          here?</text></h2>
    </div>
    <div class="readback" align="center">












      <div id="ViewnPage"></div>

      <div class="hidden-tourpages" id="hidden-tourpage-1">
        <h1><text class="translatable" data-translation_id="5">Welcome to</text> Logger-Diary Online!</h1>
        <p><text class="translatable" data-translation_1="tour" data-translation_2="1" data-translation_3="1">Hello and
            welcome to LDo! Before you start, might we offer you a quick tour?</text></p>
        <ul>
          <a href='#2'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="0"
                data-translation_3="2">Next</text></li>
          </a>
          <a href='#final'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="0"
                data-translation_3="3">Skip tour</text></li>
          </a>
        </ul>
      </div>

      <div class="hidden-tourpages" id="hidden-tourpage-2">
        <h1><text class="translatable" data-translation_1="tour" data-translation_2="2" data-translation_3="3">Creating new logger entries</text> (1/4)</h1>
        <p><text class="translatable" data-translation_1="tour" data-translation_2="2" data-translation_3="1">Okay. See
            this?</text></p>
        <p><hl-img src="/img/tour/2023011701.webp" alt="New entry bar" width="90%"></hl-img></p>
        <p><text class="translatable" data-translation_1="tour" data-translation_2="2" data-translation_3="2">This is
            very much alike what you'll see on the homepage.</text></p>
        <ul>
          <a href='#3'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="0"
                data-translation_3="2">Next</text></li>
          </a>
          <a href='#1'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="0"
                data-translation_3="4">Back</text></li>
          </a>
          <a href='#final'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="0"
                data-translation_3="3">Skip tour</text></li>
          </a>
        </ul>
      </div>

      <div class="hidden-tourpages" id="hidden-tourpage-3">
        <h1><text class="translatable" data-translation_1="tour" data-translation_2="2" data-translation_3="3">Creating new logger entries</text> (2/4)</h1>
        <p><text class="translatable" data-translation_1="tour" data-translation_2="3" data-translation_3="1">Your
            journey starts at what the big red arrow is pointing at.</text></p>
        <p><hl-img src="/img/tour/2.png" alt="New entry bar" width="90%"></hl-img></p>
        <p><text class="translatable" data-translation_1="tour" data-translation_2="3" data-translation_3="2">That's
            where you'll write in. Now of course, you understood</text><i><text class="translatable"
              data-translation_1="tour" data-translation_2="3" data-translation_3="3">that</text></i><text
            class="translatable" data-translation_1="tour" data-translation_2="3" data-translation_3="4">that already.
            What next?</text></p>
        <ul>
          <a href='#4'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="0"
                data-translation_3="2">Next</text></li>
          </a>
          <a href='#2'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="0"
                data-translation_3="4">Back</text></li>
          </a>
          <a href='#final'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="0"
                data-translation_3="3">Skip tour</text></li>
          </a>
        </ul>
      </div>

      <div class="hidden-tourpages" id="hidden-tourpage-4">
        <h1><text class="translatable" data-translation_1="tour" data-translation_2="2" data-translation_3="3">Creating new logger entries</text> (3/4)</h1>
        <p><text class="translatable" data-translation_1="tour" data-translation_2="4" data-translation_3="1">This small
            button with the "⏺️" is what I like to call the feel selector button.</text></p>
        <p><hl-img src="/img/tour/2023011702.webp" alt="Feel selector button"></hl-img></p>
        <p><text class="translatable" data-translation_1="tour" data-translation_2="4" data-translation_3="2">Click on it to select an emoji that shows how you feel with what you wrote. You can also leave it to be dots if you don't know what feeling to fill in.</text></p>
        <ul>
          <a href='#5'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="0"
                data-translation_3="2">Next</text></li>
          </a>
          <a href='#3'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="0"
                data-translation_3="4">Back</text></li>
          </a>
          <a href='#final'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="0"
                data-translation_3="3">Skip tour</text></li>
          </a>
        </ul>
      </div>


      <div class="hidden-tourpages" id="hidden-tourpage-5">
        <h1><text class="translatable" data-translation_1="tour" data-translation_2="2" data-translation_3="3">Creating new logger entries</text> (4/4)</h1>
        <p><text class="translatable" data-translation_1="tour" data-translation_2="5" data-translation_3="1">When you feel like you're ready, hit that submit button and write your entry down!</text></p>
        <p><hl-img src="/img/tour/2023011703.webp" alt="Write down button"></hl-img></p>
        <p><text class="translatable" data-translation_1="tour" data-translation_2="5" data-translation_3="2">Now it'll show up right here, look!</text></p>
        <p><hl-img src="/img/tour/3.png" alt="Read back table" width="90%"></hl-img></p>
        <ul>
          <a href='#6'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="0"
                data-translation_3="2">Next</text></li>
          </a>
          <a href='#4'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="0"
                data-translation_3="4">Back</text></li>
          </a>
          <a href='#final'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="0"
                data-translation_3="3">Skip tour</text></li>
          </a>
        </ul>
      </div>
    


      <div class="hidden-tourpages" id="hidden-tourpage-6">
        <h1><text class="translatable" data-translation_1="tour" data-translation_2="6" data-translation_3="1">Customisation</text> (1/1)</h1>
        <p><text class="translatable" data-translation_1="tour" data-translation_2="6" data-translation_3="2">On the settings screen</text></p>
        <div style="height: 20vw; overflow: clip;">
          <p><hl-img src="/img/tour/4.png" alt="Menu to settings"></hl-img></p>
        </div>
        <p><hl-img src="/img/tour/ndsjbcsnewio.png" alt="Settings screen" width="90%"></hl-img></p>
        <p><text class="translatable" data-translation_1="tour" data-translation_2="6" data-translation_3="3">You can set various things, like themes (as you might've noticed in the above screenshots), the length of your entries textbox,  FOCUSMODE, and more!</text></p>
        
        <ul>
          <a href='#7'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="0"
                data-translation_3="6">Finish tour</text></li>
          </a>
          <a href='#5'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="0"
                data-translation_3="4">Back</text></li>
          </a>
        </ul>
      </div>

      <div class="hidden-tourpages" id="hidden-tourpage-7">
        <h1><text class="translatable" data-translation_1="tour" data-translation_2="0" data-translation_3="7">Tour is finished</text> <span class="emojis">🎊</span></h1>
        <ul>
          <a href='/home/'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="7"
                data-translation_3="1">Go to homepage</text></li>
          </a>
          <a href='/settings/'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="7"
                data-translation_3="2">Go to settings</text></li>
          </a>
          <a href='/themes/'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="7"
                data-translation_3="3">set a theme</text></li>
          </a>
          <a href='#1'>
            <li class="button-like"><text class="translatable" data-translation_1="tour" data-translation_2="0"
                data-translation_3="4">Back</text></li>
          </a>
        </ul>
      </div>

      <div class="hidden-tourpages" id="hidden-tourpage-final2">
        <p><a href="/home/"><button type="button" height="100px">
              <h1 align="center">GO!</h1>
            </button></a></p>
        <p><a href="/themes/"><button type="button" height="100px">
              <h2 align="center"><text class="translatable" data-translation_id="35">Change your logger-theme</text>
              </h2>
            </button></a></p>
      </div>

      <style>
        li.button-like {
          list-style: none;
          /* width: 40%; */
          width: 90%;
          text-align: end;
          margin-bottom: 5px;
        }
      </style>










      <footer class="infofooter">
        <hr>
        <p>
          <?php echo $LoggerInfo; ?>
        </p>
      </footer>
    </div>

    <?php
    if ($prod) {
      echo ("<script src=\"https://cdn.jsdelivr.net/combine/gh/strawmelonjuices-logger-diary/online@{$last_commit_ID}/public/js/site.min.js,gh/strawmelonjuices-logger-diary/online@{$last_commit_ID}/public/js/theme.min.js,gh/strawmelonjuices-logger-diary/online@{$last_commit_ID}/public/js/tour.min.js,npm/hl-img@{$_ENV['HLimgVersion']}/hl-img.min.js\"></script>");
    } else {
      echo <<<YEAG
  <script src="/js/site.js"></script>
  <script defer src="/js/theme.js"></script>
  <script defer src="/js/tour.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/hl-img@latest/hl-img.js"></script>
  YEAG;
    }
    ?>
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
</body>

</html>