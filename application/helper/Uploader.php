<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class Uploader {

    private
            //the name of the array that hold files data
            $name = 'attachs',
            //allowed files types
            $allowed = ['jpg','png', 'zip', 'txt', 'doc', 'docx'],
            //allowed mime types for a little more security
            $mime = ['image/jpeg', 'image/png', 'application/zip', 'text/plain', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
            //an array to hold the files instead of $_FILES['name'];
            $files,
            //the destination of uploaded files
            $destination = ROOT . "public/attachment/",
            //max size per file - 50bytes by default
            $maxSize = 51200,
            //max files to upload at once
            $maxFiles = 5,
            //is multi-language display available ?
            $multiLanguages = true,
            //to prevent empty files from being uploaded
            $preventEmpty = true,
            //the maximum name length of files to keep
            $lengthCap = 50,
            //hold the a particular file extension
            $currExt;
    public
            //hold the succeeded files
            $success = [],
            //hold the failed files
            $fail = [];

    /**
     * initialise the basic variables - works only with BloodStone community
     */
    public function __construct()
    {
        //fetch basic data
            //-get max size
            $this->maxSize = intval(variablesAPI::getInstance()->getVariableValue('limit', 'attchSize')) * 1024;
            //-get maximum files number
            $this->maxFiles = intval(variablesAPI::getInstance()->getVariableValue('limit', 'attachMaxFiles'));
    }

    /** the process of checking and uploading files - works only with BloodStone community
     * @return bool
     */
    public function uploadFiles()
    {
        //if there's files has been sent
        if (!empty($_FILES[$this->name]['name']))
        {
            $this->files = $_FILES[$this->name];
            //the counter of processed files
            $x = 0;
            foreach ($this->files['name'] as $index => $name)
            {
                //check current file for requirement
                $checkResult = $this->checkFile($index);
                //if the check ended correctly and there's no uploading error
                if ($checkResult === true && $this->files['error'][$index] == 0) {
                    //ignore the rest if reach the maximum files number !
                    if (++$x > $this->maxFiles)
                    {
                        //add an error for the array
                        $this->fail[] = ["name" => $name, "size" => $this->getReadableSize($this->files['size'][$index]), "error" => $this->getMaxFileError()];
                        continue;
                    }
                    //generate a valid name
                    $newName = $this->generateName($name);
                    //for in-thread display purpose - cut the name length
                    if (isset($name[35]))
                         $name = mb_substr($name, 0, 30, 'UTF-8').'[...]';
                    //move the file to the destination
                    if (move_uploaded_file($this->files['tmp_name'][$index], $this->destination . $newName) === true)
                        //succeed
                        $this->success[] = ["name" => $name, "newName" => $newName, "size" => $this->getReadableSize($this->files['size'][$index])];
                    else
                        //fail
                        $this->fail[] = ["name" => $name, "size" => $this->getReadableSize($this->files['size'][$index]), "error" => "upload failed !"];
                } else {
                    //if there's a requirements error add the file to the failed array
                    if (isset($name[35]))
                        $name = mb_substr($name, 0, 30, 'UTF-8').'[...]';
                    $this->fail[] = ["name" => $name, "size" => $this->getReadableSize($this->files['size'][$index]), "error" => $checkResult];
                }
            }
        }else{
            //if no file has been sent
            return false;
        }
    }

    /** check files for requirements - works only with BloodStone community
     * @param $index
     * @return array|bool|null|string
     */
    public function checkFile($index)
    {
        //load language if needed
        if ($this->multiLanguages)
            Controller::$language->load('helper/upload');
        //check for errors
            //disallowed file type
            $this->currExt = $this->parseFileName($this->files['name'][$index]);
            //check extension and mime type
            if (!in_array($this->currExt, $this->allowed) || !in_array($this->files['type'][$index], $this->mime))
                return ($this->multiLanguages) ? language::invokeOutput('error/type') : 'bad file type';
            //exceeded file size
            if ($this->files['size'][$index] > $this->maxSize)
                return ($this->multiLanguages) ? language::invokeOutput('error/size') : 'exceeded limited size';
            //if empty file
            if($this->preventEmpty && $this->files['size'][$index] == 0)
                return ($this->multiLanguages) ? language::invokeOutput('error/empty') : 'empty files are prevented';
        //if no errors founded
        return true;
    }

    /** render the error of reaching the maximum files number  - works only with BloodStone community
     * @return string
     */
    public function getMaxFileError()
    {
        //load language if needed
        if ($this->multiLanguages)
        {
            Controller::$language->load('helper/upload');
            return language::invokeOutput('error/maxFiles/0') . $this->maxFiles . language::invokeOutput('error/maxFiles/1');
        }
        return "you reach the maximum number of files ( {$this->maxFiles} files ) .";
    }

    /** get the name or the extension of the given file name
     * @param $fullName
     * @param bool|true $ext
     * @return string
     */
    public function parseFileName($fullName, $ext = true)
    {
        $needle = explode('.', $fullName);
        return ($ext) ? strtolower($needle[1]) : strtolower($needle[0]);
    }

    /** get a human friendly size format
     * @param $input
     * @return string
     */
    public static function getReadableSize($input)
    {
        $units = ['B', 'Kb', 'Mb', 'Gb'];
        $unit = 0;
        while ($input >= 1024 && $unit <= 3)
        {
            $input /= 1024;
            $unit++;
        }
        return round($input) . $units[$unit];
    }

    /** generate a valid name for the given file
     * @param $fileName
     * @return string
     */
    public function generateName($fileName)
    {
        //limit file name length
        $fileName = $this->parseFileName($fileName, false);
        if (isset($fileName[$this->lengthCap]))
            $fileName = mb_substr($fileName, 0, $this->lengthCap, 'UTF-8');
        //if the file name already exist
        if (file_exists($this->destination.$fileName. '.' . $this->currExt))
            return $fileName . '_' . time() . '.' . $this->currExt;
        //return the file name
        return $fileName . '.' . $this->currExt;
    }
}