<HTML>
<BODY>
<link rel="icon" href="favicon.ico" type="image/png" />
<table width = 100%>
<tr>
<td align = "left">
<font face = "Monotype Corsiva"  color = #6699FF size = "+4">
<img src= "http://i88.photobucket.com/albums/k163/ebonivy/hearts.jpg"/><b><i> Romance in Azeroth </font></b></i></td>
</b></i></td>
<td align = "right">
<?php if(isset($_SESSION['currentUser'])){ ?>
<a href = "index.php">Home</a> | 
<a href = "search_characters.php">Search</a> | 
<a href = "friends.php">Friends</a> | 
<a href = "profile_characters.php">Characters</a> | 
<a href = "logout.php">Logout</a>
<?php } else { ?>
<a href = "index.php">Home</a> | 
<a href = "search_characters.php">Search</a> | 
<a href = "registerForm.php">Register</a> | 
<a href = "loginForm.php">Login</a>
<?php } ?>
</tr>
</table>
<hr/>
</HTML>
</BODY>
