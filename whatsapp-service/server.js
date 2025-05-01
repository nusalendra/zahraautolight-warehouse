const express = require('express');
const { Client } = require('whatsapp-web.js');
const bodyParser = require('body-parser');
const qrcode = require('qrcode-terminal');

const app = express();
app.use(bodyParser.json());

const client = new Client();

// When the client is ready
client.once('ready', () => {
  console.log('Client is ready!');
});

// When the client receives a QR code
client.on('qr', qr => {
  qrcode.generate(qr, { small: true });
});

// Endpoint untuk mengirim pesan
app.post('/send-message', (req, res) => {
  const { phone, message } = req.body;
  const number = phone;

  client
    .sendMessage(number, message)
    .then(response => {
      res.json({ success: true, message: 'Message sent', data: response });
    })
    .catch(error => {
      console.error('Error sending message:', error);
      res.status(500).json({ success: false, error: error.toString() });
    });
});

app.get('/groups', async (req, res) => {
  const chats = await client.getChats();
  const groups = chats.filter(chat => chat.isGroup);

  const result = groups.map(group => ({
    name: group.name,
    id: group.id._serialized
  }));

  res.json(result);
});

client.initialize();

app.listen(3000, () => {
  console.log('Server running on http://localhost:3000');
});
