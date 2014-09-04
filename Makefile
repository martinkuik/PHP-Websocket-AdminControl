all: 

serve:
	php testwebsock.php

fmt:
	for f in *.php; do php_beautifier -f $$f -o $${f}.tmp; mv $${f}.tmp $${f}; done

doc:
	mkdir -p doc
	phpdoc --sourcecode -f client.php -f testwebsock.php -f users.php -f websockets.php -t doc

check:
	for f in *.php; do php_beautifier -f $$f -o $${f}.tmp; mv $${f}.tmp $${f}; done
