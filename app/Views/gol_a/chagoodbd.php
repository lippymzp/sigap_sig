<script>
let currentCsrfToken = "<?= csrf_hash() ?>";
let isChatInitialized = false; 

function toggleChat() {
    var chatWindow = document.getElementById('chatbotWindow');
    if (chatWindow.style.display === 'none' || chatWindow.style.display === '') {
        chatWindow.style.display = 'flex';
        document.getElementById('chatInput').focus();
        
        if (!isChatInitialized) {
            triggerInitialGreeting();
            isChatInitialized = true;
        }
    } else {
        chatWindow.style.display = 'none';
    }
}

function triggerInitialGreeting() {
    var loadingId = 'loading-' + Date.now();
    appendMessage('bot', 'Mengetik...', loadingId);

    var formData = new URLSearchParams();
    formData.append('message', 'halo'); 
    formData.append('<?= csrf_token() ?>', currentCsrfToken); 

    fetch("<?= base_url('chagoo/send') ?>", {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        var loadingEl = document.getElementById(loadingId);
        if (loadingEl) loadingEl.remove();

        if (data.csrf_token) {
            currentCsrfToken = data.csrf_token;
        }

        if (data.reply) {
            appendMessage('bot', data.reply.trim());
            
            if (data.options && data.options.length > 0) {
                renderChatOptions(data.options);
            }
        }
    })
    .catch(error => console.error('Error Init Chat:', error));
}

function handleChatEnter(event) {
    if (event.key === 'Enter') {
        sendMessage();
    }
}

function appendMessage(sender, text, id = null) {
    var chatBody = document.getElementById('chatBody');
    var msgDiv = document.createElement('div');
    msgDiv.className = 'chat-msg ' + (sender === 'user' ? 'msg-user' : 'msg-bot');
    if (id) msgDiv.id = id;
    
    if (sender === 'bot') {
        // Konversi markdown sederhana dari Gemini ke HTML (Tebal & Miring)
        let formattedText = text.replace(/</g, "&lt;").replace(/>/g, "&gt;"); // Mencegah XSS
        formattedText = formattedText.replace(/\*\*(.*?)\*\*/g, "<strong>$1</strong>"); // Bold
        formattedText = formattedText.replace(/\*(.*?)\*/g, "<em>$1</em>"); // Italic
        
        msgDiv.innerHTML = formattedText;
    } else {
        msgDiv.textContent = text;
    }
    
    chatBody.appendChild(msgDiv);
    chatBody.scrollTop = chatBody.scrollHeight; 
}

function sendOptionMessage(text) {
    var input = document.getElementById('chatInput');
    input.value = text; 
    sendMessage();      
}

function renderChatOptions(options) {
    var chatBody = document.getElementById('chatBody');
    var optionsDiv = document.createElement('div');
    optionsDiv.className = 'chat-options-container';
    optionsDiv.style.marginTop = '8px';
    optionsDiv.style.marginBottom = '15px';
    optionsDiv.style.display = 'flex';
    optionsDiv.style.flexWrap = 'wrap';
    optionsDiv.style.gap = '5px';

    options.forEach(function(opt) {
        var btn = document.createElement('button');
        btn.textContent = opt;
        
        btn.style.padding = '5px 12px';
        btn.style.border = '1px solid #007bff';
        btn.style.backgroundColor = '#f8f9fa';
        btn.style.color = '#007bff';
        btn.style.borderRadius = '15px';
        btn.style.fontSize = '13px';
        btn.style.cursor = 'pointer';

        btn.onmouseover = function() {
            this.style.backgroundColor = '#007bff';
            this.style.color = '#fff';
        };
        btn.onmouseout = function() {
            this.style.backgroundColor = '#f8f9fa';
            this.style.color = '#007bff';
        };

        btn.onclick = function() {
            optionsDiv.remove(); 
            sendOptionMessage(opt);
        };

        optionsDiv.appendChild(btn);
    });

    chatBody.appendChild(optionsDiv);
    chatBody.scrollTop = chatBody.scrollHeight;
}

function sendMessage() {
    var input = document.getElementById('chatInput');
    var message = input.value.trim();
    
    if (message === '') return;

    appendMessage('user', message);
    input.value = '';

    var loadingId = 'loading-' + Date.now();
    appendMessage('bot', 'Mengetik...', loadingId);

    var formData = new URLSearchParams();
    formData.append('message', message);
    formData.append('<?= csrf_token() ?>', currentCsrfToken); 

    fetch("<?= base_url('chagoo/send') ?>", {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest' 
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        var loadingEl = document.getElementById(loadingId);
        if (loadingEl) loadingEl.remove();

        if (data.csrf_token) {
            currentCsrfToken = data.csrf_token;
        }

        if (data.reply) {
            appendMessage('bot', data.reply.trim());
            
            if (data.options && data.options.length > 0) {
                renderChatOptions(data.options);
            }

        } else if (data.messages && data.messages.error) {
            appendMessage('bot', 'Akses ditolak: ' + data.messages.error);
        } else if (data.message) {
            appendMessage('bot', 'Sistem error: ' + data.message);
        } else {
            appendMessage('bot', 'Maaf, sistem tidak memberikan respons.');
        }
    })
    .catch(error => {
        var loadingEl = document.getElementById(loadingId);
        if (loadingEl) loadingEl.remove();
        
        appendMessage('bot', 'Gagal terhubung ke server. Periksa koneksi internet Anda.');
    });
}
</script>