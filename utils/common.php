<?php
    /*
     * common.php 
     * is intended to collect any functions and variables
     * that is used for general purpose
     * and has no relationship with any files in /utils
     * 
     * 
     */

    /*
     * almost similar with "isset()",
     * but, areSet() treat first parameter as array,
     * and check each value of array[key]
     */
    function areSet($arr, $keys) {
        foreach ($keys as $key) {
            if (!isset($arr[$key])) {
                return false;
            }
        }
        return true;
    }  
?>