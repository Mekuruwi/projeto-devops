# Projeto DevOps - Sistema de Gerenciamento de Produtos e Vendas

Um sistema web completo para gerenciamento de produtos, vendas e geração de relatórios, desenvolvido com PHP no back-end e HTML/CSS/JavaScript no front-end.

## 📋 Visão Geral

Este projeto fornece uma interface para:
- Cadastro e gerenciamento de produtos
- Registro de vendas
- Geração de relatórios e gráficos
- Controle de categorias e períodos

## 🏗️ Estrutura do Projeto

```
/workspace
├── Back_End/
│   ├── js/
│   │   └── graficos.js          # Lógica para renderização de gráficos
│   └── php/
│       ├── Conexao.php          # Configuração de conexão com banco de dados
│       ├── Main.php             # Funções principais (CRUD de produtos)
│       ├── Cadastrar_Produto.php # Cadastro de novos produtos
│       ├── Cadastrar_Vendas.php  # Registro de vendas
│       ├── Relatorio_script.php  # Geração de relatórios
│       └── api_grafico.php      # API para dados de gráficos
│
├── Front_End/
│   ├── src/
│   │   ├── pages/
│   │   │   ├── cadastro.php     # Página de cadastro de produtos
│   │   │   ├── Painel_Venda.php # Painel de vendas
│   │   │   └── Relatorio.php    # Página de relatórios
│   │   ├── Scripts/
│   │   │   └── script.js        # Scripts JavaScript
│   │   └── styles/
│   │       └── Paginas.css      # Estilos das páginas
│   ├── index.php                # Página principal
│   ├── Script.js                # Script principal (tema dark/light)
│   └── Style.css                # Estilos principais
│
├── composer.json                # Dependências PHP
└── .gitignore                   # Arquivos ignorados pelo Git
```

## 🚀 Requisitos

- PHP 7.4 ou superior
- MySQL ou MariaDB
- Composer (para dependências PHP)
- Navegador web moderno

## 📦 Instalação

### 1. Clonar o repositório

```bash
git clone <repository-url>
cd <project-directory>
```

### 2. Instalar dependências PHP

```bash
php composer.phar install
```

### 3. Configurar variáveis de ambiente

Crie um arquivo `.env` na raiz do projeto com as seguintes configurações:

```env
db_host=localhost
db_name=nome_do_banco
db_user=usuario_do_banco
db_password=sua_senha
```

### 4. Configurar o banco de dados

Crie o banco de dados e as tabelas necessárias:

```sql
CREATE DATABASE nome_do_banco;

USE nome_do_banco;

-- Tabela de produtos
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    preco DOUBLE NOT NULL
);

-- Tabela de vendas
CREATE TABLE vendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria VARCHAR(100) NOT NULL,
    produto VARCHAR(255) NOT NULL,
    preco DOUBLE NOT NULL,
    quantidade INT NOT NULL,
    Total_faturado DOUBLE NOT NULL,
    Data_registro DATETIME NOT NULL,
    mes_ano VARCHAR(20) NOT NULL
);
```

**Estrutura detalhada das tabelas:**

#### Tabela `produtos`
| Coluna    | Tipo         | Descrição              |
|-----------|--------------|------------------------|
| id        | INT          | Chave primária         |
| nome      | VARCHAR(255) | Nome do produto        |
| categoria | VARCHAR(100) | Categoria do produto   |
| preco     | DOUBLE       | Preço do produto       |

#### Tabela `vendas`
| Coluna         | Tipo          | Descrição                    |
|----------------|---------------|------------------------------|
| id             | INT           | Chave primária               |
| categoria      | VARCHAR(100)  | Categoria do produto vendido |
| produto        | VARCHAR(255)  | Nome do produto              |
| preco          | DOUBLE        | Preço unitário               |
| quantidade     | INT           | Quantidade vendida           |
| Total_faturado | DOUBLE        | Total da venda               |
| Data_registro  | DATETIME      | Data e hora da venda         |
| mes_ano        | VARCHAR(20)   | Período (formato: mmm/YYYY)  |

## 🔧 Uso

### Iniciar o servidor de desenvolvimento

```bash
# Usando o servidor embutido do PHP
php -S localhost:8000 -t Front_End
```

Acesse a aplicação em: `http://localhost:8000`

### Funcionalidades

1. **Cadastrar Produtos**
   - Acesse a página de cadastro através do menu
   - Preencha categoria, nome e preço do produto
   - Clique em "Cadastrar"

2. **Gerenciar Produtos**
   - Visualize todos os produtos cadastrados
   - Edite informações existentes
   - Exclua produtos

3. **Registrar Vendas**
   - Selecione o produto vendido
   - Informe a quantidade e período
   - Registre a venda

4. **Relatórios e Gráficos**
   - Visualize relatórios de vendas
   - Acompanhe gráficos de desempenho
   - Filtre por período

## 🎨 Recursos

- ✅ Interface responsiva
- ✅ Tema claro/escuro (dark mode)
- ✅ CRUD completo de produtos
- ✅ Registro de vendas
- ✅ Relatórios dinâmicos
- ✅ Gráficos interativos
- ✅ Conexão segura com banco de dados (prepared statements)
- ✅ Variáveis de ambiente para configuração

## 🛠️ Tecnologias Utilizadas

### Back-End
- PHP
- MySQL/MariaDB
- vlucas/phpdotenv (gerenciamento de variáveis de ambiente)

### Front-End
- HTML5
- CSS3
- JavaScript (Vanilla)

## 📝 Notas

- Certifique-se de que o servidor web tenha permissão de escrita nas pastas necessárias
- Para produção, configure adequadamente as credenciais do banco de dados
- Mantenha o arquivo `.env` fora do controle de versão (já está no `.gitignore`)

## 📄 Licença

© 2026 Projeto DevOps. Todos os direitos reservados.

## 🤝 Contribuição

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

---

**Desenvolvido como parte do Projeto DevOps**