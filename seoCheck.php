<?php

/**
 * get data from csv file
 * @param $fileName - csv file name
 */
function getDataFromFile($fileName) {
	if (file_exists($fileName)) {
		$i = 0;
		$file = fopen($fileName, 'r');
		while ($csv = fgetcsv($file)) {
			if ($i++ == 0) {
				continue;
			}
			yield $csv;
		}
	} else {
		throw new Exception("File $fileName not found");
	}
}

/**
 * get html content by url
 * @param $url - website url
 * @return mixed - html content
 */
function getHtmlFromUrl($url) {
	// Create a stream
	$opts = [
	  'http' => [
	    'method' => "GET",
	    'header' => "Cookie: test=seo"
	  ]
	];
	$context = stream_context_create($opts);

	// Open the file using the HTTP headers set above
	return file_get_contents($url, false, $context);
}

/** 
 * get actual seo tags from url
 * @param $url - website url
 * @return array - actual seo tags
 */
function getActualTags($url) {
	$actualTags = [];
	$html = getHtmlFromUrl($url);

	libxml_use_internal_errors(true);
	$dom = new DOMDocument();
	$dom->loadHtml($html);
	libxml_clear_errors();

	$titleElement = $dom->getElementsByTagName('title');
	$actTitle = $titleElement->item($titleElement->length - 1)->nodeValue;
	$actualTags['title'] = $actTitle;
	
	$selector = new DOMXPath($dom);
	$descr = $selector->query('//meta[@name="description"]/@content');

	$actualTags['descr'] = $descr->length
		? $descr[$descr->length - 1]->textContent
		: "";

	return $actualTags;
}

/** 
 * check if the seo tags are up to date
 * @param $url - website url
 * @param $title - title from csv
 * @param $descr - description from csv
 * @param $actualTags - array of title and description from website
 * @return array - strings for echoing
 */
function isSeoUpdated($url, $title, $descr, $actualTags) {
	$result = [];
	if ($title === $actualTags['title']) {
		$result['title'] = " [+] Title for $url is up to date\r\n";
	} else {
		$result['title'] = " [X] Title \"" . $actualTags['title'] . "\" for $url is old (\"$title\" is expected)\r\n";
	};

	if ($descr === $actualTags['descr']) {
		$result['descr'] = " [+] Description for $url is up to date\r\n";
	} else {
		$result['descr'] = " [X] Description \"" . $actualTags['descr'] . "\" for $url is old (\"$descr\" is expected)\r\n";
	};
	return $result;
}

$fileName = "seoExample.csv";
$opts .= "f:";
$options = getopt($opts);
if (isset($options['f'])) {
	$fileName = $options['f'];
};

foreach (getDataFromFile($fileName) as $item) {
	[
		$url,
		$title,
		$descr,
	] = $item;

	echo("[!] Checking the $url for seo data\r\n");

	$actualTags = getActualTags($url);
	$check = isSeoUpdated($url, $title, $descr, $actualTags);
	echo($check['title'] . $check['descr']);
}

echo("[!] Program is finished\r\n");

?>