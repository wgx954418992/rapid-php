# Changelog

### 4.1.0 (2018-04-17)

- keep the input value (+ encoding), if no xss was detected #32

### 4.0.3 (2018-04-12)

- fix "href is getting stripped" #30

### 4.0.2 (2018-02-14)

- fix "URL escaping bug" #29

### 4.0.1 (2018-01-07)

- fix usage of "Portable UTF8"


### 4.0.0 (2017-12-23)
- update "Portable UTF8" from v4 -> v5
  
  -> this is a breaking change without API-changes - but the requirement 
     from "Portable UTF8" has been changed (it no longer requires all polyfills from Symfony)


### 3.1.0 (2017-11-21)
- add "_evil_html_tags" -> so you can remove / add html-tags


### 3.0.1 (2017-11-19)
- "php": ">=7.0"
  * use "strict_types"
- simplify a regex


### 3.0.0 (2017-11-19)
- "php": ">=7.0" 
  * drop support for PHP < 7.0
