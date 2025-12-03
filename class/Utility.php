<?php

class Utility {
    public static function uploadFile($file) {
        if ($file['error'] === 0) {

            $targetDir = "../uploads/";
            $filename = time() . "_" . basename($file['name']);
            $targetPath = $targetDir . $filename;

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                return $filename;
            }
        }
        return null;
    }
}
