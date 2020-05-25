COLOR_HEADER=\e[92m
COLOR=\e[93m
END=\033[0m
PROJECT_NAME := VoiceAssistant

.SILENT: help test

help:
	printf "$(COLOR_HEADER)$(PROJECT_NAME) management\n\n" && \
	printf "$(COLOR)make test$(END)\t Run PHPUnit tests\n"

test:
	php ./vendor/bin/phpunit tests