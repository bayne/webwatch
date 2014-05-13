<?php
require_once 'vendor/autoload.php';
use SebastianBergmann\Diff\Differ;

$old = file_get_contents($argv[1]);
$new = file_get_contents($argv[2]);
$differ = new Differ;
$diff = $differ->diff($old,$new);
$adds = preg_match_all('/^\\+.*$/m', $diff);
$dels = preg_match_all('/^-.*$/m', $diff);
if ($adds > 5 || $dels > 5) {
    mail('bwpayne@gmail.com', 'Something has changed!', 'Something has changed');
}
