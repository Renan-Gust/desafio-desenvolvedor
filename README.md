# 🏗️ Desafio Oliveira Trust

Este projeto consiste em uma API Laravel responsável por:

- Autenticação via Sanctum
- Upload de arquivos CSV/XLSX
- Processamento de arquivos (OpenSpout)
- Importação de milhares de linhas com chunk de 1.000
- Consultas de uploads e conteúdos
- Documentação via Swagger (L5-Swagger)

# ✅ Tecnologias Utilizadas

- **PHP 8.3 (Docker)**
- **MySQL 8 (Docker)**
- **Laravel 12**
- **Laravel Sanctum**
- **OpenSpout**
- **L5-Swagger**

---

# 🚀 Como rodar o projeto

## 1️⃣ Clone o repositório

```bash
git clone https://github.com/Renan-Gust/desafio-desenvolvedor.git
cd desafio-desenvolvedor
```

## 2️⃣ Suba os containers Docker

```bash
docker compose up -d --build
```

## 3️⃣ Entre no container do projeto

```bash
docker exec -it desafio_app bash
```

## 4️⃣ Crie e configure o .env
```bash
cp .env.example .env
php artisan key:generate
```

## 5️⃣ Rode as migrations
```bash
php artisan migrate
```

## 6️⃣ Ajuste as permissões
```bash
chmod -R 777 storage bootstrap/cache
```

O projeto estará disponível no seu browser pelo endereço: http://localhost:8000
