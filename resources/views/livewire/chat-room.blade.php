<div>
    <div class="space-y-4" id="chat-room">
        <!-- Header do Chat -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-white p-2 rounded-lg shadow-sm">
                    <img src="{{ asset('logo-synkro.png') }}" alt="Synkro" class="w-6 h-6 object-contain">
                </div>
                <div>
                    <h2 class="text-lg font-bold text-white">{{ $channel->name }}</h2>
                    <p class="text-sm text-blue-100">{{ count($messages) }} mensagens</p>
                </div>
            </div>
            <button 
                wire:click="clearAllMessages" 
                wire:confirm="Tem certeza que deseja excluir todas as mensagens?"
                class="btn-danger text-sm flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                <span>Limpar Chat</span>
            </button>
        </div>
        
        <!-- Área de Mensagens -->
        <div id="messages" class="bg-gradient-to-b from-gray-50 to-white p-6 rounded-lg h-[60vh] overflow-y-auto border border-gray-200 shadow-inner">
            @forelse ($messages as $message)
            <div class="mb-4 group"
                wire:key="msg-{{ $message['id'] ?? md5(($message['body'] ?? '').($message['user']['name'] ?? '')) }}">
                @if(($message['user']['id'] ?? null) === auth()->id())
                    <!-- Mensagem do próprio usuário (direita) -->
                    <div class="flex justify-end">
                        <div class="max-w-[70%] flex items-end space-x-2">
                            <div class="flex-1"></div>
                            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 text-white rounded-2xl rounded-br-md px-4 py-3 shadow-md group-hover:shadow-lg transition-shadow relative">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-xs font-semibold text-blue-100">Você</span>
                                    @if(($message['user']['id'] ?? null) === auth()->id())
                                    <button 
                                        wire:click="deleteMessage({{ $message['id'] ?? 'null' }})"
                                        wire:confirm="Tem certeza que deseja excluir esta mensagem?"
                                        class="opacity-0 group-hover:opacity-100 transition-opacity ml-2 hover:bg-white/20 rounded p-1"
                                        title="Excluir mensagem">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                    @endif
                                </div>
                                <p class="text-sm leading-relaxed">{{ $message['body'] ?? '' }}</p>
                                <span class="text-xs text-blue-100 block mt-2">
                                    {{ \Carbon\Carbon::parse($message['created_at'] ?? now())->format('H:i') }}
                                </span>
                            </div>
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-semibold text-sm shadow-md">
                                {{ strtoupper(substr($message['user']['name'] ?? 'U', 0, 1)) }}
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Mensagem de outro usuário (esquerda) -->
                    <div class="flex justify-start">
                        <div class="max-w-[70%] flex items-end space-x-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-gray-400 to-gray-500 rounded-full flex items-center justify-center text-white font-semibold text-sm shadow-md">
                                {{ strtoupper(substr($message['user']['name'] ?? 'U', 0, 1)) }}
                            </div>
                            <div class="bg-white border border-gray-200 rounded-2xl rounded-bl-md px-4 py-3 shadow-sm group-hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-xs font-semibold text-gray-600">{{ $message['user']['name'] ?? 'Usuário' }}</span>
                                </div>
                                <p class="text-sm text-gray-800 leading-relaxed">{{ $message['body'] ?? '' }}</p>
                                <span class="text-xs text-gray-500 block mt-2">
                                    {{ \Carbon\Carbon::parse($message['created_at'] ?? now())->format('H:i') }}
                                </span>
                            </div>
                            <div class="flex-1"></div>
                        </div>
                    </div>
                @endif
            </div>
            @empty
            <div class="flex flex-col items-center justify-center h-full text-center py-12">
                <div class="bg-gray-100 rounded-full p-6 w-20 h-20 mb-4 flex items-center justify-center">
                    <img src="{{ asset('logo-synkro.png') }}" alt="Synkro" class="w-12 h-12 object-contain opacity-70">
                </div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Nenhuma mensagem ainda</h3>
                <p class="text-gray-500">Seja o primeiro a enviar uma mensagem!</p>
            </div>
            @endforelse
        </div>

        <!-- Formulário de Envio -->
        <form wire:submit.prevent="sendMessage" class="flex space-x-3 bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
            <div class="flex-1 relative">
                <input 
                    type="text" 
                    wire:model.defer="newMessage" 
                    placeholder="Digite sua mensagem..." 
                    class="input-field w-full pr-12"
                    autocomplete="off">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <button 
                type="submit" 
                class="btn-primary flex items-center space-x-2 px-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                <span>Enviar</span>
            </button>
        </form>
    </div>

    @push('scripts')
    <script>
        (function() {
            const channelId = @json($channel->id);
            let channelInstance = null;
            let channelSubscribed = false;

            console.log('🔧 boot do chat: script injetado para channel', channelId);

            function getComponent() {
                // Tenta encontrar o componente Livewire de várias formas
                if (channelInstance) {
                    return channelInstance;
                }

                // Forma 1: Via DOM
                const chatRoom = document.getElementById('chat-room');
                if (chatRoom && window.Livewire) {
                    const livewireElement = chatRoom.closest('[wire\\:id]');
                    if (livewireElement) {
                        const id = livewireElement.getAttribute('wire:id');
                        const component = window.Livewire.find(id);
                        if (component) {
                            channelInstance = component;
                            console.log('✅ Componente encontrado via DOM:', id);
                            return component;
                        }
                    }
                }

                // Forma 2: Via Livewire.all()
                if (window.Livewire && window.Livewire.all) {
                    const components = window.Livewire.all();
                    if (components.length > 0) {
                        // Pega o primeiro componente (assumindo que é o ChatRoom)
                        channelInstance = components[0];
                        console.log('✅ Componente encontrado via all():', channelInstance.id);
                        return channelInstance;
                    }
                }

                return null;
            }

            function initChat() {
                if (channelSubscribed) {
                    console.log('⚠️ Chat já inicializado, ignorando...');
                    return;
                }

                console.log('🚀 Inicializando chat para channel', channelId);

                function whenEchoReady(cb, tries = 40) {
                    if (window.Echo && window.Echo.connector && window.Echo.connector.pusher) {
                        return cb();
                    }
                    if (tries <= 0) {
                        return console.error('❌ Echo não ficou pronto a tempo.');
                    }
                    setTimeout(() => whenEchoReady(cb, tries - 1), 100);
                }

                whenEchoReady(() => {
                    console.log('🛰️ Inscrevendo em chat.' + channelId);

                    const ch = window.Echo.private(`chat.${channelId}`);

                    ch.subscribed(() => {
                        console.log('✅ Inscrito (Echo) em chat.' + channelId);
                        channelSubscribed = true;
                    })
                    .error(err => {
                        console.error('❌ Erro na inscrição (Echo):', err);
                        channelSubscribed = false;
                    })
                    .listen('.message.sent', (e) => {
                        console.log('📩 Evento recebido do Pusher:', e);
                        
                        // Extrai a mensagem do evento
                        const messageData = e.message || e.data?.message;
                        
                        if (!messageData) {
                            console.error('❌ Mensagem vazia no evento', e);
                            return;
                        }
                        
                        console.log('📤 Dados da mensagem:', messageData);
                        
                        // Obtém o componente
                        const component = getComponent();
                        
                        if (!component) {
                            console.error('❌ Componente Livewire não encontrado!');
                            // Tenta novamente encontrar o componente
                            setTimeout(() => {
                                const retryComponent = getComponent();
                                if (retryComponent) {
                                    dispatchMessage(retryComponent, messageData);
                                }
                            }, 100);
                            return;
                        }
                        
                        dispatchMessage(component, messageData);
                    })
                    .listen('.message.deleted', (e) => {
                        console.log('🗑️ Evento de exclusão recebido do Pusher:', e);
                        
                        const messageId = e.message_id || e.data?.message_id || e.id;
                        
                        if (!messageId) {
                            console.error('❌ ID da mensagem vazio no evento de exclusão', e);
                            return;
                        }
                        
                        console.log('📤 Removendo mensagem:', messageId);
                        
                        // Obtém o componente
                        const component = getComponent();
                        
                        if (!component) {
                            console.error('❌ Componente Livewire não encontrado!');
                            setTimeout(() => {
                                const retryComponent = getComponent();
                                if (retryComponent) {
                                    removeMessage(retryComponent, messageId);
                                }
                            }, 100);
                            return;
                        }
                        
                        removeMessage(component, messageId);
                    });
                });
            }

            function removeMessage(component, messageId) {
                console.log('🗑️ Tentando remover mensagem...', messageId);
                
                let removed = false;
                
                // Forma 1: Chamar método diretamente via call
                if (component.call) {
                    try {
                        console.log('🗑️ Chamando removeMessage via call()');
                        component.call('removeMessage', { message_id: messageId });
                        removed = true;
                        console.log('✅ Mensagem removida via call()');
                    } catch (err) {
                        console.warn('⚠️ Erro em component.call:', err);
                    }
                }
                
                // Forma 2: component.dispatch
                if (!removed && component.dispatch) {
                    try {
                        console.log('🗑️ Disparando evento messageDeleted');
                        component.dispatch('messageDeleted', { message_id: messageId });
                        removed = true;
                        console.log('✅ Evento messageDeleted disparado');
                    } catch (err) {
                        console.warn('⚠️ Erro em component.dispatch:', err);
                    }
                }
                
                // Forma 3: Livewire.dispatch global
                if (!removed && window.Livewire && window.Livewire.dispatch) {
                    try {
                        console.log('🗑️ Disparando evento global');
                        window.Livewire.dispatch('messageDeleted', { message_id: messageId });
                        removed = true;
                        console.log('✅ Evento global disparado');
                    } catch (err) {
                        console.warn('⚠️ Erro em Livewire.dispatch:', err);
                    }
                }
                
                if (!removed) {
                    console.error('❌ Não foi possível remover a mensagem!');
                }
            }

            function dispatchMessage(component, messageData) {
                console.log('📤 Tentando disparar evento messageReceived...', messageData);
                
                // Tenta múltiplas formas de disparar
                let dispatched = false;
                
                // Forma 1: Chamar método diretamente via call (mais confiável)
                if (component.call) {
                    try {
                        console.log('📤 Tentando chamar addMessage diretamente via call()');
                        component.call('addMessage', { message: messageData });
                        dispatched = true;
                        console.log('✅ Chamada via call() executada');
                    } catch (err) {
                        console.warn('⚠️ Erro em component.call:', err);
                    }
                }
                
                // Forma 2: component.dispatch (Livewire 3)
                if (!dispatched && component.dispatch) {
                    try {
                        console.log('📤 Usando component.dispatch()');
                        component.dispatch('messageReceived', { message: messageData });
                        dispatched = true;
                        console.log('✅ Dispatch via component.dispatch() executado');
                    } catch (err) {
                        console.warn('⚠️ Erro em component.dispatch:', err);
                    }
                }
                
                // Forma 3: component.$dispatch (Livewire 2)
                if (!dispatched && component.$dispatch) {
                    try {
                        console.log('📤 Usando component.$dispatch()');
                        component.$dispatch('messageReceived', { message: messageData });
                        dispatched = true;
                        console.log('✅ Dispatch via component.$dispatch() executado');
                    } catch (err) {
                        console.warn('⚠️ Erro em component.$dispatch:', err);
                    }
                }
                
                // Forma 4: Livewire.dispatch global
                if (!dispatched && window.Livewire && window.Livewire.dispatch) {
                    try {
                        console.log('📤 Usando Livewire.dispatch() global');
                        window.Livewire.dispatch('messageReceived', { message: messageData });
                        dispatched = true;
                        console.log('✅ Dispatch global executado');
                    } catch (err) {
                        console.warn('⚠️ Erro em Livewire.dispatch:', err);
                    }
                }
                
                if (dispatched) {
                    console.log('✅ Evento disparado com sucesso!');
                } else {
                    console.error('❌ Não foi possível disparar o evento! Component:', component);
                }
            }

            // Auto-scroll quando o Livewire atualizar
            if (window.Livewire) {
                window.Livewire.hook('morph.updated', () => {
                    const box = document.getElementById('messages');
                    if (box) {
                        box.scrollTop = box.scrollHeight;
                    }
                });
            }

            // Inicializa quando o Livewire estiver pronto
            function setupChat() {
                // Atualiza a referência do componente
                getComponent();
                initChat();
            }
            
            if (window.Livewire) {
                // Livewire 3 - hook mounted
                window.Livewire.hook('mounted', ({ component }) => {
                    console.log('✅ Livewire montado:', component.id);
                    channelInstance = component;
                    setTimeout(setupChat, 100);
                });
                
                // Fallback para Livewire 2
                document.addEventListener('livewire:load', () => {
                    console.log('✅ Livewire carregado (LW2)');
                    setTimeout(setupChat, 100);
                });
                
                // Se já estiver carregado
                if (window.Livewire.all && window.Livewire.all().length > 0) {
                    console.log('✅ Livewire já carregado');
                    setTimeout(setupChat, 100);
                }
            }

            // Fallback geral
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', () => {
                    setTimeout(setupChat, 500);
                });
            } else {
                setTimeout(setupChat, 500);
            }
        })();
    </script>
    @endpush



</div>