const botAvatar = 'img/chatbot_red.png';
const userAvatar = 'img/chatuser_red.png';
const chatStartedAt = Date.now();
const messages = [
    { avatar: botAvatar, text: 'Ciao, sono la Bibliotecaria. Come posso aiutarti?', timestamp: 0 }
];

const messagesContainer = document.querySelector('[data-purpose="chat-messages"]');
const messageForm = document.querySelector('[data-purpose="send-message-form"]');
const messageInput = messageForm.querySelector('input');
const sendButton = messageForm.querySelector('button');

function formatTimestamp(seconds) {
    const minutes = Math.floor(seconds / 60).toString().padStart(2, '0');
    const remainingSeconds = (seconds % 60).toString().padStart(2, '0');
    return `${minutes}:${remainingSeconds}`;
}

function renderMessages() {
    messagesContainer.replaceChildren();

    messages.forEach((message) => {
        const isUser = message.avatar === userAvatar;
        const row = document.createElement('div');
        row.className = isUser
            ? 'd-flex align-items-end justify-content-end gap-3 ms-auto'
            : 'd-flex align-items-end gap-3';
        row.dataset.purpose = isUser ? 'user-message' : 'bot-message';
        row.style.maxWidth = '85%';

        const avatar = document.createElement('div');
        avatar.className = 'bg-light rounded-circle shadow-sm d-flex align-items-center justify-content-center p-1 flex-shrink-0';
        avatar.style.width = '40px';
        avatar.style.height = '40px';

        const image = document.createElement('img');
        image.src = message.avatar;
        image.alt = isUser ? 'User Avatar' : 'Bot Avatar';
        image.className = 'w-100 h-100 object-fit-contain';
        avatar.append(image);

        const bubble = document.createElement('div');
        bubble.className = isUser
            ? 'bg-body-color text-white rounded-4 px-3 py-2 shadow-sm'
            : 'bg-surface text-secondary border border-light-subtle rounded-4 px-3 py-2 shadow-sm';

        const text = document.createElement('div');
        text.textContent = message.text;

        const timestamp = document.createElement('time');
        timestamp.className = 'd-block small text-end opacity-75';
        timestamp.textContent = formatTimestamp(message.timestamp);
        timestamp.dateTime = `PT${message.timestamp}S`;

        bubble.append(text, timestamp);
        row.append(...(isUser ? [bubble, avatar] : [avatar, bubble]));
        messagesContainer.append(row);
    });

    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

messageForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    const text = messageInput.value.trim();

    if (!text || sendButton.disabled) {
        return;
    }

    const history = messages.map((message) => ({
        sender: message.avatar === userAvatar ? 'user' : 'assistant',
        text: message.text
    }));

    messages.push({
        avatar: userAvatar,
        text,
        timestamp: Math.floor((Date.now() - chatStartedAt) / 1000)
    });
    messageInput.value = '';
    renderMessages();
    sendButton.disabled = true;

    try {
        const response = await fetch(messageForm.dataset.apiUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                message: text,
                history
            })
        });
        const result = await response.json();

        if (!response.ok) {
            throw new Error(result.error || 'Errore nella richiesta alla chat.');
        }

        messages.push({
            avatar: botAvatar,
            text: result.reply,
            timestamp: Math.floor((Date.now() - chatStartedAt) / 1000)
        });
    } catch (error) {
        console.error('Errore durante l’invio del messaggio:', error);
        messages.push({
            avatar: botAvatar,
            text: error.message || 'Non è stato possibile contattare la chat. Riprova più tardi.',
            timestamp: Math.floor((Date.now() - chatStartedAt) / 1000)
        });
    } finally {
        sendButton.disabled = false;
        renderMessages();
    }
});

renderMessages();
