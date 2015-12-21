<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class attachment extends Controller
{

    /**
     *
     */
    public function index()
    {
        //get the passed params
        $params = func_get_args();
        if (!empty($params))
        {
            $attach = attachmentAPI::getInstance()->getAttachmentById((int)$params[0]);
            if (!empty($attach)) {
                $file = ROOT.'public/attachment/'.$attach[0]->path;
                if (file_exists($file) && is_readable($file))
                {
                    header('Content-Type: text/plain');
                    header('Content-Type: application/zip');
                    header('Content-Type: image/jpeg');
                    header('Content-Type: image/png');
                    header('Content-Type: application/msword');
                    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                    header('Content-Description: File Transfer');
                    header("Content-Type: application/force-download");
                    header('Content-Disposition: attachment; filename="'. $attach[0]->path .'"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file));
                    ob_clean();
                    flush();
                    readfile($file);
                    exit;
                }
            }
        }
        //if no params passed or file not founded
        header("HTTP/1.0 404 Not Found");
        die("file not found or something went wrong.");
    }
}
