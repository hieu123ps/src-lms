<?php

	/* Read a file coding */
	$language = strtolower($_POST['language']);
	$code = $_POST['code'];

	$random = substr(md5(mt_rand()), 0, 7);
	$filePath = "temp/".$random .".".$language;
	$programFile = fopen($filePath, "w");
	fwrite($programFile, $code);
	fclose($programFile);

	/* Read a file test*/
		/* first line is number of test*/
		/* next line is path of file test*/
		/* last line is @ - its mean the end of file */
		/* struct of file test */
			/* test {number}.txt*/
				/* test inp */
				/* newline */
				/* test out */
		/*save test inp to variable {test_inp}*/
		/*save test out to variable {test_out}*/


	/* Run code and save to variable */
	switch ($language) {
		case "py":
			$output = shell_exec("C:\Python310\python.exe $filePath 2>&1");
			break;
		case "cpp":
			$output = shell_exec("C:\MinGW\bin\g++.exe $filePath 2>&1"); 
		
		default:
			// code...
			break;
	}
		/* run code with all test and save to array */

	/*Check a result*/
		/*comp test_out == output
			if it is equal --> plus one score
		*/


?>