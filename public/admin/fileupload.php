<?phprequire_once('../../includes/initialize.php');header('Content-Type: text/html; charset=utf-8');//print_r($session);if (!$session->is_admin()) { redirect_to("../index.php"); }if(isset($_FILES['inputfile']['name'])){//	$uploaddir = "/Applications/MAMP/tmp/php/";	$inputfile = UPLOAD_DIR.DS.$_FILES['inputfile']['name'];//	echo $inputfile."   ";//	echo $_FILES['inputfile']['tmp_name'];	if(move_uploaded_file($_FILES['inputfile']['tmp_name'],$inputfile)) {		$handle = fopen($inputfile, "r");		if(!isset($handle)) echo "can not open file";    		while (($buffer = fgets($handle)) !== false) {//	$record = array('refcode'=>'', 'authors'=>'', 'journal'=>'', 'vol'=>'', 'issue'=>'', 'pages'=>'', 'year'=>'', 'title'=>'', 'lang'=>'', 'key'=>'');		$rec = explode(chr(9), $buffer);	if(Isotopes::is_isotope($rec[1]) != 0) {//readdata		$record['refcode'] = $rec[0];		$record['isocode'] = $rec[1];		$record['source'] = $rec[2];		if(trim($rec[3]) != '') {$record['stemp'] = $rec[3];} else {$record['stemp'] = NULL;}		$record['absorber'] = $rec[4];		if(trim($rec[5]) != '') $record['atemp'] = $rec[5]; else $record['atemp'] = NULL;		if(trim($rec[6]) != '') $record['ishift'] = $rec[6]; else $record['ishift'] = NULL;		if(trim($rec[7]) != '') $record['qsplit'] = $rec[7]; else $record['qsplit'] = NULL;		$record['ecomments'] = $rec[8];		$record['keywords'] = $rec[9];		$dat = Data::instantiateit($record);		if(!$dat->record_exists()) $dat->create();		}		else {			//read refs//		$record = array('refcode'=>'{$rec[0]}', 'authors'=>'{$rec[0]}', 'journal'=>'{$rec[0]}', 'vol'=>'{$rec[0]}', 'issue'=>'{$rec[0]}', 'pages'=>'{$rec[0]}', 'year'=>'{$rec[0]}', 'title'=>'{$rec[0]}', 'lang'=>'{$rec[0]}', 'key'=>'{$rec[0]}');		$record['refcode'] = $rec[0];		$record['authors'] = $rec[1];		$record['journal'] = $rec[2];		$record['vol'] = $rec[3];		$record['issue'] = $rec[4];		$record['pages'] = $rec[5];		$record['year'] = $rec[6];		$record['title'] = $rec[7];		$record['lang'] = $rec[8];		$record['keywords'] = $rec[9];		$ref = References::instantiateit($record);		if(!$ref->record_exists()) $ref->create(); 		}/*	list($refcode, $authors, $journal, $vol, $issue, $pages, $year, $title, $lang, $key) = split(chr(9), $buffer);		$query = "INSERT INTO refs            ( refcode, authors, journal, vol, issue, pages, year, title, lang, keywords)            VALUES (\"{$refcode}\", \"{$authors}\", \"{$journal}\", \"{$vol}\", \"{$issue}\", \"{$pages}\", \"{$year}\", \"{$title}\", \"{$lang}\", \"{$key}\" )";//			echo $query;		$result = mysql_query($query, $connection); 	echo "<br/> {$result} <br/>";		if(!$result)	{ die("Database query failed: " . mysql_error()); }*/			}	// of while			fclose($handle);				unset($_FILES['inputfile']['name']);			}  // if move_uploaded		}	// if is_set	?><?php include_layout_template('admin_header.php'); ?>	<h2>Menu</h2>	<a href="../index.php"> User menu</a> </br>	<a href="listusers.php" /a>List users</a>		</br>	<a href="edituser.php" /a>New user</a>	</br>	</br>	<form action="fileupload.php" enctype="multipart/form-data" method="post">		<input type="hidden" name="MAX_FILE_SIZE" value="50000" />		<p> File name:</p>		<input type="file" name="inputfile" size="20" />		<input type="submit" value="Upload" />						</form><?php include_layout_template('admin_footer.php'); ?>		