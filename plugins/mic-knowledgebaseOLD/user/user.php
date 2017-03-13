<?php
// class MIC_KB_USER {

//     public function __construct(){
//         add_action( 'plugins_loaded', array( $this, 'mic_knowledgebase_check_user' ) );
//     }

//     public static function mic_knowledgebase_check_user()
//     {
//         if ( is_user_logged_in() && current_user_can( 'read_mic' ) ){
//            // display the articles
//           		echo '<h1>Current logged in and can read the article.</h1>';

//         }
//         else {
//         	//hide the articles
//         	echo '<h1>Hide Articles</h1>';
//         }


//     }

// }

// $mic_kb_user_instance = new MIC_KB_USER();