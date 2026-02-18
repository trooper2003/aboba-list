

# Symfony 7.4 + PHP 8.4 Docker Skeleton (PostgreSQL + Redis + RabbitMQ + Xdebug)

Этот репозиторий — **инфраструктурный скелет** для локальной разработки Symfony-проекта.

Внутри уже настроены:
- **PHP 8.4 (FPM)**
- **Nginx**
- **PostgreSQL 16**
- **Redis 7**
- **RabbitMQ 3 (Management UI)**
- **Xdebug** для отладки в PhpStorm

> ВАЖНО: код Symfony-приложения вы добавляете сами в папку `app/` (и коммитите в git).
> Здесь **не нужно** создавать Symfony через composer — просто кладёте готовый `app/`.

---

## Быстрый старт

### 1) Предусловия

- Установлен **Docker** (Docker Desktop / Docker Engine)
- Установлен **docker compose** (команда именно `docker compose`, не `docker-compose`)

### 2) Структура

В корне репозитория ожидается папка с проектом Symfony:

```
./app
  bin/
  config/
  public/
  src/
  composer.json
...
```

### 3) Запуск одной командой

Из корня репозитория:

```bash
docker compose up -d --build
```

После старта сервисы будут доступны:

- Symfony (Nginx): **http://localhost:8080**
- RabbitMQ UI: **http://localhost:15672** (логин/пароль: `app` / `app`)
- PostgreSQL: `localhost:5432` (db/user/pass: `app` / `app` / `app`)
- Redis: `localhost:6379`

---

## ⚠️ Обязательно: выполнить миграции базы данных

После первого запуска контейнеров нужно создать БД (если её нет) и выполнить миграции.

```bash
docker compose exec php php bin/console doctrine:database:create --if-not-exists
```

```bash
docker compose exec php php bin/console doctrine:migrations:migrate
```

Если миграции уже применены — команда просто сообщит об этом.

⚠️ Без выполнения миграций приложение может падать с ошибками отсутствующих таблиц.

---

### 4) Остановка

```bash
docker compose down
```

### 5) Логи

```bash
docker compose logs -f
```

Или конкретного сервиса:

```bash
docker compose logs -f php
```

---

## Переменные окружения для Symfony

В Symfony-проекте в `app/.env.local` (или `app/.env.dev.local`) должны быть настроены DSN.

Пример:

```dotenv
APP_ENV=dev

DATABASE_URL="pgsql://app:app@postgres:5432/app?serverVersion=16&charset=utf8"
REDIS_URL="redis://redis:6379"
MESSENGER_TRANSPORT_DSN="amqp://app:app@rabbitmq:5672/%2f/messages"
```

> Контейнеры видят друг друга по именам сервисов: `postgres`, `redis`, `rabbitmq`.

---

## Полезные команды

Открыть shell в PHP-контейнере:

```bash
docker compose exec php sh
```

Проверить версии и расширения:

```bash
docker compose exec php php -v
docker compose exec php php -m | sort
```

Запустить Symfony команды:

```bash
docker compose exec php php bin/console
```

---

## Xdebug + PhpStorm (настройка дебаггера)

### 1) Включить прослушку дебага

В PhpStorm:

- **Run → Start Listening for PHP Debug Connections**

### 2) Настроить сервер (обязательно)

`Settings → PHP → Servers` → Add

- **Name**: `symfony74`  
  (должно совпадать с `PHP_IDE_CONFIG: serverName=symfony74` в `docker-compose.yml`)
- **Host**: `localhost`
- **Port**: `8080`
- **Debugger**: `Xdebug`
- ✅ **Use path mappings**
  - Local path: `<путь_к_репозиторию>/app`
  - Remote path: `/var/www/app`

### 3) Порт Xdebug

`Settings → PHP → Debug`

- **Xdebug port**: `9003`

### 4) Проверка

1. Поставьте breakpoint в коде Symfony.
2. Откройте в браузере: `http://localhost:8080`
3. PhpStorm должен остановиться на breakpoint.

Если breakpoint не ловится:

- Проверьте что listening включён.
- Проверьте что порт **9003** не занят.
- Проверьте, что контейнер видит хост:

```bash
docker compose exec php php -r "echo gethostbyname('host.docker.internal').PHP_EOL;"
```

---

## Доступы / порты (шпаргалка)

| Service   | Host            | Port  | Notes |
|----------|------------------|-------|------|
| Nginx    | localhost        | 8080  | Входная точка приложения |
| PHP-FPM  | внутри сети docker | 9000  | Nginx проксирует сюда |
| Postgres | localhost        | 5432  | user/pass/db = app/app/app |
| Redis    | localhost        | 6379  | |
| RabbitMQ | localhost        | 5672  | AMQP |
| RabbitMQ UI | localhost     | 15672 | app/app |

---

## Частые проблемы

### `COPY ... php.ini not found`

Проверьте, что файлы существуют:

- `docker/php/conf.d/php.ini`
- `docker/php/conf.d/xdebug.ini`

и вы запускаете `docker compose up -d --build` из **корня репозитория**.

### 502 Bad Gateway

Обычно PHP-контейнер ещё не поднялся или упал.

```bash
docker compose ps
docker compose logs -f php
```

---

Если нужно — добавим healthchecks, make/task команды и шаблон messenger routing под RabbitMQ.