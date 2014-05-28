<?php
require_once 'vendor/autoload.php';
use SebastianBergmann\Diff\Differ;

$old = file_get_contents($argv[1]);
$new = file_get_contents($argv[2]);
if (isset($argv[3])) {
    $threshold = $argv[3];
} else {
    $threshold = 3;
}
$differ = new Differ;
$diff = $differ->diff($old,$new);
$adds = preg_match_all('/^\\+.*$/m', $diff);
$dels = preg_match_all('/^-.*$/m', $diff);
if ($adds > $threshold || $dels > $threshold) {
    print "Something has changed! {$argv[2]}\n";
    print $diff;
}
file_put_contents($argv[1], $new);
