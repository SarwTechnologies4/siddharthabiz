<?php require_once("includes/initialize.php");

// Try to get access token
try {
    if (isset($_SESSION['facebook_access_token'])) {
        $accessToken = $_SESSION['facebook_access_token'];
    } else {
        $accessToken = $helper->getAccessToken();
    }
} catch (FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}


if (!isset($accessToken)) {
    if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
}

if (!$accessToken->isLongLived()) {
    // Exchanges a short-lived access token for a long-lived one
    try {
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
        exit;
    }
}

//$fb->setDefaultAccessToken($accessToken);

# These will fall back to the default access token
$res = $fb->get('/me', $accessToken->getValue());
$fbUser = $res->getDecodedBody();


/*
* Store record in database
*/
//echo '<pre>'; print_r($fbUser);
if (!empty($fbUser)) {
    $sql = 'SELECT * FROM tbl_users WHERE facebook_uid="' . $fbUser['id'] . '" LIMIT 1 ';
    $count = $db->num_rows($db->query($sql));

    if ($count > 0) {
        $sqlid = $db->fetch_object($db->query($sql));
        $userid = $sqlid->id;
        $uprec = User::find_by_id($userid);

        $session->set('user_id', $userid);

        redirect_to(BASE_URL . 'dashboard');
    } else {
        $record = new User();

        $accessToken = @randomKeys(10);

        $record->first_name = $fbUser['name'];
        $record->facebook_uid = $fbUser['id'];
        $record->accesskey = @randomKeys(25);
        $record->access_code = $accessToken;
        $record->group_id = 3;
        $record->status = 1;
        $record->sortorder = User::find_maximum();
        $record->added_date = registered();
        $record->type = 'general';

        $record->save();
        $db->commit();
        $uid = $db->insert_id();

        $session->set('user_id', $uid);

        redirect_to(BASE_URL . 'dashboard/profile');
    }
}