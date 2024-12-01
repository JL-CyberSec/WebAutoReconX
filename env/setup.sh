#!/bin/sh

SCRIPT_DIR=$(cd "$(dirname "$0")" || exit; pwd)
OS=$(uname -s)
SCRIPT="$SCRIPT_DIR/${OS}.sh"

if [ -f "$SCRIPT" ]; then
    if [ -x "$SCRIPT" ]; then
        sh "$SCRIPT"
    else
        echo "'$SCRIPT' is not executable. Make sure you have the correct permissions. Try chmod +x $SCRIPT"
    fi
else
    echo "Operative system not supported: $OS"
fi

docker compose up -d

cd fastapi

if [ ! -d "venv" ]
then
    python3 -m venv venv
fi

. venv/bin/activate
pip install -r requirements.txt

sudo bash -c "source venv/bin/activate && uvicorn main:app --host 0.0.0.0 --port 8000 --reload"