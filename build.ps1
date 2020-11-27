docker stop agape
docker build -t agape:latest .
docker run --rm -d -p 80:80/tcp --name agape agape:latest