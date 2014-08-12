<?php
// This is a template for a PHP scraper on Morph (https://morph.io)
// including some code snippets below that you should find helpful

 require 'scraperwiki.php';
 require 'scraperwiki/simple_html_dom.php';
//
// // Read in a page
 $html = scraperwiki::scrape("http://www.agid.gov.it/catalogo-nazionale-programmi-riusabili");
//
// // Find something on the page using css selectors
$dom = new simple_html_dom();
$dom->load($html);
$tab=$dom->find("table.views-table tbody tr");


foreach($tab as $row)
{
 $row=$row->find("td");
 $ID=trim($row[0]);
 $Titolo=trim($row[1]);
 $Anno=trim($row[2]);
 $Amministrazione=trim($row[3]);
 $Scheda_Applicazione=trim($row[4]);
 
 $record = array(
   'ID' => $ID,
   'Titolo' => $Titolo,
   'Anno' => $Anno,
   'Amministrazione' => $Amministrazione,
   'Scheda Applicazione' => $Scheda_Applicazione
 );
 
scraperwiki::save_sqlite(array('ID'), $record); 
}
?>
