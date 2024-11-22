#!/bin/sh

# Mac OS
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
sudo chown -R $USER /usr/local/Homebrew /usr/local/var/homebrew /usr/local/lib/pkgconfig /usr/local/share/aclocal /usr/local/share/info /usr/local/share/locale /usr/local/share/man/man3 /usr/local/share/man/man5 /usr/local/share/man/man7 /usr/local/share/man/man8 /usr/local/share/zsh /usr/local/share/zsh/site-functions /usr/local/var/log
brew install php
brew install composer
brew install nmap

cd fastapi
python3 -m venv venv
source venv/bin/activate
pip install -r requirements.txt

docker compose up ..
sudo uvicorn main:app --host 0.0.0.0 --port 8000