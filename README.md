## Инструкция по запуску
- docker compose up -d
- docker compose exec app /bin/bash
- composer i

## Proxy API urls
- http://localhost:8000/api/v1/getNumber/?token=XXX&country=se&service=wa&rent_time=4
- http://localhost:8000/api/v1/getSms?token=XXX&activation=YYY
- http://localhost:8000/api/v1/getStatus?token=XXX&activation=YYY
- http://localhost:8000/api/v1/cancelNumber?token=XXX&activation=YYY
