<?php

require_once('models/db_connection.php');

/**
 * A collection of functions for verifying and dealing with the upload of images.
 */

function userOrDefaultImage($file, $db) {
	if (is_uploaded_file($file)) {
		return 1;
       //readfile($_FILES["fileToUpload"]['tmp_name']);
    } else { return 0; }
}

// ------------------------------------------------------------------
// Check if image file is a actual image or fake image.
// @param db a valid database connection
// @param temp the file's temporary name
// @return whether or not the file is an actual image
// -------------------------------------------------------------------
function validImage($temp, $db) {
	$check = getimagesize($temp);
	if($check !== false) { return 1; } 
	else { return 0; }
}

// ------------------------------------------------------------------
// Check if file does not exists.
// @param db a valid database connection
// @param path the file's designated path
// @return whether or not the image already exists
// -------------------------------------------------------------------
function imageDoesNotExists($path, $db) { 
    if (file_exists($path)) { return 0; }
    else { return 1; }
}

// ------------------------------------------------------------------
// Check file size
// @param db a valid database connection
// @param path the file size
// @return whether or not the size is valid
// -------------------------------------------------------------------
function validFileSize($size, $db) {
	if ($size > 500000) { return 0; }
	else { return 1; }
}

// ------------------------------------------------------------------
// Allow certain file formats
// @param db a valid database connection
// @param imageFileType the file's path
// @return whether or not the format is valid
// -------------------------------------------------------------------
function validFileType($imageFileType, $db) {
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "svg") { return 0; }
    else { return 1; }
}

// ------------------------------------------------------------------
// Attempts to upload an image
// @param db a valid database connection
// @param temp the file's temporary name
// @param path the designated file path
// @return whether or not the upload was a success
// ------------------------------------------------------------------
function uploadSuccess($upload, $temp, $path, $db) {
	if ($upload == 0) { return false; }
	else {
	    if (move_uploaded_file($temp, $path)) { return true; }
	    else { return false; }
	}
}

// ------------------------------------------------------------------
// Check if adding the image was a success
// @param db a valid database connection
// @param valid whether or not the file is an image
// @param exists whether or not the destined path is available
// @param size whether or not the size does not exceed limit
// @param type whether or not the file type is valid
// @return whether or not the upload was a success
// ------------------------------------------------------------------
function success($valid, $exists, $size, $type, $db) {
	if ($valid == 1 && $exists == 1 && $size == 1 && $type == 1) { return 1; }
	else { return 0; }
}