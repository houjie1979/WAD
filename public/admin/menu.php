<?phprequire_once('../../includes/initialize.php');if (!$session->is_admin()) { redirect_to("../index.php"); }?><?php include_layout_template('admin_header.php'); ?><ul id="navlinks">	<li><a href="../index.php"> User menu</a> </li>	<li><a href="listusers.php">List users</a></li>	<li><a href="edituser.php?newuser='new'" >New user</a></li>	<li><a href="fileupload.php" >File upload</a></li></ul>User menu - Quit Administrator, back to user section.<br/>List users - List of all users.<br/>New user - create new account with username and password.<br/>File upload - Upload a file of new LF separated records with TAB separated fields.<br/><?php include_layout_template('admin_footer.php'); ?>		