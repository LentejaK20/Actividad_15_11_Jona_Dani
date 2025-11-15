NUESTRO DOCKER-COMPOSE.YML services:
  web:
    build: ./app-php                 
    container_name: web-cloud
    ports:
      - "8080:80"
    environment:
      - DB_HOST=db
      - DB_PORT=3306
      - DB_NAME=trabajo15-11
      - DB_USER=cloudteam
      - DB_PASSWORD=pass123
      - APP_REQUIRED_PORT=8080
    healthcheck:
      test: ["CMD", "php", "/var/www/html/healthcheck.php"]
      interval: 15s
      timeout: 5s
      retries: 3
    volumes:
      - ./app-php:/var/www/html
    depends_on:
      db:
        condition: service_healthy
    restart: unless-stopped
    networks:
      - app-cloud    
  db:
    image: mariadb:11
    container_name: db-cloud
    volumes: 
      - dbcloud:/var/lib/mysql
      - ./init.sql:/docker-entrypoint-initdb.d/init.sql:ro
    environment:
        MARIADB_DATABASE: trabajo15-11
        MARIADB_USER: cloudteam
        MARIADB_PASSWORD: pass123
        MARIADB_ROOT_PASSWORD: root 
    healthcheck:
      test: ["CMD", "mariadb", "-h", "localhost", "-u", "cloudteam", "-ppass123", "-D", "trabajo15-11", "-e", "SELECT 1"]
      interval: 10s
      timeout: 5s
      retries: 5
    networks:
      - app-cloud
    restart: unless-stopped


volumes:
  dbcloud:
networks:
  app-cloud:

NUESTRa bd

CREATE DATABASE IF NOT EXISTS `trabajo15-11`;
USE `trabajo15-11`; 

CREATE TABLE IF NOT EXISTS nombres (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL
);
INSERT INTO nombres (nombre) VALUES
('Dani Marchant'),
('Jona Rojas');


1.- integrantes: Daniel Marchant || Jonathan Rojas

COMO EJECUTAR NUESTRO CONTENEDOR:

1.- abre una terminal en visual studio code (arriba aparece terminal - new terminal)
1.5- que sea con command prompt
2.- ejecuta este comando: docker compose up -d --build
3.- ejecuta luego: docker ps
4.- abre en una pagina: localhost:8080
5.- ya veras la pagina con los nombres de los integrantes.
|EL CONTENEDOR ESTA CREADO POR PHP|
