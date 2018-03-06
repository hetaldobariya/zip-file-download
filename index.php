<form name="zips" method="post" >
	<table border="2" width="50%">
		<tr>
			<th>*</th>
			<th>File Type</th>
			<th>File Name</th>
		</tr>
		
		<tr>
			<td><input type="checkbox" name="files[]" value="11nsi_a.jpg" /></td>
			<td><img src="11nsi_a.jpg"  width="100px" /></td>
			<td>11nsi_a.jpg</td>
		</tr>
	
		<tr>
			<td><input type="checkbox" name="files[]" value="indian-001.jpg" /></td>
			<td><img src="indian-001.jpg"  width="100px" /></td>
			<td>indian-001.jpg</td>
		</tr>

		<tr>
			<td><input type="checkbox" name="files[]" value="jagar-uttrakhand.jpg" /></td>
			<td><img src="jagar-uttrakhand.jpg" width="100px"  /></td>
			<td>jagar-uttrakhand.jpg</td>
		</tr>

		<tr >
			<td colspan='3' align="center">
				<input type="submit" name="createpdf" value="Download as ZIP" />&nbsp;
				<input type="reset" name="reset"  value="Reset" />		
			</td>
		</tr>
	
</form>
 
<?php
	
	$error = ""; //error holder

	if(isset($_POST['createpdf']))
	{
		//$post = $_POST;
		$file_folder = ""; // folder to load files
	
		if(extension_loaded('zip'))
		{
			// Checking ZIP extension is available
			if(isset($_POST['files']) && count($_POST['files']) > 0)
			{
			
				// Checking files are selected
				$zip = new ZipArchive(); // Load zip library
				$zip_name = time().".zip"; // Zip name
				
				if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE)
				{
	 				// Opening zip file to load files
					$error .= "* Sorry ZIP creation failed at this time";
				}
	
				foreach($_POST['files'] as $file)
				{
					$zip->addFile($file_folder.$file); // Adding files into zip
				}
					$zip->close();
				
				if(file_exists($zip_name))
				{
					// push to download the zip
					header('Content-type: application/zip');
					header('Content-Disposition: attachment; filename="'.$zip_name.'"');
					readfile($zip_name);
					// remove zip file is exists in temp path
					unlink($zip_name);
				}

			}
			else
				$error .= "* Please select file to zip ";
		}
		else
		$error .= "* You dont have ZIP extension";
	}
?>