# Simple Brazilian Login
This system implements basic login, registration, and user data storage. The sign-up form collects data commonly requested by Brazilian websites, including CPF (Brazilian tax ID), which is validated for authenticity. Authentication uses hashed password encryption, along with password recovery via email.
## Technologies
- PHP
- MySQL
- Docker
## How to run
```
git clone https://github.com/ewum/simple-brazilian-login
cd simple-brazilian-login
docker compose up -d
```
Access: `https://localhost:8000`