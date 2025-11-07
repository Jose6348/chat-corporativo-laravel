# Chat Milani

Chat Milani é uma plataforma de comunicação interna construída com Laravel 12, Livewire e Pusher. O sistema oferece canais privados por nível de acesso, chat em tempo real e ferramentas administrativas para controlar todos os usuários da empresa.

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

### 1. Clonar e instalar dependências
```bash
git clone https://github.com/JorgeFalasco/chat-milani.git
cd chat-milani

composer install
npm install
```

### 2. Configurar variáveis de ambiente
```bash
cp .env.example .env
php artisan key:generate
```

Ajuste as variáveis do Pusher no `.env` (ou use Laravel Reverb se preferir).

### 3. Executar migrações e seeders
```bash
php artisan migrate --seed
```

Usuário administrador criado pelo seeder:
- Email: `admin@chat.com`
- Senha: `admin123`

### 4. Subir os servidores
```bash
php artisan serve
npm run dev
```

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
