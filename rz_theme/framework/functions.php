<?php 

/*Get redux options*/
if ( ! function_exists( 'rz_theme_get_options' ) ) {
	function rz_theme_get_options($arg1){
	    global $rz_redux_demo;
	    $redux = (!empty($rz_redux_demo)) ? $rz_redux_demo[$arg1] :  false;
	    return $redux;
	}
}
    
if ( ! function_exists( 'login_vk' ) ) {    
    function login_vk(){
        if (isset($_GET['code'])) {
            $result = false;
            $params = array(
                'client_id' => CLIENT_ID,
                'client_secret' => CLIENT_SECRET,
                'code' => $_GET['code'],
                'redirect_uri' => get_permalink( get_option('woocommerce_myaccount_page_id') )
            );

            $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

            if (isset($token['access_token'])) {
                $params = array(
                    'uids'         => $token['user_id'],
                    'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
                    'access_token' => $token['access_token']
                );

                $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
                if (isset($userInfo['response'][0]['uid'])) {
                    $userInfo = $userInfo['response'][0];
                    $result = true;
                }
            }
            
            //session_start();
            if ($result) {
                $rus=array('А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ');
                $lat=array('a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya',' ');
            
                $password=$userInfo['uid'];
                $name=str_replace($rus, $lat, $userInfo['first_name'] );    
                wc_create_new_customer( $token['email'], $name, $password );
                $current_user = get_user_by( 'login', $name );
                wc_set_customer_auth_cookie( $current_user->ID );
            }
        }
    }
    add_action('init', 'login_vk');
}
?> 