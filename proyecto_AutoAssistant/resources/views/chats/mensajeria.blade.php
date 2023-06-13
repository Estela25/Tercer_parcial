<style>
    .message-sent {
  justify-content: flex-end;
}

.message-received {
  justify-content: flex-start;
}

</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mensajería') }}
        </h2>
    </x-slot>
    <br>
    <div class="container py-2">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-6">
                <div class="card" style="height: 600px;">
                    <div class="card-header d-flex justify-content-between align-items-center p-3"
                        style="border-top: 4px solid #ffa900;">
                        <h5 class="mb-0">Chat messages</h5>
                        <div class="d-flex flex-row align-items-center">
                            <span class="badge bg-warning me-3">20</span>
                            <i class="fas fa-minus me-3 text-muted fa-xs"></i>
                            <i class="fas fa-comments me-3 text-muted fa-xs"></i>
                            <i class="fas fa-times text-muted fa-xs"></i>
                        </div>
                    </div>
                    <div class="card-body" data-mdb-perfect-scrollbar="true" id="chat-messages-container" data-contratacion-id="{{ $contratacionId }}"  data-user-id="{{ Auth::user()->id }}"
                        data-user-name="{{ Auth::user()->name }}"
                        style="position: relative; height: 400px; overflow-y: auto;">
                    </div>
                    <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
                        <div class="input-group mb-0">
                            <form id="chat-form">
                                <input type="text" id="message-input" class="form-control" placeholder="Escribe tu mensaje"
                                    aria-label="Recipient's username" aria-describedby="button-addon2" />
                                <button class="btn btn-warning" type="submit" id="button-addon2"
                                    style="padding-top: .55rem;">
                                    Enviar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
  // Conectarse al servidor de Socket.io
  const socket = io('http://localhost:3001');

  // Obtener el ID del conductor y mecánico desde el backend
  const conductorId = '{{ $conductorId }}';
  const mecanicoId = '{{ $mecanicoId }}';
  const userName = '{{ $userName }}';

  console.log('conductorId:', conductorId);
  console.log('mecanicoId:', mecanicoId);
  console.log('username', userName);

  // Unirse a una sala de chat basada en los IDs del conductor y mecánico
  const contratacionId = document.getElementById('chat-messages-container').getAttribute('data-contratacion-id');
  const room = 'contratacion_' + contratacionId;
  
  console.log('contratacionId:', contratacionId);
  //limpia el contenedor de mensajes
  const chatMessagesContainer = document.getElementById('chat-messages-container');
  chatMessagesContainer.innerHTML = '';
  
  //const userId = chatMessagesContainer.getAttribute('data-user-id');
  //const userName = chatMessagesContainer.getAttribute('data-user-name');

  //unirse a una sala nueva
  socket.emit('joinRoom', room);
  
  
    //console.log('userId:', userId);

  // Escuchar eventos de chat para recibir mensajes del servidor
  socket.on('chat', (message) => {
    // Verificar si el mensaje es para el usuario actual
    const userId = '{{ Auth::user()->id }}';
    const room = 'contratacion_' + contratacionId;

    // Determinar el remitente y el destinatario
    let sender = '';
    let recipient = '';
    let rolSender = '';
    /*
    if (userId === conductorId) {
        // El usuario actual es el conductor
        sender = userName;
        recipient = mecanicoId;
        rolSender = 'conductor';
    } else if (userId === mecanicoId) {
        // El usuario actual es el mecánico
        sender = userName;
        recipient = conductorId;
        rolSender = 'mecanico';
    }
    console.log('Sender:', sender);
  console.log('Recipient:', recipient);
  console.log('Message:', message);*/
   
    if  (message.sala === room) {
      // Mostrar el mensaje en el chat
   

      const messageContainer = document.createElement('div');
      messageContainer.classList.add('d-flex', 'justify-content-between');

      const senderElement = document.createElement('p');
      senderElement.classList.add('small', 'mb-1');
      senderElement.innerText  = message.senderName;


      const timestampElement = document.createElement('p');
      timestampElement.classList.add('small', 'mb-1', 'text-muted');
      timestampElement.innerText = message.timestamp;

      const avatarElement = document.createElement('img');
      avatarElement.src = 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5-bg.webp';
      avatarElement.alt = 'avatar';
      avatarElement.style.width = '45px';
      avatarElement.style.height = '100%';

      const messageTextElement = document.createElement('div');
      messageTextElement.classList.add('d-flex', 'flex-row', 'justify-content-start');

      const messageContentElement = document.createElement('div');
      messageContentElement.classList.add('p-2', 'ms-3', 'mb-3', 'rounded-3');
      messageContentElement.style.backgroundColor = '#f5f6f7';
      messageContentElement.innerText = message.message;

      messageTextElement.appendChild(avatarElement);
      messageTextElement.appendChild(messageContentElement);

      messageContainer.appendChild(senderElement);
      messageContainer.appendChild(timestampElement);
      messageContainer.appendChild(messageTextElement);

      // Agregar clase CSS adicional según el remitente
      if (message.sender === '{{ Auth::user()->name }}') {
        messageContainer.classList.add('message-sent');
      } else {
        messageContainer.classList.add('message-received');
      }

      chatMessagesContainer.appendChild(messageContainer);

      // Aquí puedes acceder a los campos adicionales y mostrar la información correspondiente
      const sender = message.sender;
      const timestamp = message.timestamp;
      const read = message.read;
      // ...
    }
  });

  // Obtener el historial de chat al cargar la página
  socket.emit('historial', room);

  socket.on('historial', (chats) => {

    // Lógica para procesar y mostrar el historial de chat en la interfaz de usuario
    const chatMessagesContainer = document.getElementById('chat-messages-container');
    chatMessagesContainer.innerHTML = ''; // Borra el contenido anterior

    chats.forEach((chat) => {
      // Verificar si el mensaje es para el usuario actual
      const userId = '{{ Auth::user()->id }}';
      //const userId = document.getElementById('chat-messages-container').getAttribute('data-user-id');

      if (chat.sala === room) {
        const messageContainer = document.createElement('div');
        messageContainer.classList.add('d-flex', 'justify-content-between');

        const senderElement = document.createElement('p');
        senderElement.classList.add('small', 'mb-1');
        senderElement.innerText = chat.sender;

        const timestampElement = document.createElement('p');
        timestampElement.classList.add('small', 'mb-1', 'text-muted');
        timestampElement.innerText = chat.timestamp;

        const avatarElement = document.createElement('img');
        avatarElement.src = 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5-bg.webp';
        avatarElement.alt = 'avatar';
        avatarElement.style.width = '45px';
        avatarElement.style.height = '100%';

        const messageTextElement = document.createElement('div');
        messageTextElement.classList.add('d-flex', 'flex-row', 'justify-content-start');

        const messageContentElement = document.createElement('div');
        messageContentElement.classList.add('p-2', 'ms-3', 'mb-3', 'rounded-3');
        messageContentElement.style.backgroundColor = '#f5f6f7';
        messageContentElement.innerText = chat.message;

        messageTextElement.appendChild(avatarElement);
        messageTextElement.appendChild(messageContentElement);

        messageContainer.appendChild(senderElement);
        messageContainer.appendChild(timestampElement);
        messageContainer.appendChild(messageTextElement);

        // Determinar la dirección según el rol del remitente
        if (chat.rolSender === 'conductor') {
            // El remitente es el conductor, mostrar a la derecha
            messageContainer.classList.add('message-sent');
        } else if (chat.rolSender === 'mecanico') {
            // El remitente es el mecánico, mostrar a la izquierda
            messageContainer.classList.add('message-received');
        }
        
        chatMessagesContainer.appendChild(messageContainer);
      }
    });
  });

  // Manejar el envío de mensajes desde el formulario
  const chatForm = document.getElementById('chat-form');
  const messageInput = document.getElementById('message-input');
  const userId = '{{ Auth::user()->id }}'; // ID del usuario actual obtenido desde el backend
  const senderN = '{{ Auth::user()->name }}'; // Nombre del remitente obtenido desde el backend
  const timestamp = new Date().toISOString(); // Fecha actual en formato ISO
  const read = false; // Estado de lectura inicialmente establecido en false

  chatForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const message = messageInput.value.trim();

    if (message !== '') {
        // Determinar el remitente y el destinatario
        //let sender = '';
        let recipient = '';
        let senderName = '';
        let rolSender = '';

        if (userId === conductorId) {
            // El usuario actual es el conductor
            //sender = senderN;
            recipient = mecanicoId;
            senderName = userName;
            rolSender = 'conductor';
        } else if (userId === mecanicoId) {
            // El usuario actual es el mecánico
            //sender = senderN;
            recipient = conductorId;
            senderName = userName;
            rolSender = 'mecanico';
        }

         // Agregar la sala al objeto chat
        const room = 'contratacion_' + contratacionId;
        sala = room;

        // Enviar el mensaje al servidor
        socket.emit('chat', { 
            sender: userName, 
            recipient, 
            message, 
            sala, 
            rolSender, 
            timestamp, 
            read 
        });

        // Limpiar el campo de entrada de mensajes
        messageInput.value = '';
    }
  });
</script>
