<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    /**
     * @param  \Illuminate\Http\UploadedFile $file
     * @param  string|array $path
     * @param  string $name
     * @param  bool $public - Append public prefix to directory
     * @return string - Name of the file or false
     */
    public function upload($file, $path, $name = '', $public = true)
    {
        try {
            return $this->processUpload($file, $path, $name, $public);
        } catch (\Exception $e) {
            report($e);

            return false;
        }
    }

    /**
     * @param  string|array $paths
     * @return bool
     */
    public function delete($paths)
    {
        return Storage::delete($paths);
    }

    /**
     * @param  string|array  $paths  - files to delete
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string|array  $path
     * @param  string  $name
     * @param  bool  $public - Append public prefix to directory
     * @return string - Name of the file or false
     */
    public function uploadAndDelete($paths, $file, $path, $name = '', $public = true)
    {
        $name =  $this->upload($file, $path, $name, $public);

        $this->delete($paths);

        return $name;
    }

    /**
     * @param  string  $old - file path
     * @param  string  $new - directory
     * @return void
     */
    public function move($old, $new)
    {
        $file = pathinfo($old, PATHINFO_BASENAME);

        $old = str_replace('storage', 'public', $old);

        Storage::disk('local')->move($old, "public/$new/$file");
    }

    /**
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $path
     * @param  string  $name
     * @param  bool  $public - Append public prefix to directory
     * @return string - Name of the file/files
     */
    private function processUpload($file, $path, $name, $public)
    {
        if ($public === true) {
            $path = "public/$path";
        }

        $this->makeDirectory($path);

        if (is_array($file)) {
            return $this->processMultipleFileUploads($path, $file, $name);
        }

        return $this->processSingleFileUpload($path, $file, $name);
    }

    /**
     * @param  string  $path
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $name
     * @return string
     */
    private function processSingleFileUpload($path, $file, $name) {
        return $file->storeAs(
            $path,
            $this->getFileNameWithExtension($file, $name)
        );
    }

    /**
     * @param  string  $path
     * @param  array  $files
     * @param  string  $name
     * @return array - Names of the uploaded files
     */
    private function processMultipleFileUploads($path, $files, $name) {
        $uploadedFiles = [];

        foreach ($files as $file) {
            $uploadedFiles[] = $this->processSingleFileUpload($path, $file, $name);
        }

        return $uploadedFiles;
    }

    /**
     * Makes directory if it does not exist
     *
     * @param  string  $path
     * @return void
     */
    private function makeDirectory($path)
    {
        if (! Storage::exists($path)) {
            Storage::makeDirectory($path);
        }
    }

    /**
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $name
     * @return string - File name with extension
     */
    private function getFileNameWithExtension($file, $name) {
        if ($name === '') {
            return $file->hashName();
        }

        return $name;
    }
}
