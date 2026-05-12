<!DOCTYPE html>
<html>
<head>
    <title>Chatbot Pneumonia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

    body{
        background:#f5f7fb;
    }

    .chat-box{
        height:500px;
        overflow-y:auto;
        background:white;
        border-radius:15px;
        padding:20px;
        border:1px solid #ddd;
    }

    .user{
        text-align:right;
        margin-bottom:15px;
    }

    .bot{
        text-align:left;
        margin-bottom:15px;
    }

    .bubble-user{
        display:inline-block;
        background:#00BBC2;
        color:white;
        padding:12px 18px;
        border-radius:15px;
        max-width:70%;
    }

    .bubble-bot{
        display:inline-block;
        background:#e9ecef;
        padding:12px 18px;
        border-radius:15px;
        max-width:70%;
        white-space:pre-line;
    }

    </style>
</head>

<body>

<div class="container py-5">

    <h3 class="mb-4 text-center">
        Chatbot Edukasi Pneumonia
    </h3>

    <div class="chat-box mb-3" id="chatBox">

        <div class="bot">
            <div class="bubble-bot">
Halo 👋

Saya chatbot edukasi pneumonia.

Silakan tanyakan mengenai:
• Pencegahan pneumonia
• Batuk
• Demam
• Sesak napas
• Vaksin
• PHBS
• Kesehatan paru
            </div>
        </div>

    </div>

    <div class="input-group">

        <input type="text"
               id="message"
               class="form-control"
               placeholder="Tulis pertanyaan...">

        <button class="btn btn-info text-white"
                onclick="sendMessage()">
            Kirim
        </button>

    </div>

</div>

<script>

function sendMessage(){

    let message = document.getElementById('message').value;

    if(message.trim() == ''){
        return;
    }

    let chatBox = document.getElementById('chatBox');

    chatBox.innerHTML += `
        <div class="user">
            <div class="bubble-user">${message}</div>
        </div>
    `;

    fetch("<?= base_url('/chat-pneumonia/send') ?>",{
        method:'POST',
        headers:{
            'Content-Type':'application/x-www-form-urlencoded'
        },
        body:'message='+encodeURIComponent(message)
    })

    .then(response => response.json())

    .then(data => {

        chatBox.innerHTML += `
            <div class="bot">
                <div class="bubble-bot">${data.reply}</div>
            </div>
        `;

        chatBox.scrollTop = chatBox.scrollHeight;

    });

    document.getElementById('message').value='';

}

</script>

</body>
</html>