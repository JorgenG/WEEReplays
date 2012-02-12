<?php

if (isset($_SESSION['valid_user'])) {
    
} else {
    echo "<form name='login' method='post' action='index.php'>";
    echo "<table class='logintable'><tr><td colspan='2'>";
    echo "<p>Login below</p></td></tr><tr>";
    echo "<td class='logincolumn'>";
    echo "<p>Username:</p>";
    echo "</td>";
    echo "<td class='logincolumn'>";
    echo "<input type='text' size='12' maxlength='12' name='username'>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='logincolumn'>";
    echo "<p>Password</p>";
    echo "</td>";
    echo "<td class='logincolumn'>";
    echo "<input type='password' size='12' maxlength=12' name='password'>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    echo "</form>";
}
?>