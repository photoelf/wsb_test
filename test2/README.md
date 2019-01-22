# Readme #

### Requirements: ###
* php from 7.1
* [chromedriver](https://sites.google.com/a/chromium.org/chromedriver/getting-started)
* [selenium standalone server](http://docs.seleniumhq.org/download/)

### Usage: ###

* Launch the Selenium Server: `java -jar selenium-server-standalone-3.141.59.jar`
* Launch ChromeDriver: `./chromedriver --url-base=/wd/hub`
* Launch autotests: `php codecept.phar run`