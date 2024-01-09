<?php @session_start();
require_once __DIR__ . '/Facebook/vendor/autoload.php';

// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

// Call Facebook API
$fb = new Facebook(array(
    'app_id' => "436017244126415",
    'app_secret' => "a23d0d711dd0ec03f26fdb1022bdd15e",
    'default_graph_version' => 'v3.2',
));

// Get redirect login helper
$helper = $fb->getRedirectLoginHelper();