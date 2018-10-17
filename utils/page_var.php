<?php
    $EXPORT = array();

	/*
	 * Use this to get value of PHP variable 
	 * from html or js code 
	 */
	function getvar($var, $wrap=false) {
		global $EXPORT;
		if (!isset($EXPORT[$var])) {
			echo "null";
		} else {
			if (gettype($EXPORT[$var]) == "array") {
				echo json_encode($EXPORT[$var]);
			} else if (gettype($EXPORT[$var]) == "string") {
				if ($wrap) {
                    echo "'".$EXPORT[$var]."'";
				} else {
					echo $EXPORT[$var]; 
				}
			} else {
				echo $EXPORT[$var];
			}
		}
	}

	/*
	 * Use this to set value of PHP variable 
	 * to be used in html or js code 
	 */
	function setvar($var, $value) {
		global $EXPORT;
		$EXPORT[$var] = $value;
	}

	function embed($filename) {
		echo file_get_contents("views/addons/".$filename.".php");
	}
?>