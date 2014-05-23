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
 
 $date=explode('/',$row[0]->plaintext);
 $date=array_reverse($date);
 $date=implode($date);
 
 $orario=explode('/',$row[1]->plaintext);
 preg_match('(/(\d{2}),(\d{2})\/(\d{2}),(\d{2})/',$orario, $matches);
 $start_time=$matches[0].$matches[1];
 $end_time=$matches[2].$matches[3];
 
 $strada=ucwords($row[2]->plaintext);
 
 $record = array(
   'data' => $date,
   'inizio' => $start_time,
   'fine' => $end_time,
   'luogo' => $strada
 );
scraperwiki::save_sqlite(array('data','inizio','fine','luogo'), $record); 
}

?>
