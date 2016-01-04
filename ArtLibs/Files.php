<?php

namespace ArtLibs;


class Files
{
    /**
     * @param $filename
     * @return mixed
     */
    public static function getFileExt($filename) {
        $r = explode(".", $filename);
        return $r[sizeof($r) - 1];
    }

    /**
     * @param $app
     * @return string
     */
    public static function setUploadDir($app) {
        $file_dir = ($app->getConfManager()->getUserVar()['files_dir'] == "") ? "." : $app->getConfManager()->getUserVar()['files_dir'];

        if(!is_dir($file_dir)) {
            if(!mkdir($file_dir, 0777, true)) {
                $app->getErrorManager()->addMessage("Error creating file upload directory");
            }
        }

        return $file_dir;
    }

    public static function setProperName($name, $app) {
        $chars = array(" ", "/", "\\", "<", ">", ":", "\"", "|", "?", "*");
        $name = date('d-m-y-H-i-s-') . str_replace($chars, "_", $name);

        $id = $app->getSession()->get('user_info')['id'];
        if(isset($id)) {
            $name = $id . "-" . $name;
        }

        return $name;
    }

    /**
     * @param $app
     * @param null $state
     * @return mixed
     */
    public static function getFiles($app, $state = null)
    {
        if (!isset($state)) {
            $query = $app->getDataManager()->getDataManager()->from("files");
        } else {
            $query = $app->getDataManager()->getDataManager()->from("files")->where(array("state" => $state));
        }

        try {
            $q = $query->fetchAll();
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return null;
        }

        return $q;
    }


    /**
     * @param $fid
     * @param $app
     * @return null
     */
    public static function getFileById($fid, $app)
    {
        try {
            $query = $app->getDataManager()->getDataManager()->from("files")
                ->where(array("id" => $fid,))
                ->fetch();
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return null;
        }

        return $query;
    }


    /**
     * @param array $file_info
     * @param $app
     * @return bool
     */
    public static function addFile($file_info = array(), $app)
    {
        if (empty($file_info)) {
            return false;
        }

        $file_info['date_inserted'] = new \FluentLiteral('NOW()');

        try {
            $query = $app->getDataManager()->getDataManager()->insertInto('files')->values($file_info);
            $executed = $query->execute(true);
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return false;
        }

        return $executed;
    }


    /**
     * @param $fid
     * @param array $file_info
     * @param $app
     * @return bool
     */
    public static function updateFile($fid, $file_info = array(), $app)
    {
        if (empty($file_info) || !isset($fid)) {
            return false;
        }

        $category['date_updated'] = new \FluentLiteral('NOW()');

        try {
            $query = $app->getDataManager()->getDataManager()->update('files', $file_info, $fid);
            $executed = $query->execute(true);
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return false;
        }

        return $executed;
    }


    /**
     * @param $state
     * @param $fid
     * @param $app
     * @return bool
     */
    public static function setState($state, $fid, $app)
    {
        if (!isset($state) || !isset($category_id)) {
            return false;
        }

        try {
            $query = $app->getDataManager()->getDataManager()
                ->update('files', array('state' => $state, 'date_updated' => new \FluentLiteral('NOW()')), $fid);
            $executed = $query->execute(true);
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return false;
        }

        return $executed;
    }
}