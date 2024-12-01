#!/bin/sh

# Linux
if ! dpkg -l | grep -q build-essential
then
    apt install build-essential python3-dev gcc-11 -y
fi

if ! which php > /dev/null 
then
    add-apt-repository ppa:ondrej/php -y
    apt update -y
    apt install php8.4 -y
fi

if ! which python3 > /dev/null 
then
    apt install python3 -y
    pip install --upgrade pip
fi

if ! which composer > /dev/null 
then
    curl -sS https://getcomposer.org/installer | php -y
fi

if ! which composer > /dev/null 
then
    apt install nmap -y
fi