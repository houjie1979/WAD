<?phprequire_once('../../includes/initialize.php');if (!$session->is_admin()) { redirect_to("../index.php"); }$total_count = User::count_all();//$pagination = new Pagination($page, $per_page, $total_count);$found_records = User::find_all();?><?php include_layout_template('admin_header.php'); ?><ul id="navlinks">	<li><a href="../index.php"> User menu</a> </li>	<li><a href="listusers.php">List users</a></li>	<li><a href="edituser.php?newuser='new'" >New user</a></li>	<li><a href="fileupload.php" >File upload</a></li></ul><?php foreach($found_records as $record){		echo "<form action='edituser.php' method='post'>			<table>				<tr>					<td width=150>".$record->full_name()."</td>					<td width=150>".$record->dateset."</td>					<td>						<input type='hidden' name='id' value=".						$record->id.">						<input type='submit' name='edit' value='Edit'>					</td>				</tr>			</table>			</form>";		}?><?php include_layout_template('admin_footer.php'); ?>		