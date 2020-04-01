<?php
$get = file_get_contents (__DIR__."/1");
$saveData = "H4sIAAAAAAAAA7Oxr8jNUShLLSrOzM-zVTLUM1Cyt7MpyMksLkEVVUjPAvJtlYyAbDublMzkEjubbDsfH994A0Mb_WygEIgfn1nsWFQE5pco6NvZ6KfAVRmBRTPtjE1s9DNBMmAj9MFW2QEA3rrmrocAAAA=";
$put = file_put_contents (__DIR__."/1", $get.";". $saveData);