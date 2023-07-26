<?php
    include_once "apiCall.php";
    include_once "missatge.php";
    //include_once  "generateNewMessages.php";

    $llista_missatges = array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Random Fact Generator</title>
    <link rel="stylesheet" href="myStyle.css">
    <link rel="stylesheet" href="template/assets/libs/aos/aos.css" />

</head>

<body class="gradient-box">

    <div class=" ">

        <div class="row justify-content-center">
            <div class="col-lg-4 mt-5">
                <div style="width: 100%">
                    <div class="mt-5 mb-5">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="mx-n3">
                                    <div data-simplebar style="height: 500px;overflow-x: hidden" class="px-3">
                                        <div class="row mt-3 justify-content-center">
                                            <div class="col-md-0">
                                                <div class="container-chat">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center mb-3">
                            <div class="col-lg-8 col-lg-4">
                                <button class="btn btn-green" onclick="newMessages()" type="submit" style="width: 100%">Fact !</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        let messageArray = [];

        function newMessages() {
            $.ajax({
                url: "generateNewMessages.php",
                type: "post",
                dataType: "JSON",
                success: function(data) {
                    // Add the new messages to the messageArray
                    messageArray.push(JSON.parse(data.bot));
                    messageArray.push(JSON.parse(data.me));

                    // Show all the messages in the chat container
                    displayMessages();
                },
                error: function(xhr, textStatus, error) {
                    console.log("Error:", textStatus);
                }
            });
        }

        async function displayMessages() {
            const container = $(".container-chat");

            for (let i = 0; i < 2; i++) {
                const message = messageArray.pop();
                let senderClass = message['who'];
                const text = message['text'];

                if(senderClass === "receiver"){
                    await new Promise((resolve) => setTimeout(resolve, 1000));
                    const chargin = `<div class="row ${senderClass}row"><div class="chat-message ${senderClass}"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>`;
                    container.append(chargin);
                    const messages = container.children();
                    const lastMessage = messages[messages.length - 1];
                    lastMessage.scrollIntoView({ behavior: "smooth" });
                    await new Promise((resolve) => setTimeout(resolve, 2000));
                    container.children().last().remove();
                }
                const messageHTML = `<div class="row ${senderClass}row">
                      <div class="chat-message ${senderClass}">${text}</div>
                    </div>`;
                container.append(messageHTML);

                const messages = container.children();
                const lastMessage = messages[messages.length - 1];
                lastMessage.scrollIntoView({ behavior: "smooth" });
            }
        }


    </script>
    <script src="template/assets/js/pages/animation-aos.init.js"></script>
</body>
</html>
