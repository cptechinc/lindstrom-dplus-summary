<?php
	use Dplus\ProcessWire\DplusWire;

	/**
	 * Returns a template file URL with its hash value
	 * // NOTE USED FOR JS / CSS FILES
	 * @param	string $filename File to get URL and HasH for
	 * @return string				URL to file with Hash Value
	 */
	function hash_templatefile($filename) {
		$hash = hash_file(DplusWire::wire('config')->userAuthHashType, DplusWire::wire('config')->paths->templates.$filename);
		return DplusWire::wire('config')->urls->templates.$filename.'?v='.$hash;
	}

	/**
	 * Writes an array one datem per line into the dplus directory
	 * @param array  $data	   Array of Lines for the request
	 * @param string $filename Filename
	 * @return void
	*/
	function write_dplusfile($data, $filename) {
		$file = '';
		foreach ($data as $line) {
			$file .= $line . "\n";
		}
		$vard = "/usr/capsys/ecomm/" . $filename;
		$handle = fopen($vard, "w") or die("cant open file");
		fwrite($handle, $file);
		fclose($handle);
	}
