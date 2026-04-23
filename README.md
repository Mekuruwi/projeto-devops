# Projeto DevOps

Sistema de gestão de vendas com backend PHP e frontend, containerizado com Docker.

## 🚀 Tecnologias

- **Backend:** PHP 7.4
- **Frontend:** HTML, CSS, JavaScript
- **Banco de Dados:** MySQL 5.7
- **Containerização:** Docker & Docker Compose
- **Dependências:** phpdotenv

## 📋 Pré-requisitos

- Docker
- Docker Compose

## 🛠️ Instalação

1. Clone o repositório:
```bash
git clone <repositorio>
cd Projeto_DevOps
```

2. Inicie os containers:
```bash
docker-compose up --build
```

3. Acesse a aplicação:
- Frontend: `http://localhost:8000`
- Banco de Dados: `localhost:3306`

## 📦 Estrutura do Projeto

```
Projeto_DevOps/
├── Back_End/           # Backend PHP
│   ├── js/             # Scripts JavaScript
│   └── php/            # Arquivos PHP
├── Front_End/         # Frontend
│   ├── src/
│   │   ├── pages/     # Páginas PHP
│   │   ├── Scripts/   # Scripts JS
│   │   └── styles/    # Arquivos CSS
│   ├── index.php
│   ├── Script.js
│   └── Style.css
├── init_db/           # Scripts de inicialização do banco
├── docker-compose.yml # Configuração Docker Compose
├── Dockerfile        # Configuração da imagem PHP
└── composer.json     # Dependências PHP
```

## 🔧 Configuração

As variáveis de ambiente são configuradas no arquivo `docker-compose.yml`:
- `DB_HOST`: Host do banco de dados (db)
- `DB_NAME`: Nome do banco (projeto)
- `DB_USER`: Usuário do banco (dev)
- `DB_PASSWORD`: Senha do banco (dev123)

## 🗄️ Banco de Dados

O banco de dados MySQL é inicializado automaticamente ao iniciar os containers Docker. O script `init_db/init.sql` cria o banco `projeto_devops` e todas as tabelas necessárias.

### Tabelas do Sistema

#### 1. `produtos`
Tabela responsável pelo cadastro de produtos disponíveis para venda.

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `id` | INT (AI) | Identificador único do produto |
| `categoria` | VARCHAR(30) | Categoria do produto (ex: Eletrônicos, Vestuário) |
| `produto` | VARCHAR(40) | Nome do produto |
| `preco` | DECIMAL(10,2) | Preço de venda do produto |
| `estoque` | INT | Quantidade disponível em estoque |

#### 2. `vendas`
Tabela que armazena todos os registros de vendas realizadas.

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `id` | INT (AI) | Identificador único da venda |
| `categoria` | VARCHAR(30) | Categoria do produto vendido |
| `produto` | VARCHAR(40) | Nome do produto vendido |
| `preco` | DECIMAL(10,2) | Preço unitário no momento da venda |
| `quantidade` | INT | Quantidade de itens vendidos |
| `Data_registro` | DATETIME | Data e hora do registro (padrão: current_timestamp) |
| `mes_ano` | VARCHAR(10) | Mês e ano da venda (formato: MM/AAAA) |

#### 3. `usuarios`
Tabela de usuários do sistema para autenticação.

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `id` | INT (AI) | Identificador único do usuário |
| `login` | VARCHAR(50) | Nome de usuário (único) |
| `senha` | VARCHAR(255) | Senha hash (armazenada em texto plano neste projeto) |

### Usuário Padrão
- Login: `admin`
- Senha: `admin123`

> ⚠️ **Nota:** Em ambiente de produção, recomenda-se implementar hash de senhas (bcrypt) para maior segurança.

## 📄 Comandos Úteis

```bash
# Iniciar containers
docker-compose up -d

# Parar containers
docker-compose down

# Ver logs
docker-compose logs -f

# Rebuild
docker-compose up --build --force-recreate
```