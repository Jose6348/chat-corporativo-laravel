# Documentação Técnica Completa - Synkro Chat

**Versão:** 1.1.0  
**Última Atualização:** Novembro 2025  
**Autor:** José Jorge Falasco Junior

---

## 📋 Índice

1. [Visão Geral do Sistema](#1-visão-geral-do-sistema)
2. [Arquitetura e Stack Tecnológica](#2-arquitetura-e-stack-tecnológica)
3. [Estrutura do Projeto](#3-estrutura-do-projeto)
4. [Banco de Dados](#4-banco-de-dados)
5. [Autenticação e Segurança](#5-autenticação-e-segurança)
6. [Sistema de Canais e Mensagens](#6-sistema-de-canais-e-mensagens)
7. [Tempo Real (Broadcasting)](#7-tempo-real-broadcasting)
8. [Painel Administrativo](#8-painel-administrativo)
9. [Comandos Artisan](#9-comandos-artisan)
10. [Configuração e Instalação](#10-configuração-e-instalação)
11. [Rotas e Endpoints](#11-rotas-e-endpoints)
12. [Testes](#12-testes)
13. [Deploy e Produção](#13-deploy-e-produção)

---

## 1. Visão Geral do Sistema

### 1.1. Descrição

Synkro Chat é uma plataforma de comunicação interna em tempo real, orientada a canais hierárquicos, com moderação e governança centralizadas. O sistema permite comunicação segmentada por níveis de acesso, garantindo que informações sensíveis sejam acessíveis apenas aos usuários autorizados.

### 1.2. Problema que Resolve

- Reduz ruídos entre áreas críticas (Diretoria, Gestão e Operações)
- Consolida conversas, anúncios e arquivos em um único hub auditável
- Controla permissões por nível hierárquico
- Garante comunicação em tempo real com histórico persistente

### 1.3. Público-Alvo

- Colaboradores internos (níveis 1-4)
- Líderes de equipe
- Administradores de TI

### 1.4. Principais Módulos

1. **Autenticação e Segurança**
   - Login/Logout
   - Autenticação de dois fatores (2FA) via email
   - Redefinição de senha
   - Verificação de email

2. **Dashboard**
   - Visão rápida dos canais liberados por nível
   - Acesso direto aos canais autorizados

3. **Chat em Tempo Real**
   - Livewire + Pusher para comunicação instantânea
   - Threads lineares por canal
   - Histórico persistente

4. **Painel Administrativo**
   - CRUD completo de usuários
   - Gerenciamento de níveis de acesso (1-4)
   - Controle de permissões

5. **Sistema de Broadcast**
   - Canais privados (`chat.{channelId}`)
   - Entrega imediata via Pusher Channels

---

## 2. Arquitetura e Stack Tecnológica

### 2.1. Stack Principal

| Componente | Tecnologia | Versão |
|------------|-----------|--------|
| Linguagem | PHP | 8.2+ |
| Framework | Laravel | 12.0 |
| Frontend Reativo | Livewire | 3.6 |
| Estilização | TailwindCSS | 3.1+ |
| Build Tool | Vite | 7.0+ |
| JavaScript | Alpine.js | 3.4+ |
| WebSockets | Pusher Channels | 8.4+ |
| ORM | Eloquent | 12.0 |
| Banco de Dados | SQL Server | 16.00+ |
| Email | SMTP Genérico | - |

### 2.2. Dependências Principais

#### Backend (composer.json)
```json
{
  "laravel/framework": "^12.0",
  "livewire/livewire": "^3.6",
  "pusher/pusher-php-server": "^7.2",
  "mailersend/laravel-driver": "^2.12",
  "laravel/reverb": "^1.6"
}
```

#### Frontend (package.json)
```json
{
  "laravel-echo": "^2.2.6",
  "pusher-js": "^8.4.0",
  "alpinejs": "^3.4.2",
  "tailwindcss": "^3.1.0",
  "vite": "^7.0.7"
}
```

### 2.3. Arquitetura Geral

- **Padrão:** MVC (Model-View-Controller) do Laravel
- **Reatividade:** Livewire 3 (MPA Reativo)
- **Broadcasting:** Pusher Channels (WebSockets gerenciados)
- **Autenticação:** Laravel Breeze + 2FA customizado
- **Autorização:** Policies (ChannelPolicy, UserPolicy)

### 2.4. Padrões de Design

1. **Policy Pattern:** Controle fino de acesso por nível
2. **Event-Driven:** Events & Listeners para propagação de mudanças
3. **Repository Implícito:** Eloquent encapsula persistência
4. **Request Validation:** FormRequests para validação
5. **Service Provider:** BroadcastServiceProvider para configuração

---

## 3. Estrutura do Projeto

```
chat-backend/
├── app/
│   ├── Console/
│   │   └── Commands/
│   │       ├── CreateUser.php          # Cria usuários via CLI
│   │       └── ChangeUserPassword.php  # Altera senha via CLI
│   ├── Events/
│   │   ├── MessageSent.php             # Evento de mensagem enviada
│   │   └── MessageDeleted.php         # Evento de mensagem deletada
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   └── UserController.php  # CRUD de usuários
│   │   │   ├── Auth/
│   │   │   │   ├── AuthenticatedSessionController.php
│   │   │   │   ├── TwoFactorChallengeController.php
│   │   │   │   └── ... (outros controllers de auth)
│   │   │   ├── ChannelController.php
│   │   │   └── ProfileController.php
│   │   ├── Middleware/
│   │   │   └── EnsureUserIsAdmin.php
│   │   └── Requests/
│   │       ├── Auth/LoginRequest.php
│   │       └── ProfileUpdateRequest.php
│   ├── Livewire/
│   │   └── ChatRoom.php                # Componente principal do chat
│   ├── Mail/
│   │   └── TwoFactorCodeMail.php       # Email de código 2FA
│   ├── Models/
│   │   ├── User.php
│   │   ├── Channel.php
│   │   └── Message.php
│   ├── Policies/
│   │   ├── ChannelPolicy.php
│   │   └── UserPolicy.php
│   └── Providers/
│       ├── AppServiceProvider.php
│       ├── AuthServiceProvider.php
│       └── BroadcastServiceProvider.php
├── config/
│   ├── database.php                    # Config SQL Server
│   ├── mail.php                        # Config SMTP
│   ├── broadcasting.php                # Config Pusher
│   └── ...
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2025_11_05_025738_create_channels_table.php
│   │   ├── 2025_11_05_025748_create_messages_table.php
│   │   ├── 2025_11_19_032736_add_allowed_levels_to_channels_table.php
│   │   ├── 2025_11_24_173408_make_user_id_nullable_in_messages_table.php
│   │   └── 2025_11_24_181142_convert_datetime_to_datetime2_for_sqlserver.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── UserSeeder.php
│       └── ChannelSeeder.php
├── resources/
│   ├── views/
│   │   ├── admin/                      # Views do painel admin
│   │   ├── auth/                       # Views de autenticação
│   │   ├── channels/                   # Views de canais
│   │   ├── components/                 # Componentes Blade
│   │   ├── emails/                     # Templates de email
│   │   ├── livewire/                   # Views do Livewire
│   │   └── profile/                    # Views de perfil
│   ├── js/
│   │   ├── app.js
│   │   ├── bootstrap.js
│   │   └── echo.js                     # Config Laravel Echo
│   └── css/
│       └── app.css
├── routes/
│   ├── web.php                         # Rotas principais
│   ├── auth.php                        # Rotas de autenticação
│   ├── channels.php                    # Broadcast channels
│   └── console.php                     # Comandos Artisan
└── tests/
    ├── Feature/
    │   ├── Auth/                       # Testes de autenticação
    │   └── ProfileTest.php
    └── Unit/
```

---

## 4. Banco de Dados

### 4.1. Configuração Atual

**SGBD:** SQL Server 16.00+  
**Autenticação:** Windows Authentication (recomendado) ou SQL Server Authentication  
**Conexão:** Via extensões `pdo_sqlsrv` e `sqlsrv`

### 4.2. Variáveis de Ambiente (.env)

```env
DB_CONNECTION=sqlsrv
DB_SERVER=ZEZINHO-DESKTOP          # Nome do servidor SQL Server
DB_HOST=ZEZINHO-DESKTOP            # Host do servidor
DB_PORT=1433                        # Porta padrão SQL Server
DB_DATABASE=chat_milani            # Nome do banco
DB_NAME=chat_milani                # Alias para DB_DATABASE
DB_USERNAME=                        # Vazio para Windows Auth
DB_PASSWORD=                        # Vazio para Windows Auth
DB_TRUST_SERVER_CERTIFICATE=true   # Confiar em certificado
DB_ENCRYPT=no                      # Desabilitar criptografia (dev)
```

### 4.3. Estrutura das Tabelas

#### 4.3.1. Tabela `users`

| Campo | Tipo | Descrição |
|-------|------|-----------|
| id | bigint | PK, auto-increment |
| name | nvarchar(255) | Nome completo |
| email | nvarchar(255) | Email único |
| email_verified_at | datetime2 | Data de verificação |
| password | nvarchar(255) | Hash bcrypt |
| remember_token | nvarchar(100) | Token "lembrar-me" |
| access_level | int | Nível hierárquico (1-4) |
| two_factor_code | nvarchar(255) | Código 2FA temporário |
| two_factor_expires_at | datetime2 | Expiração do código |
| created_at | datetime2 | Data de criação |
| updated_at | datetime2 | Data de atualização |

**Índices:**
- PK: `id`
- UNIQUE: `email`

#### 4.3.2. Tabela `channels`

| Campo | Tipo | Descrição |
|-------|------|-----------|
| id | bigint | PK, auto-increment |
| name | nvarchar(255) | Nome do canal |
| description | nvarchar(max) | Descrição do canal |
| required_level | int | Nível mínimo necessário |
| allowed_levels | nvarchar(max) | JSON array de níveis permitidos |
| created_at | datetime2 | Data de criação |
| updated_at | datetime2 | Data de atualização |

**Índices:**
- PK: `id`

#### 4.3.3. Tabela `messages`

| Campo | Tipo | Descrição |
|-------|------|-----------|
| id | bigint | PK, auto-increment |
| user_id | bigint | FK para users (nullable) |
| channel_id | bigint | FK para channels |
| body | nvarchar(max) | Conteúdo da mensagem |
| created_at | datetime2 | Data de criação |
| updated_at | datetime2 | Data de atualização |

**Índices:**
- PK: `id`
- FK: `user_id` → `users.id` (onDelete: cascade)
- FK: `channel_id` → `channels.id` (onDelete: cascade)

### 4.4. Migrações Especiais

#### 4.4.1. `convert_datetime_to_datetime2_for_sqlserver.php`

**Propósito:** Converter colunas `datetime` para `datetime2` no SQL Server para suportar microsegundos do Laravel.

**Aplicação:** Executada automaticamente durante `php artisan migrate` quando o driver é `sqlsrv`.

### 4.5. Seeders

#### 4.5.1. `ChannelSeeder`
Cria 4 canais padrão:
- Canal da Diretoria (Nível 1)
- Canal de Gestores (Nível 2)
- Canal de Equipes (Nível 3)
- Canal Geral (Nível 4)

#### 4.5.2. `UserSeeder`
Cria usuários de teste para cada nível:
- **Nível 1:** admin@chat.com / admin123
- **Nível 2:** diretor@chat.com / diretor123
- **Nível 3:** gerente@chat.com / gerente123
- **Nível 4:** colaborador1@chat.com / colab123

---

## 5. Autenticação e Segurança

### 5.1. Fluxo de Autenticação

1. **Login Inicial**
   - Usuário acessa `/login`
   - Credenciais validadas em `LoginRequest`
   - Se válidas, gera código 2FA e envia por email

2. **Autenticação de Dois Fatores (2FA)**
   - Usuário redirecionado para `/two-factor-challenge`
   - Código de 6 dígitos enviado para o email cadastrado
   - Código válido por 10 minutos
   - Após validação, usuário autenticado

3. **Sessão**
   - Cookie de sessão Laravel
   - Middleware `auth` protege rotas
   - Middleware `verified` garante email verificado

### 5.2. Implementação 2FA

**Arquivo:** `app/Http/Controllers/Auth/AuthenticatedSessionController.php`

```php
// Gera código de 6 dígitos
$user->generateTwoFactorCode();

// Envia por email
Mail::to($user->email)->send(new TwoFactorCodeMail($user->two_factor_code, $user->email));
```

**Arquivo:** `app/Models/User.php`

```php
public function generateTwoFactorCode(): void
{
    $this->two_factor_code = rand(100000, 999999);
    $this->two_factor_expires_at = now()->addMinutes(10);
    $this->save();
}
```

### 5.3. Email de 2FA

**Template:** `resources/views/emails/two-factor-code.blade.php`  
**Classe:** `app/Mail/TwoFactorCodeMail.php`

**Configuração SMTP (.env):**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com          # Ou outro servidor SMTP
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-de-app    # Senha de app do Gmail
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@exemplo.com
MAIL_FROM_NAME="Synkro Chat"
```

### 5.4. Níveis de Acesso

| Nível | Nome | Descrição | Permissões |
|-------|------|-----------|------------|
| 1 | Admin/C-Level | Administrador | Acesso total, painel admin |
| 2 | Diretoria | Diretores | Canais nível 2, 3 e 4 |
| 3 | Gerência | Gerentes | Canais nível 3 e 4 |
| 4 | Colaborador | Colaboradores | Apenas canais nível 4 |

### 5.5. Policies

#### 5.5.1. `ChannelPolicy`
- `view()`: Verifica se `user->access_level <= channel->required_level`
- Suporta `allowed_levels` (array JSON) para controle granular

#### 5.5.2. `UserPolicy`
- Apenas nível 1 pode gerenciar usuários
- Impede downgrade de nível 1

### 5.6. Middleware

- `auth`: Requer autenticação
- `verified`: Requer email verificado
- `admin`: Requer nível 1 (definido em `EnsureUserIsAdmin`)

---

## 6. Sistema de Canais e Mensagens

### 6.1. Modelo Channel

**Arquivo:** `app/Models/Channel.php`

**Campos principais:**
- `name`: Nome do canal
- `description`: Descrição
- `required_level`: Nível mínimo (compatibilidade)
- `allowed_levels`: Array JSON de níveis permitidos (novo)

**Método `allowsLevel(int $level)`:**
```php
public function allowsLevel(int $level): bool
{
    // Prioriza allowed_levels se definido
    if ($this->allowed_levels !== null && is_array($this->allowed_levels)) {
        return in_array($level, $this->allowed_levels);
    }
    // Fallback para required_level
    return $level <= $this->required_level;
}
```

### 6.2. Modelo Message

**Arquivo:** `app/Models/Message.php`

**Relacionamentos:**
- `belongsTo(User::class)`: Autor da mensagem
- `belongsTo(Channel::class)`: Canal da mensagem

**Observação:** `user_id` é nullable para suportar mensagens de sistema.

### 6.3. Componente Livewire ChatRoom

**Arquivo:** `app/Livewire/ChatRoom.php`

**Funcionalidades:**
- Carrega mensagens existentes do canal
- Envia novas mensagens
- Escuta broadcasts via Pusher
- Atualiza interface em tempo real

**Métodos principais:**
- `mount(Channel $channel)`: Inicializa componente
- `sendMessage()`: Envia mensagem e dispara evento
- `addMessage($data)`: Adiciona mensagem recebida via broadcast
- `removeMessage($messageId)`: Remove mensagem deletada

---

## 7. Tempo Real (Broadcasting)

### 7.1. Configuração Pusher

**Arquivo:** `config/broadcasting.php`

**Variáveis de Ambiente (.env):**
```env
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=seu-app-id
PUSHER_APP_KEY=seu-app-key
PUSHER_APP_SECRET=seu-app-secret
PUSHER_APP_CLUSTER=us2
```

### 7.2. Eventos

#### 7.2.1. `MessageSent`
- **Canal:** `chat.{channelId}` (PrivateChannel)
- **Evento:** `message.sent`
- **Payload:** Dados da mensagem com usuário

#### 7.2.2. `MessageDeleted`
- **Canal:** `chat.{channelId}` (PrivateChannel)
- **Evento:** `message.deleted`
- **Payload:** ID da mensagem deletada

### 7.3. Autorização de Canais

**Arquivo:** `routes/channels.php`

```php
Broadcast::channel('chat.{channelId}', function ($user, $channelId) {
    $channel = Channel::find($channelId);
    if (!$channel) return false;
    
    return [
        'id' => $user->id,
        'name' => $user->name,
    ];
});
```

### 7.4. Frontend (Laravel Echo)

**Arquivo:** `resources/js/echo.js`

```javascript
Echo.private(`chat.${channelId}`)
    .listen('.message.sent', (e) => {
        // Atualiza interface
    });
```

---

## 8. Painel Administrativo

### 8.1. Rotas

**Prefixo:** `/admin`  
**Middleware:** `auth`, `admin` (nível 1)

**Rotas:**
- `GET /admin/users` - Lista usuários
- `GET /admin/users/create` - Formulário de criação
- `POST /admin/users` - Cria usuário
- `GET /admin/users/{user}` - Visualiza usuário
- `GET /admin/users/{user}/edit` - Formulário de edição
- `PATCH /admin/users/{user}` - Atualiza usuário
- `DELETE /admin/users/{user}` - Deleta usuário

### 8.2. Controller

**Arquivo:** `app/Http/Controllers/Admin/UserController.php`

**Funcionalidades:**
- CRUD completo de usuários
- Validação de níveis
- Hash de senhas
- Verificação de permissões

---

## 9. Comandos Artisan

### 9.1. `user:create`

Cria um novo usuário via CLI.

**Sintaxe:**
```bash
php artisan user:create \
    --name="João Silva" \
    --email="joao@exemplo.com" \
    --password="senha123" \
    --level=2
```

**Parâmetros:**
- `--name`: Nome do usuário (obrigatório)
- `--email`: Email único (obrigatório)
- `--password`: Senha mínima 8 caracteres (obrigatório)
- `--level`: Nível de acesso 1-4 (padrão: 4)

### 9.2. `user:password`

Altera a senha de um usuário existente.

**Sintaxe:**
```bash
php artisan user:password joao@exemplo.com --password="novaSenha123"
```

**Parâmetros:**
- `email`: Email do usuário (obrigatório)
- `--password`: Nova senha (se omitido, solicita interativamente)

---

## 10. Configuração e Instalação

### 10.1. Requisitos

- PHP 8.2+
- Composer
- Node.js 20+
- SQL Server 16.00+ (com extensões `pdo_sqlsrv` e `sqlsrv`)
- Extensões PHP: `pdo`, `pdo_sqlsrv`, `sqlsrv`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`

### 10.2. Instalação

```bash
# 1. Clonar repositório
git clone https://github.com/JorgeFalasco/chat-milani.git
cd chat-milani

# 2. Instalar dependências
composer install
npm install

# 3. Configurar ambiente
cp .env.example .env
php artisan key:generate

# 4. Configurar banco de dados no .env
# (ver seção 4.2)

# 5. Executar migrações e seeders
php artisan migrate --seed

# 6. Iniciar servidores
php artisan serve    # Backend (porta 8000)
npm run dev          # Frontend (Vite)
```

### 10.3. Configuração SQL Server

#### 10.3.1. Instalar Extensões PHP

**Windows:**
1. Baixar drivers da Microsoft: https://docs.microsoft.com/en-us/sql/connect/php/download-drivers-php-sql-server
2. Extrair `php_pdo_sqlsrv.dll` e `php_sqlsrv.dll` para `ext/`
3. Adicionar ao `php.ini`:
   ```ini
   extension=pdo_sqlsrv
   extension=sqlsrv
   ```

#### 10.3.2. Configurar Conexão

**Windows Authentication (Recomendado):**
```env
DB_CONNECTION=sqlsrv
DB_HOST=SEU-SERVIDOR
DB_PORT=1433
DB_DATABASE=chat_milani
DB_USERNAME=
DB_PASSWORD=
DB_TRUST_SERVER_CERTIFICATE=true
```

**SQL Server Authentication:**
```env
DB_CONNECTION=sqlsrv
DB_HOST=SEU-SERVIDOR
DB_PORT=1433
DB_DATABASE=chat_milani
DB_USERNAME=sa
DB_PASSWORD=sua-senha
DB_TRUST_SERVER_CERTIFICATE=true
```

### 10.4. Configuração SMTP

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-de-app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@exemplo.com
MAIL_FROM_NAME="Synkro Chat"
```

**Nota:** Para Gmail, é necessário criar uma "Senha de App" em https://myaccount.google.com/apppasswords

---

## 11. Rotas e Endpoints

### 11.1. Rotas Públicas

| Método | Rota | Controller | Descrição |
|--------|------|------------|-----------|
| GET | `/` | Closure | Página inicial |
| GET | `/login` | AuthenticatedSessionController@create | Formulário de login |
| POST | `/login` | AuthenticatedSessionController@store | Processa login |
| GET | `/register` | RegisteredUserController@create | Formulário de registro |
| POST | `/register` | RegisteredUserController@store | Processa registro |
| GET | `/two-factor-challenge` | TwoFactorChallengeController@create | Formulário 2FA |
| POST | `/two-factor-challenge` | TwoFactorChallengeController@store | Valida código 2FA |
| GET | `/forgot-password` | PasswordResetLinkController@create | Solicita reset |
| POST | `/forgot-password` | PasswordResetLinkController@store | Envia email reset |

### 11.2. Rotas Autenticadas

| Método | Rota | Controller | Middleware | Descrição |
|--------|------|------------|------------|-----------|
| GET | `/dashboard` | ChannelController@index | auth, verified | Dashboard principal |
| GET | `/channels/{channel}` | ChannelController@show | auth, policy | Visualiza canal |
| GET | `/channels/create` | ChannelController@create | auth | Formulário criar canal |
| POST | `/channels` | ChannelController@store | auth | Cria canal |
| DELETE | `/channels/{channel}` | ChannelController@destroy | auth | Deleta canal |
| GET | `/profile` | ProfileController@edit | auth | Edita perfil |
| PATCH | `/profile` | ProfileController@update | auth | Atualiza perfil |
| DELETE | `/profile` | ProfileController@destroy | auth | Deleta conta |

### 11.3. Rotas Administrativas

| Método | Rota | Controller | Middleware | Descrição |
|--------|------|------------|------------|-----------|
| GET | `/admin/users` | UserController@index | auth, admin | Lista usuários |
| GET | `/admin/users/create` | UserController@create | auth, admin | Formulário criar |
| POST | `/admin/users` | UserController@store | auth, admin | Cria usuário |
| GET | `/admin/users/{user}` | UserController@show | auth, admin | Visualiza usuário |
| GET | `/admin/users/{user}/edit` | UserController@edit | auth, admin | Formulário editar |
| PATCH | `/admin/users/{user}` | UserController@update | auth, admin | Atualiza usuário |
| DELETE | `/admin/users/{user}` | UserController@destroy | auth, admin | Deleta usuário |

### 11.4. Broadcast Channels

| Canal | Tipo | Autorização |
|-------|------|-------------|
| `chat.{channelId}` | PrivateChannel | Verifica acesso ao canal |

---

## 12. Testes

### 12.1. Estrutura de Testes

```
tests/
├── Feature/
│   ├── Auth/
│   │   ├── AuthenticationTest.php
│   │   ├── EmailVerificationTest.php
│   │   ├── PasswordConfirmationTest.php
│   │   ├── PasswordResetTest.php
│   │   ├── RegistrationTest.php
│   │   └── TwoFactorAuthenticationTest.php
│   ├── ExampleTest.php
│   └── ProfileTest.php
└── Unit/
    └── ExampleTest.php
```

### 12.2. Executar Testes

```bash
# Todos os testes
php artisan test

# Apenas Feature
php artisan test --testsuite=Feature

# Teste específico
php artisan test tests/Feature/Auth/AuthenticationTest.php
```

### 12.3. Cobertura

**Alvo:** 70% para módulos críticos (autenticação, mensagens, policies)

---

## 13. Deploy e Produção

### 13.1. Checklist de Deploy

- [ ] Configurar variáveis de ambiente de produção
- [ ] Executar `composer install --no-dev`
- [ ] Executar `npm run build`
- [ ] Executar `php artisan config:cache`
- [ ] Executar `php artisan route:cache`
- [ ] Executar `php artisan migrate --force`
- [ ] Configurar servidor web (Nginx/Apache)
- [ ] Configurar SSL/TLS
- [ ] Configurar backup automático do banco
- [ ] Configurar monitoramento (logs, erros)

### 13.2. Variáveis de Ambiente Produção

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://seu-dominio.com

DB_CONNECTION=sqlsrv
DB_HOST=servidor-producao
DB_DATABASE=chat_milani_prod
# ... outras configs

BROADCAST_DRIVER=pusher
PUSHER_APP_ID=...
PUSHER_APP_KEY=...
PUSHER_APP_SECRET=...

MAIL_MAILER=smtp
MAIL_HOST=...
# ... outras configs
```

### 13.3. Otimizações

```bash
# Cache de configuração
php artisan config:cache

# Cache de rotas
php artisan route:cache

# Cache de views
php artisan view:cache

# Otimizar autoloader
composer install --optimize-autoloader --no-dev
```

### 13.4. Backup

**Banco de Dados:**
```bash
# SQL Server
sqlcmd -S servidor -d chat_milani -E -Q "BACKUP DATABASE chat_milani TO DISK='backup.bak'"
```

**Arquivos:**
- `storage/app`: Uploads e arquivos gerados
- `storage/logs`: Logs do sistema

---

## 📝 Notas Finais

### Mudanças Recentes (v1.1.0)

1. **Migração para SQL Server:** Sistema agora usa SQL Server como banco principal
2. **2FA via Email:** Implementação customizada de autenticação de dois fatores
3. **SMTP Genérico:** Suporte para qualquer servidor SMTP (Gmail, Outlook, etc.)
4. **Migração datetime2:** Conversão automática de datetime para datetime2 no SQL Server
5. **Windows Authentication:** Suporte nativo para autenticação integrada do Windows

### Próximas Melhorias

- [ ] Suporte a anexos de arquivos
- [ ] Notificações push
- [ ] Busca de mensagens
- [ ] Exportação de conversas
- [ ] Integração com LDAP/Active Directory

---

**Documentação mantida por:** José Jorge Falasco Junior  
**Última revisão:** Novembro 2025  
**Versão do documento:** 1.1.0

