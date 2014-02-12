<?php

		$fault = new Fault();
		// Get the current users ID for the submission
		$fault->set_author(1);
		// Grab content
		$fault->set_content($_REQUEST['content']);
		// Set default status to unread
		$fault->set_status(4);
		// Current time and date added to record
		$fault->set_postdate(time());
		// Set item
		$fault->set_item(4);

		if ($fault->save()) {
			header('Location: http:/http://dev.radio.warwick.ac.uk/trackit/javo');
			exit();		
		} else {
			echo "error ".pg_last_error();
		}

?>
