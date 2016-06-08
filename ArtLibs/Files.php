<?php

namespace ArtLibs;


class Files
{
    /**
     * @param $filename
     * @return mixed
     */
    public static function getFileExt($filename)
    {
        $r = explode(".", $filename);
        return strtolower($r[sizeof($r) - 1]);
    }

    /**
     * @param $app
     * @return string
     */
    public static function setUploadDir($app)
    {
        $user_var = $app->getConfManager()->getUserVar();
        $file_dir = ($user_var['files_dir'] == "") ? "." : $user_var['files_dir'];

        if (!is_dir($file_dir)) {
            if (!mkdir($file_dir, 0777, true)) {
                $app->getErrorManager()->addMessage("Error creating file upload directory");
            }
        }

        return $file_dir;
    }

    /**
     * @param $name
     * @param $app
     * @return string
     */
    public static function setProperPath($name, $extension, $app)
    {
        $user_info = $app->getSession()->get('user_info');
        $id = $user_info['id'];
        if (isset($id)) {
            $name = $id . date('_d_m_y_H_i_s_') . $name;
        }

        $chars = array(" ", "/", "\\", "<", ">", ":", "\"", "|", "?", "*", "-");
        return strtolower(str_replace($chars, "_", $name) . "." . $extension);
    }

    /**
     * @param $name
     * @return string
     */
    public static function setProperName($name)
    {
        $chars = array(" ", "/", "\\", "<", ">", ":", "\"", "|", "?", "*", "-");
        return strtolower(str_replace($chars, "_", $name));
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
     * @param $app
     * @param $name
     * @param null $state
     * @return null
     */
    public static function getFile($app, $name, $state = null)
    {
        if ($state !== null) {
            $cond['state'] = $state;
        }

        $cond['name'] = $name;

        try {
            $query = $app->getDataManager()->getDataManager()->from("files")
                ->where($cond)
                ->fetch();
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return null;
        }

        return $query;
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
        if (!isset($state) || !isset($fid)) {
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

/**
 * An open source web application development framework for PHP 5.
 * @author        ArticulateLogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2014 ArticulateLogic Labs
 * @license       MIT License
 */