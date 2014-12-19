<?php
class EmptyAction extends Action {
    function _empty() {
		if(strtolower(GROUP_NAME) !== 'third'){
    		R('Site/Error/index');
		}
		if(C('LOG_EXCEPTION_RECORD')) Log::write($msg);
		send_http_status(404);
		exit;
    }
}
?>