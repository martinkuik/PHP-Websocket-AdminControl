all: 

serve:
	php testwebsock.php

fmt:
	for f in *.php; do php_beautifier -f $$f -o $${f}.tmp; mv $${f}.tmp $${f}; done



check:
	for f in *.php; do php_beautifier -f $$f -o $${f}.tmp; mv $${f}.tmp $${f}; done
