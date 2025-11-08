<div id="synkro-guide" class="fixed bottom-6 right-6 z-40 flex flex-col items-end gap-3 text-slate-800">
    <div id="synkro-guide-window"
        class="chatbot-window hidden w-80 md:w-[420px] bg-white rounded-3xl shadow-3xl border border-indigo-100 overflow-hidden">
        <header class="chatbot-header px-5 py-4 flex items-start justify-between gap-3">
            <div class="space-y-1">
                <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-white/15 backdrop-blur-sm">
                    <span
                        class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-white/40 text-indigo-900 font-bold text-xs shadow-inner">S</span>
                    <span class="text-[11px] uppercase tracking-[0.35em] font-semibold text-white/80">Assistente
                        Synkro</span>
                </div>
                <p class="text-xl font-bold leading-tight text-white drop-shadow-sm">Guia inteligente da plataforma</p>
                <p class="text-xs text-white/80 max-w-[260px] leading-snug">Sempre disponível para explicar recursos,
                    níveis e melhores práticas enquanto você navega.</p>
            </div>
            <button id="synkro-guide-close" type="button"
                class="chatbot-icon-btn text-white/80 hover:text-white transition-colors duration-150 focus-visible:ring-offset-indigo-500">
                <span class="sr-only">Fechar assistente</span>
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M6 6l12 12"></path>
                    <path d="M18 6L6 18"></path>
                </svg>
            </button>
        </header>

        <div class="px-5 py-3 bg-white border-b border-slate-100 flex items-center justify-between">
            <div>
                <span class="text-[11px] uppercase font-semibold tracking-[0.3em] text-slate-500">Status</span>
                <p class="text-sm font-semibold text-slate-700 mt-1 flex items-center gap-2">
                    <span class="inline-flex w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Disponível
                </p>
            </div>
            <span class="text-[11px] uppercase font-semibold tracking-[0.3em] text-slate-400">Sincronizado</span>
        </div>

        <div data-chatbot-messages
            class="chatbot-messages px-5 py-5 space-y-4 max-h-80 overflow-y-auto bg-gradient-to-b from-white via-indigo-50/30 to-white">
            <div class="chatbot-row">
                <div class="chatbot-avatar">S</div>
                <div class="chatbot-bubble">
                    <p>Olá! Eu sou o assistente Synkro. Clique em um dos tópicos abaixo para conhecer melhor a plataforma
                        ou me mantenha aberto enquanto navega. Estou sempre no canto direito caso precise de mim. 🙂</p>
                </div>
            </div>
        </div>

        <div class="px-5 py-4 bg-white border-t border-slate-100">
            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-[0.3em]">Tópicos rápidos</p>
            <div class="mt-3 flex flex-wrap gap-2" data-chatbot-topics>
                <button type="button" class="chatbot-topic-btn" data-chatbot-topic="tour"
                    data-chatbot-label="Faça um tour rápido">
                    Faça um tour rápido
                </button>
                <button type="button" class="chatbot-topic-btn" data-chatbot-topic="abas"
                    data-chatbot-label="Explique cada aba">
                    Explique cada aba
                </button>
                <button type="button" class="chatbot-topic-btn" data-chatbot-topic="niveis"
                    data-chatbot-label="Como funcionam os níveis">
                    Como funcionam os níveis
                </button>
                <button type="button" class="chatbot-topic-btn" data-chatbot-topic="chat"
                    data-chatbot-label="Recursos do chat">
                    Recursos do chat
                </button>
                <button type="button" class="chatbot-topic-btn" data-chatbot-topic="boaspraticas"
                    data-chatbot-label="Boas práticas de comunicação">
                    Boas práticas de comunicação
                </button>
            </div>
            <p class="mt-3 text-[11px] text-slate-500 leading-relaxed">
                Dica: abra um canal com a equipe certa se precisar de ajuda humana. Você também pode fixar o assistente
                para consultas rápidas durante o trabalho.
            </p>
        </div>
    </div>

    <button id="synkro-guide-toggle" type="button" class="chatbot-toggle-btn">
        <span
            class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tr from-indigo-600 via-indigo-500 to-sky-500 text-white font-semibold shadow-inner">
            ?
        </span>
        <span class="text-left leading-tight">
            <span class="block text-sm font-semibold text-slate-800">Assistente Synkro</span>
            <span class="block text-xs text-slate-500">Precisa de um tour guiado?</span>
        </span>
        <span class="chatbot-toggle-glow"></span>
    </button>
</div>

