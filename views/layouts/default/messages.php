<?php
if (isset($_SESSION['messages'])) {
	foreach ($_SESSION['messages'] as $msg) {
		echo '<div class="msg ' . $msg['type'] . '">' . htmlspecialchars($msg['text']);
		echo '<span class="close-btn" title="Затвори">X</span>';
		echo '</div>';
	}
	
	unset($_SESSION['messages']);
}
