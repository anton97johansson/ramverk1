<?php

namespace Anax\View;

?>

<p>
    Skriv in en ipv4 eller ipv6-address för att kolla ifall ip:n validerar och ifall det finns en domän med den ip:n.
    Det finns redan också 3 länkar som är exempel på ip-addresser.
<form action="jsonip/json">
    <fieldset>
    <legend>Try ip adress</legend>

    <p>
        <label>Adress:<br>
        <input type="text" name="ip"/ required>
        </label>
    </p>

    <p>
        <input type="submit">
        <!-- <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button> -->
    </p>
    </fieldset>
</form>

<a href="jsonip/json?ip=194.47.150.9">Test 1</a> |
<a href="jsonip/json?ip=172.217.12.165">Test 2</a> |
<a href="jsonip/json?ip=31.13.71.36">Test 3</a>
