<!DOCTYPE html>
<html>
	<body>
		<form method="GET">
		URL of page to fetch: <input type="text" name="url" id="url">
		<input type="submit" name="submit" id="submit">
		</form>
		<br>

<?php

	require_once("HTMLSource.php");
	
	if (isset($_GET['url'])) {
		// Simple validation on the URL Input
		$scheme = parse_url($_GET['url'], PHP_URL_SCHEME);
		if ($scheme != "http" && $scheme != "https") {
			echo "Invalid URL (Examples:  http://slack.com, https://slack.com)";
			return;
		}


		// Get the HTML source for the given URL.  This includes both the HTML source to be displayed, 
		// as well as the element(HTML tag) counts
		$htmlSource = new HTMLSource($_GET['url'], $_GET['tag']);
		echo 'HTML Source:<br><br><div id="htmlSource">' . $htmlSource->getContent().'</div>';
		echo '<br><br>Tag Counts:<br><br><div id="tagCounts">';
		$elementCounts = $htmlSource->getElementCounts();		
		if (isset($elementCounts)) {
			foreach ($elementCounts as $key=>$val) {
				echo '<a href="'.$_SERVER["SCRIPT_NAME"].
						'?url='.urlencode($htmlSource->getUrl()).
						'&tag='.$key.'">'.$key.'</a>' . ': ' . $val . '<br>'; 
			}
		}
	}
?>

	</body>
</html>