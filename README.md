Elpho Framework Test Project
============================

The test suit for the elpho framework official modules.

To run the tests you must have all the 8 packages repositories (including this one "elpho/test") on the same folder.
Then run `make test` from the command line.

Contributing
------------

Once you can run the test suit on your workspace folder, add your tests to the `/src` folder, remember to `include_once 'suitSetup.php'` at the top of your test-case class script.

You may add helper classes and functions to the project, either in a separate file or as a child of the test class (in case of methods).

Once done, open a pull request.

And welcome aboard!
