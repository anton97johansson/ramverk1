<?php

namespace Anax\View;

?>
<form>
    <fieldset>
    <legend>Try ip adress</legend>

    <p>
        <label>Adress:<br>
        <input type="text" name="ipAdress"/ required>
        </label>
    </p>

    <p>
        <input type="submit">
        <!-- <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button> -->
    </p>
    </fieldset>
</form>

<p><?=$check?></p>
<p><?=$hostname?></p>
