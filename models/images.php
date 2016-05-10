<?php

require_once('models/db_connection.php');

/**
 * A collection of functions for verifying and dealing with the upload of images.
 */

// ------------------------------------------------------------------
// Check if the user uploaded their own image or want to use the default image.
// @param temp the file's temporary name
// @return whether or not the file is an actual image
// -------------------------------------------------------------------
function userOrDefaultImage($file) {
	if (is_uploaded_file($file)) { return 1; } 
	else { return 0; }
}

// ------------------------------------------------------------------
// Check if image file is a actual image or fake image.
// @param temp the file's temporary name
// @return whether or not the file is an actual image
// -------------------------------------------------------------------
function validImage($temp) {
	$check = getimagesize($temp);
	if($check !== false) { return 1; } 
	else { return 0; }
}

// ------------------------------------------------------------------
// Check if file path does not exists.
// @param path the file's designated path
// @return whether or not the image already exists
// -------------------------------------------------------------------
function imageDoesNotExists($path) { 
    if (file_exists($path)) { return 0; }
    else { return 1; }
}

// ------------------------------------------------------------------
// Check file size
// @param path the file size
// @return whether or not the size is valid
// -------------------------------------------------------------------
function validFileSize($size) {
	if ($size > 500000) { return 0; }
	else { return 1; }
}

// ------------------------------------------------------------------
// Allow certain file formats
// @param imageFileType the file's path
// @return whether or not the format is valid
// -------------------------------------------------------------------
function validFileType($imageFileType) {
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
	if ($upload == 0 && !isset($db)) { return false; }
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
	if ($valid && $exists && $size && $type && isset($db)) { return 1; }
	else { return 0; }
}