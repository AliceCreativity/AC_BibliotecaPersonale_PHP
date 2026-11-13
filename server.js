require('dotenv').config();
const express = require('express');
const cors = require('cors');
const path = require('path');

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware di sicurezza e parsing
app.use(cors());
app.use(express.json());

// Servire file statici (index.html, style.css, main.js, cartella image)
app.use(express.static(__dirname));

// Health check endpoint
app.get('/api/health', (req, res) => {
    res.json({
        status: 'ok',
        openRouterConfigured: Boolean(process.env.OPENROUTER_API_KEY && process.env.OPENROUTER_API_KEY.trim())
    });
});

// Endpoint di chat con OpenRouter
app.post('/api/chat', async (req, res) => {
    try {
        const { message, history } = req.body;

        if (!message || typeof message !== 'string') {
            return res.status(400).json({ error: 'Il campo "message" è obbligatorio.' });
        }

        const apiKey = process.env.OPENROUTER_API_KEY;

        // Se l'API Key non è ancora configurata nel file .env
        if (!apiKey || apiKey.trim() === '' || apiKey === 'your_openrouter_api_key_here') {
            return res.json({
                reply: "⚠️ API Key OpenRouter non trovata nel file .env. Incolla la tua chiave in `OPENROUTER_API_KEY` dentro il file `.env` e riavvia il server per abilitare le risposte AI reali!",
                simulated: true
            });
        }

        // Costruzione dei messaggi per OpenRouter
        const systemPrompt = {
            role: 'system',
            content: "Sei la Bibliotecaria, l'assistente virtuale ufficiale di questo archivio di libri. " +
                     "Il tuo obiettivo è aiutare i visitatori a trovare testi adatti ai loro gusti e rispondere a domande sulla biblioteca.\n\n" +
                     "REGOLE DI COMPORTAMENTO:\n" +
                     "- Tono e stile: Rispondi sempre in italiano. Sii cordiale, accogliente, chiara e concisa. Evita risposte troppo lunghe o dispersive.\n" +
                     "- Raccomandazioni: Suggerisci libri (narrativa, saggistica, biografie, manuali) chiedendo, se necessario, i gusti del lettore per affinare la ricerca.\n" +
                     "- Fedeltà all'archivio: Basa le tue risposte esclusivamente sui libri e sulle informazioni presenti nel contesto fornito dall'archivio. Non inventare mai titoli, autori, trame o disponibilità.\n" +
                     "- Gestione dell'incertezza: Se un libro non è presente in archivio, se non hai abbastanza informazioni o se la domanda non riguarda i libri e la biblioteca, rispondi esattamente con questa frase: 'Mi dispiace, non sono sicura di come rispondere a questa domanda. Posso aiutarti a trovare un libro?'\n\n" +
                     "FORMATTAZIONE:\n" +
                     "- Quando elenchi più libri, usa un elenco puntato indicando **Titolo** e *Autore*, seguito da una breve frase descrittiva."
        };

        const formattedMessages = [systemPrompt];

        // Se è presente la cronologia dei messaggi precedenti
        if (Array.isArray(history)) {
            history.forEach(item => {
                if (item && item.text) {
                    formattedMessages.push({
                        role: item.sender === 'user' ? 'user' : 'assistant',
                        content: item.text
                    });
                }
            });
        }

        // Aggiungi il messaggio corrente dell'utente
        formattedMessages.push({
            role: 'user',
            content: message
        });

        const model = process.env.OPENROUTER_MODEL;

        // Chiamata all'API di OpenRouter
        const openRouterResponse = await fetch('https://openrouter.ai/api/v1/chat/completions', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${apiKey.trim()}`,
                'Content-Type': 'application/json',
                'HTTP-Referer': `http://localhost:${PORT}`,
                'X-Title': 'Biblioteca Personale - Archivio di Libri',
            },
            body: JSON.stringify({
                model: model,
                messages: formattedMessages
            })
        });

        if (!openRouterResponse.ok) {
            const errorData = await openRouterResponse.json().catch(() => null);
            const providerMessage = errorData?.error?.message;

            if (openRouterResponse.status === 429) {
                console.error('OpenRouter ha limitato temporaneamente la richiesta (HTTP 429).');
                return res.status(503).json({
                    error: 'Il modello è temporaneamente sovraccarico. Riprova tra poco oppure scegli un altro modello in OPENROUTER_MODEL.'
                });
            }

            console.error('Errore risposta OpenRouter:', openRouterResponse.status, providerMessage || 'dettaglio non disponibile');
            return res.status(openRouterResponse.status).json({
                error: 'Errore durante la comunicazione con OpenRouter.',
            });
        }

        const data = await openRouterResponse.json();
        const reply = data.choices?.[0]?.message?.content;

        if (typeof reply !== 'string' || reply.trim() === '') {
            console.error('OpenRouter ha restituito reasoning ma nessun contenuto di risposta.');
            return res.status(502).json({
                error: 'Il modello non ha prodotto una risposta finale. Scegli un altro modello in OPENROUTER_MODEL.'
            });
        }

        res.json({ reply: reply.trim() });
    } catch (error) {
        console.error('Errore nel server /api/chat:', error);
        res.status(500).json({ error: 'Errore interno del server.', message: error.message });
    }
});

// Avvio del server
app.listen(PORT, () => {
    console.log(`📚 Server Biblioteca Personale avviato su http://localhost:${PORT}`);
    console.log(`⚡ Watch mode attivo con Express, dotenv e CORS`);
});