#!/bin/sh

# Mac OS
if ! command -v brew &> /dev/null
then
    /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
    sudo chown -R $USER /usr/local/Homebrew /usr/local/var/homebrew /usr/local/lib/pkgconfig /usr/local/share/aclocal /usr/local/share/info /usr/local/share/locale /usr/local/share/man/man3 /usr/local/share/man/man5 /usr/local/share/man/man7 /usr/local/share/man/man8 /usr/local/share/zsh /usr/local/share/zsh/site-functions /usr/local/var/log
fi

if ! command -v php &> /dev/null
then
    brew install php
fi

if ! command -v composer &> /dev/null
then
    brew install composer
fi

if ! command -v nmap &> /dev/null
then
    brew install nmap
fi

docker compose up -d

cd fastapi
python3 -m venv venv
source venv/bin/activate
pip install -r requirements.txt

sudo uvicorn main:app --host 0.0.0.0 --port 8000 --reload