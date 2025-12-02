<?php

namespace App\Livewire;

use App\Events\MessageDeleted;
use App\Events\MessageSent;
use App\Models\Channel;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
// use Livewire\Attributes\On; // <-- 1. REMOVA ESTA IMPORTAÇÃO

class ChatRoom extends Component
{
    public Channel $channel;
    public array $messages = [];
    public string $newMessage = '';
    public bool $sending = false;

    // --- 2. ADICIONE A FORMA EXPLÍCITA DE OUVIR ---
    /**
     * Define os "ouvintes" (listeners) do Livewire.
     * Mapeia o evento 'messageReceived' (do JS) para o método 'addMessage' (do PHP).
     */
    protected $listeners = [
        'messageReceived' => 'addMessage',
        'messageDeleted' => 'removeMessage'
    ];
    // --- FIM DA ADIÇÃO ---


    public function mount(Channel $channel): void
    {
        $this->channel = $channel;

        $this->messages = $channel->messages()
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(fn(Message $m) => [
                'id'         => $m->id,
                'body'       => $m->body,
                'user'       => [
                    'id'   => $m->user->id ?? null,
                    'name' => $m->user->name ?? '',
                ],
                'created_at' => optional($m->created_at)->toIsoString(),
            ])
            ->values()
            ->all();
    }

    public function sendMessage(): void
    {
        // Previne múltiplos submits
        if ($this->sending) {
            return;
        }

        try {
            $this->sending = true;
            
            $body = trim($this->newMessage);
            if ($body === '') {
                $this->reset('newMessage');
                $this->sending = false;
                return;
            }

            $msg = Message::create([
                'user_id'    => Auth::id(),
                'channel_id' => $this->channel->id,
                'body'       => $body,
            ])->load('user');

            // adiciona localmente
            $this->messages[] = [
                'id'         => $msg->id,
                'body'       => $msg->body,
                'user'       => ['id' => $msg->user->id ?? null, 'name' => $msg->user->name ?? 'Desconhecido'],
                'created_at' => optional($msg->created_at)->toIsoString(),
            ];

            // envia para os outros clientes
            broadcast(new MessageSent($msg))->toOthers();

            $this->reset('newMessage');
            $this->sending = false;
            
            Log::info('✅ Mensagem enviada com sucesso', [
                'message_id' => $msg->id,
                'channel_id' => $this->channel->id,
                'user_id' => Auth::id()
            ]);
        } catch (\Exception $e) {
            $this->sending = false;
            
            Log::error('❌ Erro ao enviar mensagem', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Não relança a exceção para evitar reload
            $this->dispatch('error', message: 'Erro ao enviar mensagem. Tente novamente.');
        }
    }

    // 3. REMOVA O ATRIBUTO #[On(...)] DESTA LINHA
    public function addMessage($payload = null): void
    {
        Log::info('📥 addMessage chamado', ['payload' => $payload, 'type' => gettype($payload)]);
        
        // Aceita múltiplos formatos:
        // 1. { message: {...} }
        // 2. {...} (a própria mensagem)
        // 3. Array direto
        
        $m = null;
        
        if (is_array($payload)) {
            if (array_key_exists('message', $payload)) {
                $m = $payload['message'];
            } else {
                $m = $payload;
            }
        } elseif (is_object($payload)) {
            // Converte objeto para array
            $payloadArray = json_decode(json_encode($payload), true);
            if (is_array($payloadArray)) {
                if (array_key_exists('message', $payloadArray)) {
                    $m = $payloadArray['message'];
                } else {
                    $m = $payloadArray;
                }
            }
        }

        if (!$m || !is_array($m)) {
            Log::warning('⚠️ addMessage: payload vazio ou inválido', [
                'payload' => $payload,
                'm' => $m,
                'type' => gettype($m)
            ]);
            return;
        }

        // Verifica se a mensagem já existe (evita duplicatas)
        $messageId = $m['id'] ?? null;
        if ($messageId) {
            $exists = collect($this->messages)->contains('id', $messageId);
            if ($exists) {
                Log::info('⚠️ Mensagem já existe, ignorando', ['id' => $messageId]);
                return;
            }
        }

        // Normaliza a data
        $createdAt = $m['created_at'] ?? now();
        if (is_string($createdAt)) {
            try {
                $createdAt = \Carbon\Carbon::parse($createdAt)->toIsoString();
            } catch (\Exception $e) {
                $createdAt = now()->toIsoString();
            }
        } elseif ($createdAt instanceof \DateTime) {
            $createdAt = \Carbon\Carbon::instance($createdAt)->toIsoString();
        } else {
            $createdAt = now()->toIsoString();
        }

        $newMessage = [
            'id'   => $m['id']   ?? null,
            'body' => $m['body'] ?? '',
            'user' => [
                'id'   => data_get($m, 'user.id'),
                'name' => data_get($m, 'user.name') ?? 'Desconhecido',
            ],
            'created_at' => $createdAt,
        ];

        $this->messages[] = $newMessage;
        
        Log::info('✅ Mensagem adicionada ao array', [
            'id' => $newMessage['id'],
            'body' => $newMessage['body'],
            'user' => $newMessage['user']['name'],
            'total_messages' => count($this->messages)
        ]);
        
        // O Livewire atualiza automaticamente quando $messages é modificado
    }

    public function deleteMessage(int $messageId): void
    {
        $message = Message::find($messageId);
        
        if (!$message) {
            return;
        }

        // Verifica se o usuário pode excluir (apenas suas próprias mensagens)
        if ($message->user_id !== Auth::id()) {
            Log::warning('⚠️ Tentativa de excluir mensagem de outro usuário', [
                'message_id' => $messageId,
                'user_id' => Auth::id(),
                'message_user_id' => $message->user_id
            ]);
            return;
        }

        // Remove do array local
        $this->messages = array_values(array_filter($this->messages, function($msg) use ($messageId) {
            return ($msg['id'] ?? null) !== $messageId;
        }));

        // Exclui do banco de dados
        $message->delete();

        // Notifica outros clientes
        broadcast(new MessageDeleted($messageId, $this->channel->id));

        Log::info('✅ Mensagem excluída', ['message_id' => $messageId]);
    }

    public function removeMessage($payload): void
    {
        $messageId = is_array($payload) 
            ? ($payload['message_id'] ?? $payload['id'] ?? null)
            : $payload;

        if (!$messageId) {
            return;
        }

        // Remove do array local
        $this->messages = array_values(array_filter($this->messages, function($msg) use ($messageId) {
            return ($msg['id'] ?? null) !== $messageId;
        }));

        Log::info('✅ Mensagem removida do array', ['message_id' => $messageId]);
    }

    public function clearAllMessages(): void
    {
        // Exclui todas as mensagens do canal
        Message::where('channel_id', $this->channel->id)->delete();

        // Limpa o array local
        $this->messages = [];

        Log::info('✅ Todas as mensagens do canal foram excluídas', ['channel_id' => $this->channel->id]);
    }

    public function render()
    {
        return view('livewire.chat-room');
    }
}