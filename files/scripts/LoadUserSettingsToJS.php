<?php
    require_once(__DIR__ . '/AccountInteractions.php');
    if ((AccountInteraction($_SESSION['UID'],"Get","settings","zoomdiffer","")) == "") {
        AccountInteraction($_SESSION['UID'],"Write","settings","zoomdiffer","0");
    }
    if ((AccountInteraction($_SESSION['UID'], "Get", "settings", "relativetimes", "")) == "") {
        AccountInteraction($_SESSION['UID'], "Write", "settings", "relativetimes", "1");
    }
    $_SESSION["usersetting"] = array(
        "relativetimes" => $relativetimes,
        "zoomdiffer" => $zoomdiffer,
        "LongEntries" => $LongEntries,
    );
?>
    <script>
        var usersetting = JSON.parse(`<?php echo(AccountInteraction($_SESSION['UID'], "Get", "settings", "", "all_json")) ?>`);
    </script>