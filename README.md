# Synkro Chat

Synkro Chat é uma plataforma de comunicação interna construída com Laravel 12, Livewire e Pusher. O sistema oferece canais privados por nível de acesso, chat em tempo real e ferramentas administrativas para controlar todos os usuários da empresa.

## Sumário
- [Recursos principais](#recursos-principais)
- [Tecnologias](#tecnologias)
- [Como rodar o projeto](#como-rodar-o-projeto)
- [Gerenciamento de usuários](#gerenciamento-de-usu%C3%A1rios)
- [Capturas de tela](#capturas-de-tela)
- [Autor](#autor)
- [Licença](#licen%C3%A7a)

## Recursos principais
- Autenticação completa com verificação de e-mail, two-factor e redefinição de senha.
- Canais privados segmentados por nível hierárquico (Nível 1 ao Nível 4).
- Chat em tempo real via Pusher + Laravel Echo, com recebimento imediato das mensagens.
- Interface moderna com TailwindCSS e componentes Livewire.
- Painel administrativo (Nível 1) para criar, editar e remover usuários dos níveis 2, 3 e 4.
- Logs detalhados e comandos Artisan para gerenciar contas rapidamente.

## Tecnologias
- PHP 8.2+
- Laravel 12
- Livewire 3
- TailwindCSS + Vite
- Pusher Channels / Laravel Echo
- SQLite (default) ou o banco de dados que preferir

## Como rodar o projeto

### ⚡ Início Rápido

```bash
# 1. Instalar dependências
composer install
npm install

# 2. Configurar ambiente
cp .env.example .env
php artisan key:generate

# 3. Configurar .env (SQL Server, SMTP, Pusher)
# Edite o arquivo .env com suas credenciais

# 4. Executar migrações
php artisan migrate --seed

# 5. Iniciar servidores (em terminais separados)
php artisan serve    # Terminal 1
npm run dev          # Terminal 2
```

### 📋 Pré-requisitos

- PHP 8.2+ com extensões `pdo_sqlsrv` e `sqlsrv`
- Composer
- Node.js 20+
- SQL Server (local ou remoto)
- Servidor SMTP (Gmail, Outlook, etc.)

### ⚙️ Configuração Necessária

**Banco de Dados (SQL Server):**
```env
DB_CONNECTION=sqlsrv
DB_SERVER=seu-servidor
DB_HOST=seu-servidor
DB_PORT=1433
DB_DATABASE=chat_milani
DB_USERNAME=          # Vazio para Windows Auth
DB_PASSWORD=          # Vazio para Windows Auth
DB_TRUST_SERVER_CERTIFICATE=true
```

**Email (SMTP):**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-de-app
MAIL_ENCRYPTION=tls
```

**Pusher (Broadcasting):**
```env
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=seu-app-id
PUSHER_APP_KEY=seu-app-key
PUSHER_APP_SECRET=seu-app-secret
PUSHER_APP_CLUSTER=us2
```

### 👤 Usuários de Teste

Após executar `php artisan migrate --seed`:

- **Admin:** `admin@chat.com` / `admin123`
- **Diretor:** `diretor@chat.com` / `diretor123`
- **Gerente:** `gerente@chat.com` / `gerente123`
- **Colaborador:** `colaborador1@chat.com` / `colab123`

### 📖 Guia Completo

Para instruções detalhadas, consulte: [docs/COMO_RODAR.md](docs/COMO_RODAR.md)

## Gerenciamento de usuários
O painel do admin (Nível 1) fica em `/admin/users`. Ele permite criar usuários dos níveis 2, 3 e 4, editar dados/senha e excluir contas. Há também os comandos Artisan:

```bash
php artisan user:create --name="João" --email="joao@chat.com" --password="senha123" --level=2
php artisan user:password joao@chat.com --password="novaSenha"
```

## Capturas de tela
| Dashboard | Chat ao vivo |
|-----------|--------------|
| ![](docs/img/dashboard.png) | ![](docs/img/chat.png) |

## Autor
Projeto desenvolvido por **José Jorge Falasco Junior**.

- LinkedIn: https://www.linkedin.com/in/josejorgefalasco/
- GitHub: https://github.com/JorgeFalasco

## Licença
Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.
