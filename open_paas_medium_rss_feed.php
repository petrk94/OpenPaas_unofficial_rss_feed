<?php

require('simple_html_dom.php');

# decode url to html code
$html = file_get_html('https://medium.com/linagora-engineering/latest');

# assign variable link as array
$link = array();
# assign variable headlines as array
$headlines = array();
# assign variable author as array
$author = array();

# search for the element class in html code and write the links inside the <a> tag to the link array
# print the array $link
foreach($html->find('.postArticle-content a') as $element) {
   $link[] = $element->href;
   print_r($link);
}

foreach($html->find('h3') as $header) {
	$headlines[] = $header->plaintext;
	print_r($headlines);
}

foreach($html->find('.ds-link') as $author_data) {
	$author[] = $author_data->plaintext;
	print_r($author);
}

foreach($html->find('a time') as $pubdate) {
	$date[] = $pubdate->plaintext;
	print_r($date);
}

 


# print the results in a for loop, every array value until key of $i will be print
#for($i=0;$i<=8; $i++) {
#print_r($headlines[$i]);
#echo "\n";
# inside author print_r() is only the plain text to show before the article array value get print
#print_r($author[$i]);
#echo "\n";

#print_r($date[$i]);
#echo "\n";

#print_r($link[$i]);
#echo "\n\n";
#}




$myfile = "index.xml";


$rss_feed_content_begin = 

"<?xml version=\"1.0\" encoding=\"utf-8\"?>
<rss version=\"2.0\">

  <channel>
    <title>Linagora Engineering / Open Paas RSS Feed</title>
    <link>https://medium.com/linagora-engineering</link>
    <description>We are Open Source Engineers, Hacking Awesome Stuff!</description>
    <language>en-en</language>
    <copyright>Linagora Engineering</copyright>
    <pubDate>" . ("Y-m-d H:i:s") . "</pubDate>";

file_put_contents($myfile,$rss_feed_content_begin);
	
for($i=0;$i<=8; $i++) {

$rss_feed_content = "

    <item>
      <title>$headlines[$i]</title>
      <description>New Article at @Medium</description>
      <link>$link[$i]</link>
      <author>$author[$i]</author>
      <pubDate>$date[$i]</pubDate>
    </item>";

file_put_contents($myfile,$rss_feed_content, FILE_APPEND);	
}
$rss_feed_content_end = "
	
  </channel>

</rss>";

file_put_contents($myfile,$rss_feed_content_end, FILE_APPEND);

