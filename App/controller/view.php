<?php

use ArtLibs\Controller;
use ArtLibs\Files;
use ArtLibs\User;
use ArtLibs\Article;
use ArtLibs\Category;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class Views extends Controller
{
    /**
     * @param $params
     * @param $app
     */
    public function viewHome($params, $app)
    {
        $app->setTemplateData(array(
            'title' => 'Home',
        ));

        if ($app->getRequest()->getMethod() == "POST") {
            $email = $app->getRequest()->request->get('email');
            $pass = $app->getRequest()->request->get('password');

            $user = new User($app, $email, $pass);

            if (!$user->isAuthenticated()) {
                $app->setTemplateData(array('content_message' => 'Login unsuccessful, try again.'));
                $this->display($app, 'frm_login.twig');
                return;
            } else {
                $app->setTemplateData(array('content_message' => 'Login successful.'));
            }
        }

        $user_info = $app->getSession()->get('user_info');

        if ($user_info['utype'] == 1) {
            $app->setTemplateData(array('subtitle' => 'Active Articles', 'articles' => Article::getArticles($app, 0)));
            $this->display($app, 'uhome.twig');
            return;
        }

        $app->setTemplateData(array('articles' => Article::getArticles($app, 0, 6)));
        $this->display($app, 'gallery.twig');
    }

    /**
     * @param $params
     * @param $app
     */
    public function viewArticle($params, $app)
    {
        $app->setTemplateData(array('title' => 'Not found'));
        $article = false;

        if (isset($params['aid'])) {
            $article = Article::getArticleById($params['aid'], $app);
        } elseif (isset($params['aurl'])) {
            $article = Article::getArticleByUrl($params['aurl'], $app);
        }

        if ($article) {
            $app->setTemplateData(array(
                'page_title' => $article['title'],
                'title' => $article['title'],
                'subtitle' => $article['subtitle'],
                'body' => stripslashes(html_entity_decode($article['body'])),
                'article' => $article
            ));
        }

        $this->display($app, 'list_article.twig');
    }

    /**
     * @param $params
     * @param $app
     */
    public function showFile($params, $app)
    {
        $app->setTemplateData(array('title' => 'Not found'));
        $file = false;

        if (isset($params['fname'])) {
            $file = Files::getFile($app, $params['fname'], 0);
        }

        if (!$file) {
            $this->display($app, 'list_article.twig');
            return;
        }

        $user_var = $app->getConfManager()->getUserVar();
        $file_dir = $user_var['files_dir'];
        $file_path = $file['path'];
        $mtype = $file['mtype'];

        $this->fileResponse($app, $file_dir . "/" . $file_path, ($params['opt'] == "download"), $mtype);
    }

    /**
     * @param $params
     * @param $app
     */
    public function viewArticleList($params, $app)
    {
        $app->setTemplateData(array(
            'title' => 'Articles List',
        ));

        $user_info = $app->getSession()->get('user_info');
        if ($user_info['utype'] != 1) {
            $app->setTemplateData(array('content_message' => 'Not found or accessible'));
            $this->display($app, 'list_article.twig');
            return;
        }

        if ($app->getRequest()->getMethod() == "POST") {
            $article_data = array(
                'uid' => $user_info['id'],
                'title' => trim($app->getRequest()->request->get('title')),
                'subtitle' => trim($app->getRequest()->request->get('subtitle')),
                'url' => strtolower(trim($app->getRequest()->request->get('aurl'))),
                'category_id' => trim($app->getRequest()->request->get('category')),
                'body' => trim($app->getRequest()->request->get('abody')),
                'state' => addslashes(trim($app->getRequest()->request->get('state'))),
            );

            $invalid_chars = array(" ", "\n", "/", "\\", "$", "#", "@", "^", "&", "*");
            $article_data['url'] = str_replace($invalid_chars, "_", $article_data['url']);

            if ($app->getRequest()->request->get('editval')) {
                $aid = trim($app->getRequest()->request->get('editval'));
                $app->setTemplateData(array(
                    'content_message' => (Article::updateArticle($article_data, $aid,
                        $app)) ? "Article updated successfully" : "Article update failed"
                ));
            } elseif (Article::addArticle($article_data, $app)) {
                $app->setTemplateData(array('content_message' => "New article added successfully."));
            } else {
                $app->setTemplateData(array('content_message' => "Article couldn't be saved."));
            }
        }

        $app->setTemplateData(array('articles' => Article::getArticles($app)));

        $this->display($app, 'list_article.twig');
    }

    /**
     * @param $params
     * @param $app
     */
    public function frmArticle($params, $app)
    {
        $user_info = $app->getSession()->get('user_info');
        if ($user_info['utype'] != 1) {
            $app->setTemplateData(array('content_message' => 'Not found or accessible'));
            $this->display($app, 'list_article.twig');
            return;
        }

        $app->setTemplateData(array(
            'title' => 'Add new article',
        ));

        if (isset($params['opt']) && isset($params['aid'])) {
            $action = $params['opt'];
            $aid = $params['aid'];
            $app->setTemplateData(array(
                    'article' => Article::getArticleById($aid, $app),
                    'title' => 'Edit article',
                    'action' => "edit"
                )
            );
        }

        $app->setTemplateData(array('categories' => Category::getCategories($app, 0)));

        $files = Files::getFiles($app);

        foreach($files as $k => $f) {
            $icon_path = $app->getConfManager()->getPath() . "/Template/static/images/fileicons/" . $f['ftype'] . '.png';
            if(!file_exists($icon_path)) {
                $files[$k]['ftype'] = 'unknown';
            }
        }

        $app->setTemplateData(array('files' => $files));

        $this->display($app, 'frm_article.twig');
    }

    /**
     * @param $params
     * @param $app
     */
    public function viewDownloads($params, $app)
    {
        $app->setTemplateData(array(
            'title' => 'Products',
        ));

        $articles = Article::getArticles($app, 0, 2);
        if ($articles) {
            $app->setTemplateData(array('articles' => $articles));
        }

        $this->display($app, 'downloads.twig');
    }

    /**
     * @param $params
     * @param $app
     */
    public function viewCategoryList($params, $app)
    {
        $app->setTemplateData(array(
            'title' => 'Category List',
        ));

        $user_info = $app->getSession()->get('user_info');
        if ($user_info['utype'] != 1) {
            $app->setTemplateData(array('content_message' => 'Not found or accessible'));
            $this->display($app, 'list_category.twig');
            return;
        }

        if (isset($params[2])) {
            $action = $params[1];
            $cat_id = $params[2];

            if ($action == "edit") {
                $cat_pre = Category::getCategoryById($cat_id, $app);
                $app->setTemplateData(array('action' => 'edit', 'cat_id' => $cat_id, 'cat_pre' => $cat_pre));
            } else {
                $app->setTemplateData(array(
                    'content_message' => (Category::setState(($action == "enable") ? 0 : 1, $cat_id,
                        $app)) ? 'Category is ' . $params[1] . 'd.' : 'State change failed'
                ));
            }
        }

        if ($app->getRequest()->getMethod() == "POST") {
            $category = array('catname' => trim($app->getRequest()->request->get('catname')));

            if ($app->getRequest()->request->get('editval')) {
                $cid = $app->getRequest()->request->get('editval');
                $app->setTemplateData(array(
                    'content_message' => (Category::updateCategory($cid, $category,
                        $app)) ? 'Category successfully updated' : 'Category save failed'
                ));
            } elseif (Category::addCategory($category, $app)) {
                $app->setTemplateData(array('content_message' => 'New category successfully added'));
            } else {
                $app->setTemplateData(array('content_message' => 'New category save failed'));
            }
        }

        $app->setTemplateData(array('categories' => Category::getCategories($app)));

        $this->display($app, 'list_category.twig');
    }

    /**
     * @param $params
     * @param $app
     */
    public function viewFilesList($params, $app)
    {
        $app->setTemplateData(array(
            'title' => 'Files List',
        ));

        $file_dir = Files::setUploadDir($app);

        $user_info = $app->getSession()->get('user_info');

        if ($user_info['utype'] != 1) {
            $app->setTemplateData(array('content_message' => 'Not found or accessible'));
            $this->display($app, 'list_files.twig');
            return;
        }

        if (isset($params['opt']) && isset($params['fid'])) {
            $action = $params['opt'];
            $file_id = $params['fid'];
            $app->setTemplateData(array(
                    'content_message' => (Files::setState(($action == "enable") ? 0 : 1, $file_id,
                        $app)) ? 'File is ' . $action . 'd.' : 'State change failed'
                )
            );
        }

        if ($app->getRequest()->getMethod() == "POST") {
            $file_info = array(
                'name' => trim($app->getRequest()->request->get('filename')),
                'state' => 0,
            );
            $uploaded_file = $app->getRequest()->files->get('filecontent');

            $moved = false;
            if ($uploaded_file instanceof UploadedFile && $uploaded_file->getError() == 0) {
                try {
                    $file_info['name'] = ($file_info['name'] == "") ? Files::setProperName($uploaded_file->getClientOriginalName()) : Files::setProperName($file_info['name']);
                    $file_info['mtype'] = $uploaded_file->getMimeType();
                    $file_info['ftype'] = Files::getFileExt($uploaded_file->getClientOriginalName());
                    $file_info['path'] = ($file_info['name'] == "") ? Files::setProperPath($uploaded_file->getClientOriginalName(), $file_info['ftype'], $app) : Files::setProperPath($file_info['name'], $file_info['ftype'], $app);
                    $uploaded_file->move($file_dir, $file_info['path']);
                    $moved = true;
                } catch (\Exception $ex) {
                    $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
                }
            }

            if ($moved && file_exists($file_dir . "/" . $file_info['path'])) {
                if (Files::addFile($file_info, $app)) {
                    $app->setTemplateData(array('content_message' => 'New file successfully added'));
                } else {
                    $app->setTemplateData(array('content_message' => 'New file save failed'));
                }
            } else {
                $app->setTemplateData(array('content_message' => 'New file save failed'));
            }
        }

        $files = Files::getFiles($app);

        foreach($files as $k => $f) {
            $icon_path = $app->getConfManager()->getPath() . "/Template/static/images/fileicons/" . $f['ftype'] . '.png';
            if(!file_exists($icon_path)) {
                $files[$k]['ftype'] = 'unknown';
            }
        }

        $app->setTemplateData(array('files' => $files));

        $this->display($app, 'list_files.twig');
    }

    /**
     * @param $params
     * @param $app
     */
    public function viewUserList($params, $app)
    {
        $app->setTemplateData(array('title' => 'Users List'));

        $user_info = $app->getSession()->get('user_info');

        if ($user_info['utype'] != 1) {
            $app->setTemplateData(array('content_message' => 'Not found or accessible'));
            $this->display($app, 'list_users.twig');
            return;
        }

        if (isset($params['opt']) && isset($params['uid'])) {
            if ($params['opt'] == "enable") {
                $msg = (User::setState(0, $params['uid'], $app)) ? "User Enabled" : "User state change failed";
                $app->setTemplateData(array('content_message' => $msg));
            } elseif ($params['opt'] == "disable") {
                $msg = (User::setState(1, $params['uid'], $app)) ? "User Disabled" : "User state change failed";
                $app->setTemplateData(array('content_message' => $msg));
            } elseif ($params['opt'] == "edit") {
                $update_user = User::getUserById($params['uid'], $app);
                $app->setTemplateData(array('action' => 'edit', 'update_user' => $update_user));
            } else {
                $app->setTemplateData(array('content_message' => 'Not found or accessible'));
            }
        }

        if ($app->getRequest()->getMethod() == "POST") {
            $user_data = array(
                'email' => trim($app->getRequest()->request->get('email')),
                'pass' => trim($app->getRequest()->request->get('password')),
                'firstname' => trim($app->getRequest()->request->get('name')),
                'gender' => trim($app->getRequest()->request->get('gender')),
                'date_ofbirth' => trim($app->getRequest()->request->get('birthdate')),
                'ustatus' => 1,
            );

            if ($app->getRequest()->request->get('editval')) {
                $uid = $app->getRequest()->request->get('editval');
                $msg = User::updateUser($uid, $user_data, $app) ? "User updated successfully" : "User couldn't be updated";
                $app->setTemplateData(array('content_message' => $msg));
            } elseif (User::userExists($user_data['email'], $app)) {
                $app->setTemplateData(array('content_message' => 'User with email ' . $user_data['email'] . ' already exists. Try different email'));
            } elseif (User::addUser($user_data, $app)) {
                $app->setTemplateData(array('content_message' => "New user added."));
            } else {
                $app->setTemplateData(array('content_message' => "User couldn't be saved."));
            }
        }

        $app->setTemplateData(array('users' => User::getUsers($app)));

        $this->display($app, 'list_users.twig');
    }

    /**
     * @param $params
     * @param $app
     */
    public function viewLogin($params, $app)
    {
        $app->setTemplateData(array('title' => 'Login'));

        if ($app->getRequest()->getMethod() == "POST") {
            $user_data = array(
                'email' => trim($app->getRequest()->request->get('email')),
                'pass' => trim($app->getRequest()->request->get('password')),
                'firstname' => trim($app->getRequest()->request->get('name')),
                'gender' => trim($app->getRequest()->request->get('gender')),
                'date_ofbirth' => trim($app->getRequest()->request->get('birthdate')),
                'ustatus' => 1,
            );

            if (User::userExists($user_data['email'], $app)) {
                $app->setTemplateData(array(
                    'title' => 'Signup',
                    'content_message' => 'Signup was unsuccessful, user with email ' . $user_data['email'] . ' already exists. Try different email'
                ));
                $this->display($app, 'frm_signup.twig');
                return;
            }

            if (!User::addUser($user_data, $app)) {
                $app->setTemplateData(array(
                    'title' => 'Signup',
                    'content_message' => 'Signup was unsuccessful, try again.',
                ));
                $this->display($app, 'frm_signup.twig');
                return;
            }

            $app->setTemplateData(array(
                'title' => 'Login',
                'content_message' => 'The user is successfully added and can login',
            ));
        }

        $this->display($app, 'frm_login.twig');
    }

    /**
     * @param $params
     * @param $app
     */
    public function viewSignup($params, $app)
    {
        $app->setTemplateData(array('title' => 'Signup',));
        $this->display($app, 'frm_signup.twig');
    }

    /**
     * @param $params
     * @param $app
     */
    public function viewLogout($params, $app)
    {
        $app->setTemplateData(array('title' => 'Logout'));

        if ($app->getSession()->get('is_authenticated') && User::clearSession($app)) {
            $app->setTemplateData(array('content_message' => 'The user successfully logged out.'));
        }

        $this->display($app, 'frm_login.twig');
    }
}

/**
 * An open source web application development framework for PHP 5.
 * @author        ArticulateLogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2014 ArticulateLogic Labs
 * @license       MIT License
 */