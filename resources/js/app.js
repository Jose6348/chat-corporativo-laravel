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
            text: 'Olá! Eu sou o assistente Synkro. Trago resumos rápidos para você dominar o workspace.'
        },
        {
            role: 'assistant',
            text: 'Escolha um tópico abaixo ou deixe-me aberto para tirar dúvidas enquanto navega.'
        }
    ];

    const conversations = {
        tour: [
            { role: 'assistant', text: 'Vamos fazer um tour rápido. Em poucos passos você entende o fluxo do Synkro.' },
            {
                role: 'assistant',
                text: '• Dashboard: visão geral do time.\n• Barra lateral: canais, mensagens diretas e favoritos.\n• Área central: conversas e arquivos sem trocar de tela.'
            }
        ],
        abas: [
            { role: 'assistant', text: 'As abas principais foram pensadas para agilizar seu dia a dia.' },
            {
                role: 'assistant',
                text: '• Dashboard: atalhos e métricas.\n• Canais: organiza equipes e projetos.\n• Administração: ajustes de pessoas e permissões.\n• Perfil: preferências pessoais e segurança.'
            }
        ],
        niveis: [
            { role: 'assistant', text: 'Três níveis mantêm o workspace alinhado e seguro.' },
            {
                role: 'assistant',
                text: '• Colaborador: participa e compartilha.\n• Líder: cria canais e gerencia equipes.\n• Administrador: define regras, integrações e níveis.'
            }
        ],
        chat: [
            { role: 'assistant', text: 'O chat reúne tudo que você precisa para decisões rápidas.' },
            {
                role: 'assistant',
                text: '• Threads para conversas paralelas.\n• Reações e menções para sinalizar status.\n• Anexos rápidos e presença em tempo real.'
            }
        ],
        boaspraticas: [
            { role: 'assistant', text: 'Algumas atitudes garantem comunicação fluida.' },
            {
                role: 'assistant',
                text: '• Canais com nomes claros e descrições curtas.\n• Resumos fixados após decisões.\n• Menções apenas para quem precisa ser notificado.'
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
        const base = 320;
        const variable = Math.min(900, Math.max(260, text.length * 14));
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

