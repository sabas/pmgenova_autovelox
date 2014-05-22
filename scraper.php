<?php
// This is a template for a PHP scraper on Morph (https://morph.io)
// including some code snippets below that you should find helpful

 require 'scraperwiki.php';
 require 'scraperwiki/simple_html_dom.php';
//
// // Read in a page
 $html = scraperwiki::scrape("http://www1.comune.genova.it/poliziamunicipale/velox/velox2.asp");
//
// // Find something on the page using css selectors
$dom = new simple_html_dom();
$dom->load($html);
$tab=$dom->find("table");

array_shift($tab); //il primo è il banner
array_shift($tab); //il secondo è l'header

foreach($tab as $table)
{
 $row=$table->find("tr td span span");
 echo $row[0]->plaintext,$row[1]->plaintext,$row[2]->plaintext;
}

die('end');
//
// // Write out to the sqlite database using scraperwiki library
// scraperwiki::save_sqlite(array('name'), array('name' => 'susan', 'occupation' => 'software developer'));
//
// // An arbitrary query against the database
// scraperwiki::select("* from data where 'name'='peter'")

// You don't have to do things with the ScraperWiki library. You can use whatever is installed
// on Morph for PHP (See https://github.com/openaustralia/morph-docker-php) and all that matters
// is that your final data is written to an Sqlite database called data.sqlite in the current working directory which
// has at least a table called data.
     
/*
foreach($dom->find("div[@align='left'] tr") as $data){
    $tds = $data->find("td");
    if(count($tds)==12){
        $record = array(
            'country' => $tds[0]->plaintext,
            'years_in_school' => intval($tds[4]->plaintext)
        );
        print json_encode($record) . "\n";
    }
}
*/
?>
