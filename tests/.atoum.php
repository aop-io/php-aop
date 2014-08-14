<?php

/*
This file will automatically be included before EACH run.

Use it to configure atoum or anything that needs to be done before EACH run.

More information on documentation:
[en] http://docs.atoum.org/en/chapter3.html#Configuration-files
[fr] http://docs.atoum.org/fr/chapter3.html#Fichier-de-configuration
*/

use \mageekguy\atoum;

$report = $script->addDefaultReport();

//*
//LOGO

// This will add the atoum logo before each run.
//$report->addField(new atoum\report\fields\runner\atoum\logo());

// This will add a green or red logo after each run depending on its status.
$report->addField(new atoum\report\fields\runner\result\logo());
//*/

/*
//CODE COVERAGE SETUP

// Destination directory path for html files.
$coverageField = new atoum\report\fields\runner\coverage\html(
  'aop-io/php-aop', __DIR__.'/../doc/html/code-coverage'
);

// Root url of the code coverage web site.
$coverageField->setRootUrl('http://aop.io');


$report->addField($coverageField);
//*/

$script->bootstrapFile(__DIR__. '/bootstrap.php');
$runner->addTestsFromDirectory(__DIR__. '/units');
