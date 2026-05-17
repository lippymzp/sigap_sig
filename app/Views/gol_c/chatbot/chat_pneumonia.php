<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Chatbot Pneumonia</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #e5ddd5;
        height: 100vh;
        overflow: hidden;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
    }

    /* BACKGROUND TOP */
    .top-bar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 130px;
        background: linear-gradient(135deg, #0B5B61, #14919B);
        ;
        z-index: -1;
    }

    /* MAIN */
    .chat-wrapper {
        width: 95%;
        height: 95vh;
        margin: 20px auto;
        background: white;
        display: flex;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.15);
    }

    /* SIDEBAR */
    .sidebar {
        width: 30%;
        background: #F0F7F7;
        border-right: 1px solid #ddd;
        display: flex;
        flex-direction: column;
    }

    .sidebar-header {
        background: linear-gradient(250deg, #0B5B61, #146C72);
        color: white;
        padding: 25px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);

        border-bottom: 1px solid rgba(255, 255, 255, 0.08);

        position: relative;
        z-index: 2;
    }

    .sidebar-header img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid white;
    }

    .sidebar-header h4 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
        font-weight: 600;
        color: white;
    }

    .sidebar-header p {
        margin: 0;
        font-size: 13px;
        opacity: 0.9;
    }

    .menu-section {
        padding: 14px 20px 20px;
        margin-top: -5px;
    }

    .menu-title {
        font-size: 13px;
        color: #6B7A7A;
        margin-bottom: 12px;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .quick-btn {
        width: 100%;
        border: 1px solid #dfeeee;
        ;
        background: white;
        padding: 14px;
        border-radius: 12px;
        text-align: left;
        margin-bottom: 12px;
        cursor: pointer;
        transition: 0.3s;
        font-size: 14px;
        font-weight: 500;
    }

    .quick-btn:hover {
        background: #14919B;
        color: white;
        transform: translateX(5px);
    }

    /* CHAT AREA */
    .chat-area {
        width: 70%;
        display: flex;
        flex-direction: column;
        background: #F5F7F8;
        position: relative;
    }

    /* HEADER */
    .chat-header {
        background: #F7FBFB;
        padding: 7px 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #ddd;
    }

    .chat-user {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .chat-user img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }

    .chat-user h5 {
        margin: 0;
        font-size: 17px;
        font-weight: 600;
    }

    .chat-user p {
        color: #8FA3A5;
        font-size: 13px;
        font-weight: 400;
    }

    .header-icons {
        display: flex;
        gap: 20px;
        color: #666;
        font-size: 20px;
        cursor: pointer;
    }

    /* CHAT BODY */
    .chat-body {
        flex: 1;
        overflow-y: auto;
        padding: 30px;
        scroll-behavior: smooth;

        background-image: url('https://www.transparenttextures.com/patterns/cubes.png');
    }

    /* MESSAGE */
    .message {
        max-width: 75%;
        width: fit-content;
        padding: 14px 18px;
        border-radius: 15px;
        margin-bottom: 20px;
        position: relative;
        animation: fadeIn 0.3s ease;
        line-height: 1.7;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;

    }

    /* BOT */
    .bot {
        background: #146C72;
        color: white;
        border-radius: 20px 20px 20px 5px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    /* USER */
    .user {
        background: #1BAFBF;
        color: white;
        margin-left: auto;
        border-radius: 20px 20px 5px 20px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    /* TIME */
    .message-time {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.7);
        margin-top: 8px;
        text-align: right;
        font-weight: 400;
    }

    /* INPUT */
    .chat-input {
        background: #ffffff;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .chat-input input {
        flex: 1;
        border: border:1px solid #dfeeee;
        ;
        outline: none;
        padding: 16px 22px;
        border-radius: 30px;
        font-size: 14px;
        background: white;
        color: #444;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .send-btn {
        width: 60px;
        height: 60px;
        border: none;
        border-radius: 50%;
        background: #14919B;
        color: white;
        font-size: 22px;
        transition: 0.3s;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    .send-btn:hover {
        transform: scale(1.08);
        background: #0fb4c7;
    }

    /* TYPING */
    .typing {
        display: flex;
        gap: 5px;
        padding: 10px 15px;
        background: white;
        width: fit-content;
        border-radius: 15px;
        margin-bottom: 20px;
    }

    .typing span {
        width: 10px;
        height: 10px;
        background: #999;
        border-radius: 50%;
        animation: bounce 1.2s infinite;
    }

    .typing span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing span:nth-child(3) {
        animation-delay: 0.4s;
    }
    .chatbot-avatar{

    width:55px;

    height:55px;

    object-fit:contain;

    animation:floatBot 3s ease-in-out infinite;

}

    /* ANIMATION */
    @keyframes bounce {

        0%,
        80%,
        100% {
            transform: scale(0);
        }

        40% {
            transform: scale(1);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* RESPONSIVE */
    @media(max-width:900px) {

        .sidebar {
            display: none;
        }

        .chat-area {
            width: 100%;
        }

        .chat-wrapper {
            width: 100%;
            height: 100vh;
            margin: 0;
            border-radius: 0;
        }
    }

    /* TOAST */
    #toast {

        position: fixed;
        top: 90px;
        right: 30px;
        background: #0F6C73;
        color: white;
        padding: 15px 22px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        font-size: 14px;
        font-weight: 500;
        z-index: 99999;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: 0.3s ease;

    }

    /* SHOW TOAST */
    #toast.show {

        opacity: 1;
        visibility: visible;

        transform: translateY(0);

    }
    </style>
</head>

<body>

    <div class="top-bar"></div>

    <div class="chat-wrapper">

        <!-- SIDEBAR -->
        <div class="sidebar">

            <div class="sidebar-header">

                 <img src="<?= base_url('img/Maskot_CYRO.png') ?>" alt="CYRO" class="chatbot-avatar">

                <div>
                    <h4>CYBOT</h4>
                    <p>Chatbot Edukasi Pneumonia</p>
                </div>

            </div>

            <div class="menu-section">

                <div class="menu-title">
                    Pertanyaan Cepat
                </div>

                <button class="quick-btn" onclick="quickAsk('Apa itu pneumonia?')">
                    Apa itu pneumonia?
                </button>

                <button class="quick-btn" onclick="quickAsk('Apa gejala pneumonia?')">
                    🤒 Gejala pneumonia
                </button>

                <button class="quick-btn" onclick="quickAsk('Bagaimana pencegahan pneumonia?')">
                    💉 Pencegahan pneumonia
                </button>

                <button class="quick-btn" onclick="quickAsk('Apa yang harus dilakukan saat sesak napas?')">
                    😮‍💨 Sesak napas
                </button>

                <button class="quick-btn" onclick="quickAsk('Apa manfaat vaksin?')">
                    💊 Vaksin
                </button>
                <button class="quick-btn" onclick="quickAsk('Tentang Cybot')">

                    🤖 Tentang Cybot

                </button>

            </div>

        </div>

        <!-- CHAT AREA -->
        <div class="chat-area">

            <!-- HEADER -->
            <div class="chat-header">

                <div class="chat-user">

                    <img src="<?= base_url('img/Maskot_CYRO.png') ?>" alt="CYRO" class="chatbot-avatar">

                    <div>

                        <h5><br>CYBOT</h5>
                        <p>● Online</p>
                    </div>

                </div>

                <div class="header-icons">
                    <i class="fa-solid fa-phone" onclick="comingSoon('Panggilan suara')"></i>
                    <i class="fa-solid fa-video" onclick="comingSoon('Video call')"></i>
                    <i class="fa-solid fa-ellipsis-vertical" onclick="comingSoon('Pengaturan chatbot')"></i>
                </div>

            </div>

            <!-- CHAT BODY -->
            <div class="chat-body" id="chatBody">

                <!-- BOT -->
                <div class="message bot">

                    Halo 👋<br><br>

                    Saya chatbot edukasi pneumonia.<br><br>

                    Silakan tanyakan mengenai:
                    <br><br>

                    • Pneumonia<br>
                    • Batuk<br>
                    • Demam<br>
                    • Sesak napas<br>
                    • Vaksin<br>
                    • PHBS<br>
                    • Kesehatan paru

                    <div class="message-time">
                        <?= date('H:i') ?>
                    </div>

                </div>

            </div>

            <!-- INPUT -->
            <div class="chat-input">

                <input type="text" id="message" placeholder="Tulis pesan...">

                <button class="send-btn" onclick="sendMessage()">

                    <i class="fa-solid fa-paper-plane"></i>

                </button>

            </div>

        </div>

    </div>

    <script>
    // ENTER KEY
    document.getElementById('message')
        .addEventListener('keypress', function(e) {

            if (e.key === 'Enter') {
                sendMessage();
            }

        });

    // TIME
    function getTime() {

        let now = new Date();

        let h = now.getHours().toString().padStart(2, '0');
        let m = now.getMinutes().toString().padStart(2, '0');

        return `${h}:${m}`;

    }

    // QUICK ASK
    function quickAsk(text) {

        document.getElementById('message').value = text;
        sendMessage();

    }

    // SCROLL
    function scrollBottom() {

        let chatBody = document.getElementById('chatBody');

        chatBody.scrollTo({
            top: chatBody.scrollHeight,
            behavior: 'smooth'
        });

    }

    // SEND MESSAGE
    function sendMessage() {

        let messageInput = document.getElementById('message');

        let message = messageInput.value.trim();

        if (message === '') {
            return;
        }

        let chatBody = document.getElementById('chatBody');

        // USER MESSAGE
        chatBody.innerHTML += `
            <div class="message user">

                ${message}

                <div class="message-time">
                    ${getTime()}
                </div>

            </div>
        `;

        scrollBottom();

        // CLEAR
        messageInput.value = '';

        // TYPING
        chatBody.innerHTML += `
            <div class="typing" id="typing">

                <span></span>
                <span></span>
                <span></span>

            </div>
        `;

        scrollBottom();

        // FETCH
        fetch("<?= base_url('chat-pneumonia/send') ?>", {

                method: 'POST',

                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },

                body: 'message=' + encodeURIComponent(message)

            })

            .then(response => response.json())

            .then(data => {

                // REMOVE TYPING
                document.getElementById('typing').remove();

                // BOT REPLY
                chatBody.innerHTML += `
                <div class="message bot">

                    ${data.reply.replace(/\n/g,'<br>')}

                    <div class="message-time">
                        ${getTime()}
                    </div>

                </div>
            `;

                scrollBottom();

            });
    }

    function comingSoon(feature) {

        let toast = document.getElementById('toast');

        // UBAH ISI TOAST
        toast.innerHTML = feature + " belum tersedia 😊";

        // MUNCULKAN TOAST
        toast.classList.add('show');

        // HILANGKAN SETELAH 2.5 DETIK
        setTimeout(() => {

            toast.classList.remove('show');

        }, 2500);

    }
    </script>
    <div id="toast">

        Fitur belum tersedia 😊

    </div>

</body>

</html>