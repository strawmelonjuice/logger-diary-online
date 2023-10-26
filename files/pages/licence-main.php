
        <div class="AddEntryForm">
            <a href="https://github.com/strawmelonjuices-logger-diary/online/blob/main/Licence.md"><h2><span class="emojis">📜</span>&nbsp;<text class="translatable" data-translation_id="78"></text></h2></a>
            <p align="center"><big><text class="translatable" data-translation_id="77"></text> Logger, <i><text class="translatable" data-translation_id="2"></text></i>!</big></p>
        </div>
        <div class="readback settingsmain">
            <div align="center" style="width: 90%">
                <?php
                echo '<p class="alert">'; Echo $_SESSION['LANG'][10]; echo '</p>';
                $Parsedown = new Parsedown();
                $Us = $Parsedown->text(file_get_contents(__DIR__."/../../Licence.md"));
                echo $Us;
                ?>
            </div>
        </div>