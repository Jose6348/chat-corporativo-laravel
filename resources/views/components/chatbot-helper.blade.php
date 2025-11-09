<div id="synkro-guide" class="fixed bottom-6 right-6 z-40 flex flex-col items-end gap-3 text-slate-800">
    <div id="synkro-guide-window"
        class="chatbot-window hidden w-[22rem] md:w-[460px] bg-white rounded-3xl shadow-3xl border border-indigo-100 overflow-hidden">
        <header class="chatbot-header px-5 py-4 flex items-start justify-between gap-3">
            <div class="space-y-1">
                <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-white/15 backdrop-blur-sm">
                    <span
                        class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-white/40 text-indigo-900 font-bold text-xs shadow-inner">S</span>
                    <span class="text-[11px] uppercase tracking-[0.35em] font-semibold text-white/80">Assistente
                        Synkro</span>
                </div>
                <p class="text-xl font-bold leading-tight text-white drop-shadow-sm">Guia rápido da plataforma</p>
                <p class="text-xs text-white/80 max-w-[260px] leading-snug">Descubra em segundos como aproveitar o Synkro
                    em cada aba.</p>
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
            class="chatbot-messages px-6 py-6 space-y-4 max-h-80 overflow-y-auto bg-gradient-to-b from-white via-indigo-50/30 to-white">
            <div class="chatbot-row">
                <div class="chatbot-avatar">S</div>
                <div class="chatbot-bubble">
                    <p>Oi! Eu sou o assistente Synkro. Escolha um tópico para conhecer os destaques do sistema ou deixe-me
                        aberto enquanto navega.</p>
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
        <span class="chatbot-toggle-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="w-6 h-6"
                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M7 10c0-.943.421-1.818 1.172-2.516C8.924 6.786 9.939 6.4 11 6.4c1.06 0 2.076.386 2.828 1.084.75.698 1.172 1.573 1.172 2.516 0 .943-.422 1.818-1.172 2.516-.753.7-1.768 1.084-2.828 1.084v1.2"></path>
                <path d="M11 17h.01"></path>
                <path d="M5 19.6V5.8A1.8 1.8 0 0 1 6.8 4H17.2A1.8 1.8 0 0 1 19 5.8V14l-3 3H6.8A1.8 1.8 0 0 1 5 15.2z"></path>
            </svg>
        </span>
        <span class="text-left leading-tight">
            <span class="block text-sm font-semibold text-slate-800">Assistente Synkro</span>
            <span class="block text-xs text-slate-500">Precisa de um tour guiado?</span>
        </span>
        <span class="chatbot-toggle-glow"></span>
    </button>
</div>


