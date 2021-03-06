<?php

/**
 * get data from csv file
 * @param $fileName - csv file name
 * @throws Exception
 * @return Generator
 */
function getDataFromFile($fileName)
{
    if (file_exists($fileName)) {
        $i = 0;
        $file = fopen($fileName, 'r');
        while ($csv = fgetcsv($file)) { //read file line by line
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
function getHtmlFromUrl($url)
{
    // Create a stream
    $opts = [
        'http' => [
            'method' => "GET",
            'header' => "Cookie: test=seo" //set test cookie
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
function getActualTags($url)
{
    $actualTags = [];
    $html = getHtmlFromUrl($url); //get html from url

    libxml_use_internal_errors(true); //get rid of html5 parse errors
    $dom = new DOMDocument();
    $dom->loadHtml($html);
    libxml_clear_errors();

    $titleElement = $dom->getElementsByTagName('title');
    $actTitle = $titleElement->item($titleElement->length - 1)->nodeValue; //find tag title
    $actualTags['title'] = $actTitle;

    $selector = new DOMXPath($dom);
    $descr = $selector->query('//meta[@name="description"]/@content'); //find meta description

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
function isSeoUpdated($url, $title, $descr, $actualTags)
{
    $result = null;
    if ($title !== $actualTags['title']) {
        $result['title'] = "[X] Title \"" . $actualTags['title'] . "\" for $url is old (\"$title\" is expected)\r\n";
    };

    if ($descr !== $actualTags['descr']) {
        $result['descr'] = "[X] Description \"" . $actualTags['descr'] . "\" for $url is old (\"$descr\" is expected)\r\n";
    };
    return $result;
}

$fileName = "seoExample.csv"; //default filename
$opts .= "f:";
$options = getopt($opts);
if (isset($options['f'])) {
    $fileName = $options['f']; //if filename set through -f use new filename
};
$success = 0;
$count = 0;
try {
    foreach (getDataFromFile($fileName) as $item) { //get data from csv
        [
            $url,
            $title,
            $descr,
        ] = $item;
        $count++;
        $actualTags = getActualTags($url); //get data from website
        $check = isSeoUpdated($url, $title, $descr, $actualTags); // compare data from csv with data from website
        if ($check === null) {
            $success++;
        }
        echo($check['title'] . $check['descr']);
    }
echo("$success of $count websites was checked successfully\r\n");
} catch (Exception $e) {
    echo("Can't read from file $fileName\r\n" . $e);
}
