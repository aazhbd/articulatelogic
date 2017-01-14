<?php

$routes = array(
    'urls' => array(
        '' => '/controller/Views/viewHome',
        '/home' => '/controller/Views/viewHome',
        '/sitemap\.(?<type>[A-Za-z_][A-Za-z0-9_]*)' => '/controller/Views/viewSiteMap',

        '/login' => '/controller/Views/viewLogin',
        '/logout' => '/controller/Views/viewLogout',
        '/signup' => '/controller/Views/viewSignup',

        '/a/(?<aurl>[A-Za-z_][A-Za-z0-9_]*)' => '/controller/Views/viewArticle',
        '/a/(?<aid>\d+)' => '/controller/Views/viewArticle',
        '/article/add' => '/controller/Views/frmArticle',
        '/article/list' => '/controller/Views/viewArticleList',
        '/article/(?<opt>[A-Za-z_][A-Za-z0-9_]*)/(?<aid>\d+)' => '/controller/Views/frmArticle',

        '/downloads' => '/controller/Views/viewDownloads',

        '/user/list' => '/controller/Views/viewUserList',
        '/user/(?<opt>[A-Za-z_][A-Za-z0-9_]*)/(?<uid>\d+)' => '/controller/Views/viewUserList',

        '/category/list' => '/controller/Views/viewCategoryList',
        '/category/(?<opt>[A-Za-z_][A-Za-z0-9_]*)/(?<cid>\d+)' => '/controller/Views/viewCategoryList',

        '/files/list' => '/controller/Views/viewFilesList',
        '/file/(?<opt>[A-Za-z_][A-Za-z0-9_]*)/(?P<fname>[\w.-]{0,256})' => '/controller/Views/showFile',
        '/files/(?<opt>[A-Za-z_][A-Za-z0-9_]*)/(?<fid>\d+)' => '/controller/Views/viewFilesList'
    )
);

return $routes['urls'];
