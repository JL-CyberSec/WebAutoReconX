# WebAutoReconX

## Description
Automated pentesting software.

## Prerequisites
- [Docker](https://www.docker.com/get-started) installed on your machine.
- [Docker Compose](https://docs.docker.com/compose/install/) installed on your machine.
- [Linux or WSL](https://learn.microsoft.com/en-us/windows/wsl/install) installed on your machine.
- [Git](https://git-scm.com/) installed on your machine.

## Getting Started

### Cloning the Repository, Initializing Docker Containers, and Setup (Step by Step)

To clone the repository, run the following command in your terminal:

```bash
$ git clone https://github.com/JL-CyberSec/WebAutoReconX.git
```

Navigate to the project directory and run the following command to build and start the Docker containers:

```bash
$ cd WebAutoReconX
```

Create the .env file
```
$ cp .env.example .env
```

Replace the following variables in the .env file
```
DB_CONNECTION=mysql
DB_HOST=webreconx_db
DB_PORT=3306
DB_DATABASE=webreconx_db
DB_USERNAME=root
DB_PASSWORD=webreconx
```

This will construct the nginx and php container
```
docker compose up -d --build --remove-orphans
```

Wait a couple of seconds and go to http://localhost:8001 😀

### Accessing the Database
To access the database, you can use a database management tool phpMyAdmin through http://localhost:8081

## License

MIT License

Copyright (c) 2024 Alejandro Piraquive

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

- The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

## Contributing
Provide guidelines for contributing to your project.

## Contact
For any questions or suggestions, feel free to contact:

Alejandro Piraquive alejandro5.6@icloud.com
Leandro Panesso leandropa00@gmail.com

# Next Features

1. Con base en las versiones de los servicios consultar las CVE y consultar los exploits en exploit db (Añadir esta funcionalidad en la etapa de vulnerabilidades)
2. Agregar una api de IA que explique que son esas vulnerabilides y como se pueden corregir (Agregar tipo de lenguaje para persona tecnica o ejecutiva)
