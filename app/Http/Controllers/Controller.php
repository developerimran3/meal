<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * Unique Name Generator 
     */
    protected function uniqueFileName($file = null)
    {

        if ($file) {
            $uniqueName =  md5(rand(1000, 100000) . '_' . time() . '_' . str_shuffle("abcde")) . "." . $file->getClientOriginalExtension();
        } else {
            $uniqueName =  md5(rand(1000, 100000) . '_' . time() . '_' . str_shuffle("abcde"));
        }

        return $uniqueName;
    }


    /**
     * File Upload Method
     */
    protected function fileUpload($file = null, $path = 'media')
    {

        if ($file) {
            // generate a unique filename 
            $fileName = $this->uniqueFileName($file);

            // upload file to path
            $file->move(public_path($path), $fileName);

            // return file name
            return $fileName;
        }

        return false;
    }

    /**
     * Make Slug
     */
    protected function makeSlug($title)
    {
        // convert to lowercase
        $slug = strtolower($title);

        // replace any non letter or digit with a dash
        $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug);

        // trim dashes from both ends
        $slug = trim($slug, '-');

        return $slug ?: 'n-a'; // fallback if slug is empty
    }
}
