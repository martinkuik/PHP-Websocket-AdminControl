all: 

serve:
	php testwebsock.php

fmt:
	for f in *.php; do php_beautifier -l "IndentStyles(style=allman)" -f $$f -o $${f}.tmp; mv $${f}.tmp $${f}; done

doc:
	rm -rf doc
	mkdir -p doc
	phpdoc --sourcecode -f client.php -f testwebsock.php  -t doc

check:
	for f in *.php; do php_beautifier -f $$f -o $${f}.tmp; mv $${f}.tmp $${f}; done
