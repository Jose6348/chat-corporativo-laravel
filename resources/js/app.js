import './bootstrap';

// import Alpine from 'alpinejs';
//
// window.Alpine = Alpine;
//
// Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('synkro-guide-toggle');
    const guideWindow = document.getElementById('synkro-guide-window');
    const closeButton = document.getElementById('synkro-guide-close');
    const messagesContainer = document.querySelector('[data-chatbot-messages]');
    const topicButtons = document.querySelectorAll('[data-chatbot-topic]');

    if (!toggleButton || !guideWindow || !messagesContainer) {
        return;
    }

    const ACTIVE_TOPIC_CLASSES = ['is-active'];
    let conversationToken = 0;

    const welcomeMessages = [
        {
            role: 'assistant',
            text: 'Olá! Eu sou o assistente Synkro. Posso te guiar por cada recurso importante da plataforma.'
        },
        {
            role: 'assistant',
            text: 'Selecione um dos tópicos rápidos abaixo ou me deixe aberto enquanto navega. Estou sempre por perto!'
        }
    ];

    const conversations = {
        tour: [
            { role: 'assistant', text: 'Bem-vindo ao Synkro Chat! Vamos fazer um passeio rápido pela interface.' },
            {
                role: 'assistant',
                text: '• Dashboard: acompanhe o clima do time, canais em destaque e indicadores principais.\n• Barra lateral: acesse seus canais, conversas diretas e contatos favoritos.\n• Área central: participe dos canais e visualize threads e anexos sem sair da página.\n• Painel auxiliar: encontre insights, notificações e atalhos para ações frequentes.'
            },
            {
                role: 'assistant',
                text: 'Dica: fixe canais importantes com o ícone de estrela e personalize suas notificações para não perder nada.'
            }
        ],
        abas: [
            { role: 'assistant', text: 'Aqui está uma visão clara de cada aba principal da aplicação:' },
            {
                role: 'assistant',
                text: '• Dashboard: resumo executivo do trabalho em andamento e atalhos para as iniciativas recentes.\n• Canais: organize conversas por equipes, projetos ou temas. Você pode filtrar por favoritados e silenciados.\n• Chat em tempo real: converse dentro do canal selecionado e acompanhe quem está online, digitando ou reagindo.\n• Administração: disponível para líderes e admins, onde é possível gerenciar usuários, permissões e canais.\n• Perfil: centralize configurações pessoais, foto, preferências de notificação e autenticação em dois fatores.'
            },
            {
                role: 'assistant',
                text: 'Use o menu responsivo no canto superior direito para acessar opções extras quando estiver em telas menores.'
            }
        ],
        niveis: [
            { role: 'assistant', text: 'Os níveis de acesso ajudam a manter a organização e a segurança do workspace:' },
            {
                role: 'assistant',
                text: '• Colaborador: participa de canais abertos, reage às mensagens e cria conversas privadas.\n• Líder: além das permissões anteriores, pode criar canais, convidar membros e fixar comunicados.\n• Administrador: gerencia todo o ambiente, define políticas de segurança, integrações e níveis dos demais usuários.'
            },
            {
                role: 'assistant',
                text: 'Precisa mudar o nível de alguém? Solicite no canal #suporte-ti ou use o painel Administração se você já for admin.'
            }
        ],
        chat: [
            { role: 'assistant', text: 'O chat é o coração do Synkro. Olha só o que ele oferece:' },
            {
                role: 'assistant',
                text: '• Threads organizadas: segure em uma mensagem (ou clique no menu de três pontos) para iniciar discussões paralelas.\n• Reações rápidas: use emojis para sinalizar status sem interromper o fluxo.\n• Anexos inteligentes: arraste arquivos, compartilhe links e marque pessoas com “@”.\n• Indicadores em tempo real: veja quem está online, digitando ou leu a mensagem.'
            },
            {
                role: 'assistant',
                text: 'Combine isso com os recursos de busca global para encontrar qualquer conversa ou arquivo em segundos.'
            }
        ],
        boaspraticas: [
            { role: 'assistant', text: 'Algumas boas práticas para manter a comunicação impecável:' },
            {
                role: 'assistant',
                text: '• Nomeie canais com clareza e use descrições que expliquem o propósito.\n• Centralize decisões importantes em um único thread e fixe a mensagem de resumo.\n• Use menções com responsabilidade e marque apenas quem precisa ser notificado.\n• Ajuste seu status quando estiver ausente para alinhar expectativas.'
            },
            {
                role: 'assistant',
                text: 'E lembre-se: mensagens empáticas e transparentes fortalecem a cultura do time.'
            }
        ]
    };

    const createParagraph = (text) => {
        const paragraph = document.createElement('p');
        const isBullet = text.trim().startsWith('•');

        if (isBullet) {
            paragraph.className = 'chatbot-bullet';
            paragraph.textContent = text.trim().substring(1).trimStart();
        } else {
            paragraph.className = 'chatbot-paragraph';
            paragraph.textContent = text;
        }

        return paragraph;
    };

    const appendMessage = (message) => {
        const wrapper = document.createElement('div');
        wrapper.className = 'chatbot-row';

        const bubble = document.createElement('div');

        if (message.role === 'assistant') {
            const avatar = document.createElement('div');
            avatar.className = 'chatbot-avatar';
            avatar.textContent = 'S';
            wrapper.appendChild(avatar);

            bubble.className = 'chatbot-bubble';
        } else {
            bubble.className = 'chatbot-bubble-user';
            bubble.setAttribute('data-user-bubble', '');
            wrapper.classList.add('justify-end');
        }

        message.text.split('\n').forEach((line) => {
            bubble.appendChild(createParagraph(line));
        });

        if (message.role === 'user') {
            wrapper.appendChild(bubble);
        } else {
            wrapper.appendChild(bubble);
        }

        messagesContainer.appendChild(wrapper);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    };

    const typingIndicator = document.createElement('div');
    typingIndicator.className = 'chatbot-typing';
    typingIndicator.innerHTML = `
        <span class="chatbot-typing-dot"></span>
        <span class="chatbot-typing-dot"></span>
        <span class="chatbot-typing-dot"></span>
    `;

    const showTypingIndicator = () => {
        if (!messagesContainer.contains(typingIndicator)) {
            messagesContainer.appendChild(typingIndicator);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    };

    const hideTypingIndicator = () => {
        if (messagesContainer.contains(typingIndicator)) {
            messagesContainer.removeChild(typingIndicator);
        }
    };

    const wait = (ms) =>
        new Promise((resolve) => {
            setTimeout(resolve, ms);
        });

    const calculateDelay = (text) => {
        const base = 450;
        const variable = Math.min(1200, Math.max(350, text.length * 18));
        return base + variable;
    };

    const setActiveTopic = (button) => {
        topicButtons.forEach((btn) => {
            btn.classList.remove(...ACTIVE_TOPIC_CLASSES);
        });

        if (button) {
            button.classList.add(...ACTIVE_TOPIC_CLASSES);
        }
    };

    const resetConversation = () => {
        messagesContainer.innerHTML = '';
    };

    const playConversation = async (sequence, { userLabel } = {}) => {
        const token = ++conversationToken;

        resetConversation();
        hideTypingIndicator();

        if (userLabel) {
            appendMessage({ role: 'user', text: userLabel });
        }

        for (const item of sequence) {
            if (conversationToken !== token) {
                return;
            }

            showTypingIndicator();
            await wait(calculateDelay(item.text));

            if (conversationToken !== token) {
                return;
            }

            hideTypingIndicator();
            appendMessage(item);
        }

        hideTypingIndicator();
    };

    const openGuide = () => {
        guideWindow.classList.remove('hidden');
        requestAnimationFrame(() => {
            guideWindow.classList.add('is-visible');
        });
        setActiveTopic(null);
        playConversation(welcomeMessages);
    };

    const closeGuide = () => {
        guideWindow.classList.remove('is-visible');
        setActiveTopic(null);
        ++conversationToken;
        hideTypingIndicator();

        setTimeout(() => {
            guideWindow.classList.add('hidden');
        }, 250);
    };

    const handleTopicClick = (event) => {
        const button = event.currentTarget;
        const topicKey = button.dataset.chatbotTopic;
        const label = button.dataset.chatbotLabel || button.textContent.trim();

        if (!topicKey || !conversations[topicKey]) {
            return;
        }

        setActiveTopic(button);
        playConversation(conversations[topicKey], { userLabel: label });
    };

    toggleButton.addEventListener('click', () => {
        const isHidden = guideWindow.classList.contains('hidden') || !guideWindow.classList.contains('is-visible');
        if (isHidden) {
            openGuide();
        } else {
            closeGuide();
        }
    });

    if (closeButton) {
        closeButton.addEventListener('click', () => {
            closeGuide();
            toggleButton.focus();
        });
    }

    topicButtons.forEach((button) => {
        button.addEventListener('click', handleTopicClick);
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && guideWindow.classList.contains('is-visible')) {
            closeGuide();
            toggleButton.focus();
        }
    });
});

