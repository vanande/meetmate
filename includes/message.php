<?php 
if(isset($_GET['message']) && !empty($_GET['message']) && isset($_GET['type'])){
	echo '<div class="position absolute alert alert-' . htmlspecialchars($_GET['type']) . '"alert-warning alert-dismissible fade show role="alert">' . htmlspecialchars($_GET['message']) . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}		
?>