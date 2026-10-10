#!/bin/ash
# Pterodactyl entrypoint: expand {{VARIABLES}} in the panel's startup command and run it.

cd /home/container || exit 1

# Servers created from an older egg keep its old startup command, which ran composer
# itself; start.sh does that now.
case "${STARTUP}" in
    '{{STARTUP_CMD}} && if [[ -n "${COMPOSER_MODULES}" ]]'*)
        printf "\033[1;33m[WARNING] Old startup command from the previous egg detected, using {{STARTUP_CMD}} instead. Set it in Admin -> Servers -> this server -> Startup.\033[0m\n"
        STARTUP='{{STARTUP_CMD}}'
        ;;
esac

# shellcheck disable=SC2016,SC2046
PARSED=$(echo "${STARTUP}" | sed -e 's/{{/${/g' -e 's/}}/}/g' | eval echo "$(cat -)")

if [ -z "${PARSED}" ]; then
    printf "\033[0;31m[ERROR] The startup command is empty. Set Startup Command in the Startup tab (default: ./start.sh).\033[0m\n"
    exit 1
fi

printf "\033[1m\033[33mcontainer@pterodactyl~ \033[0m%s\n" "${PARSED}"

# shellcheck disable=SC2086
exec env ${PARSED}
