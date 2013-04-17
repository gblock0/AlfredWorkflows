<?

require_once('extension_utils.php');
$utils = new ExtensionUtils();

$results = array();
$text = $argv[1];
$text = utf8_encode( urlencode( $text ) );
$xml = simplexml_load_file("http://google.com/complete/search?output=toolbar&q=$text");

foreach( $xml as $sugg ):
	$item = array(
		'uid' => 'suggest {query}',
		'arg' => $sugg->suggestion->attributes()->data,
		'title' => $sugg->suggestion->attributes()->data,
		'subtitle' => 'Search Google for '. $sugg->suggestion->attributes()->data,
		'icon' => 'icon.png',
		'valid' => 'yes'
	);
	array_push( $results, $item );
endforeach;

if ( count( $results ) > 0 ):
	echo $utils->arrayToXml( $results );
endif;