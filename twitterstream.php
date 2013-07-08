<?php

	require 'get_tweets.php';

	$t = new ctwitter_stream();
	
	$t->login('w0lSs1LzOjca1y9T6nAg', 'poBQGWOF8oiXW2i16NXZPw86HEnSgozIyUMXpaKbNU', '123790447-2AnICSAgQHCy1DNL9g9SEqS9Zv22WmjWNBTvtYfg', 'CfMFQF03PeC7UgHXs5T0U9W2f9k5nFgScDNnoI');
	
	$t->start(array('ConciertoExaFrozt2013','LiveTweetsMx'));

?>