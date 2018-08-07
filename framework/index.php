<?php
 /**
 * Load all custome fields folder
 * Load all page templates
 */
 $files = array_merge(
   glob(__DIR__.'/custom-fields/*.php'),
   glob(__DIR__.'/post-type/*.php'),
   glob(__DIR__.'/widgets/*.php')
 );
 foreach ($files as $filename)
 {
   include $filename;
 }
