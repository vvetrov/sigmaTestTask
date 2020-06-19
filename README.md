# sigmaTestTask
Solution of the test task from Sigma

_Implemented solution of the task from "PHP Test Assessment.docx"_

Here we have productCalcTerminal class as required in the task.


Also tests using PHPUnit implemented.

To execute in local environment:

1. Run **composer install** in the test folder (to install PHPUnit)
2. Run **composer dump-autoload --optimize** (to generate autoload)
3. Run **runTests.sh** to execute the tests

To execute in docker environment:
1. Build docker image by executing **docker build --tag sigmaTest:1.0**
2. Run the container by executing **docker run --name st sigmaTest:1.0**