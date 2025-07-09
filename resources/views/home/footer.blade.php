<section class="info_section">
    <img src="{{asset('/images/footer.png')}}" alt="">
</section>

<!-- Chat icon -->
<div id="chat-bot-icon" onclick="toggleChatBot()" style="position:fixed;bottom:24px;right:24px;z-index:9999;cursor:pointer;width:60px;height:60px;background:var(--primary-color);display:flex;align-items:center;justify-content:center;border-radius:50%;box-shadow:0 2px 8px rgba(0,0,0,0.15);">
    <i class="fa fa-comments" style="color:#fff;font-size:28px;"></i>
</div>

<!-- Chat box -->
<div id="chat-bot-container" style="display:none;position:fixed;bottom:24px;right:24px;width:340px;max-width:95vw;z-index:9999;font-family:Arial,sans-serif;">
    <div style="background:#fff;border:1px solid #ddd;border-radius:12px;box-shadow:0 4px 24px rgba(0,0,0,0.08);overflow:hidden;display:flex;flex-direction:column;height:420px;">
        <div style="color:#fff;background:var(--primary-color);padding:12px 16px;display:flex;align-items:center;justify-content:space-between;">
            <span><i class="fa fa-robot me-2"></i> Hỗ trợ tư vấn</span>
            <button onclick="toggleChatBot()" style="background:transparent;border:none;outline:none;color:#fff;font-size:20px;line-height:1;cursor:pointer;">&times;</button>
        </div>
        <div id="chat-box" style="flex:1;padding:16px 10px;overflow-y:auto;display:flex;flex-direction:column;gap:8px;font-size:15px;"></div>
        <div id="chat-input-area" style="">
            <input type="text" id="chat-input" placeholder="Nhập nội dung..." autocomplete="off">
            <button id="chat-send-btn" onclick="sendChat()">Gửi</button>
        </div>
    </div>
</div>

<script>
function toggleChatBot() {
    const icon = document.getElementById('chat-bot-icon');
    const container = document.getElementById('chat-bot-container');
    if (container.style.display === 'none' || container.style.display === '') {
        container.style.display = 'block';
        icon.style.display = 'none';
        setTimeout(() => {
            document.getElementById('chat-input').focus();
        }, 200);
    } else {
        container.style.display = 'none';
        icon.style.display = 'flex';
    }
}

function sendChat() {
    let prompt = document.getElementById('chat-input').value;
    if (!prompt.trim()) return;
    document.getElementById('chat-box').innerHTML +=
        '<div class="message user"><div class="bubble">' + prompt + '</div></div>';
    document.getElementById('chat-input').value = '';
    fetch('/chat-gemini', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: JSON.stringify({prompt})
    })
    .then(res => res.json())
    .then(data => {
        if (data.error) {
            document.getElementById('chat-box').innerHTML +=
                '<div class="message bot"><div class="bubble text-danger">Lỗi: ' + data.error.message + '</div></div>';
            return;
        }
        let text = data.candidates?.[0]?.content?.parts?.[0]?.text || 'Không có phản hồi';
        document.getElementById('chat-box').innerHTML +=
            '<div class="message bot"><div class="bubble">' + text + '</div></div>';
        document.getElementById('chat-box').scrollTop = document.getElementById('chat-box').scrollHeight;
    });
}

// Gửi bằng phím Enter
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('chat-input').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendChat();
        }
    });
});
</script>