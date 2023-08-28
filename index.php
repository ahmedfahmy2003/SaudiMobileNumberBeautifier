<?php
function mobileAdapt($mobile)
{
	$mobile = substr(preg_replace('/[^0-9]/', '', $mobile), -9);
	if (empty($mobile) || strlen($mobile) <= 8) {
		return null;
	} else if (strlen($mobile) == 9 && substr($mobile, 0, 1) != '5') {
		return null;
	} else {
		return "966" . $mobile;
	}
}
$fin = fopen('inputFile.csv', 'r');
$fout = fopen('outputFile.csv', 'w');
$i = 0;
$arr = [];
$wasted = 0;
$duplicate = 0;
$success = 0;
while (!feof($fin)) {
	$i++;
	$line = fgets($fin);
	$line = mobileAdapt($line);
	if (!$line) {
		$wasted++;
	} else if (in_array($line, $arr)) {
		$duplicate++;
	} else {
		array_push($arr, $line);
		$success++;
		fwrite($fout, $line . PHP_EOL);
	}
}
fclose($fin);
fclose($fout);
echo '<br>All: ' . $i;
echo '<br>wasted: ' . $wasted;
echo '<br>duplicate: ' . $duplicate;
echo '<br>success: ' . $success;
