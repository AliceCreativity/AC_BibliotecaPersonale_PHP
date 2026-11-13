<?php

    require('header.php');

?>
        
    <main class="mb-4">

        <header>
        
            <h1 class="text-center mt-5 mb-4"> 
            	Chatbot
            </h1>
        
        </header>

        <div class="container d-flex flex-column">

            <div class="col-lg-12 my-3 mx-auto text-justify">

                <p>
                    Scrivi in chat di cosa hai bisogno.
               </p>

            </div>

            <div class="col-lg-12 border border-dark rounded-3 overflow-hidden mx-auto p-0">

                <!-- Main Chat Shell -->
                <div class="chat-main-card w-100 overflow-hidden d-flex flex-column" data-purpose="chat-widget">

                    <!-- BEGIN: ChatHeader -->
                    <header class="bg-dark text-white px-4 py-3 d-flex align-items-center justify-content-between flex-shrink-0" data-purpose="chat-header">
                        <div class="d-flex align-items-center gap-3">
                            <!-- Librarian avatar in circle container -->
                            <div class="rounded-circle border border-white border-opacity-75 d-flex align-items-center justify-content-center p-1 flex-shrink-0" style="width: 44px; height: 44px;">
                                <img alt="Avatar Bibliotecaria" class="w-100 h-100 object-fit-contain" src="img/chatbot_white.png"/>
                            </div>
                            <!-- Chatbot Title Text -->
                            <div>
                                <h1 class="h6 mb-0 fw-semibold text-white">
                                    Chiedi alla Bibliotecaria
                                </h1>
                            </div>
                        </div>
                    </header>
                    <!-- END: ChatHeader -->

                    <!-- BEGIN: ConversationHistory -->
                    <section class="chat-scroll flex-grow-1 bg-white p-4 overflow-y-auto d-flex flex-column justify-content-end gap-3" data-purpose="chat-messages">
                    </section>
                    <!-- END: ConversationHistory -->

                    <!-- BEGIN: ChatInputForm -->
                    <footer class="p-3 p-sm-4 bg-white border-top border-light-subtle flex-shrink-0" data-purpose="chat-input-bar">
                        <form class="d-flex align-items-center gap-2 bg-light border border-light-subtle rounded-pill px-3 py-2" data-purpose="send-message-form" data-api-url="http://127.0.0.1:3000/api/chat">
                            <input class="form-control border-0 bg-transparent shadow-none p-0 text-secondary" placeholder="Scrivi la tua domanda..." type="text" aria-label="Scrivi un messaggio" maxlength="2000" required/>
                            <!-- Send Arrow Icon Button -->
                            <button aria-label="Send" class="btn btn-link text-dark p-0 border-0 flex-shrink-0" type="submit">
                                <svg fill="currentColor" style="width: 20px; height: 20px; transform: rotate(45deg); margin-top: -2px;" viewBox="0 0 24 24">
                                    <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                                </svg>
                            </button>
                        </form>
                    </footer>
                    <!-- END: ChatInputForm -->

                </div> <!-- chiude chat-main-card -->

            </div> <!-- chiude col-lg-12 -->

        </div> <!-- chiude container -->

    </main>

    <script src="chatbot.js"></script>

<?php

    require('footer.php');

?>