$(document).ready(function() {
    // Function to refresh the chat messages
    function refreshChat() {
        console.log("Refresh Chat called");
        // Perform an AJAX request to retrieve messages from the database
        $.ajax({
            url: "get_messages.php",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data);
                // Clear the chat box
                $("#chat-box").empty();

                // Iterate through the messages and append them to the chat box
                data.forEach(function(message) {
                    var messageDiv = $("<div></div>");
                    messageDiv.addClass(message.sender === "sender" ? "bg-primary" : "bg-light");
                    messageDiv.text(message.message);
                    $("#chat-box").append(messageDiv);
                });
            },
            error: function(xhr, status, error) {
                console.error("Error fetching messages:", error);
            }
        });
    }

    // Initial chat refresh
    refreshChat();

    // Function to send a message
    function sendMessage() {
        // Retrieve message content from the input field
        var message = $("#message").val();

        // Perform an AJAX request to store the message in the database
        $.ajax({
            url: "send_message.php",
            type: "POST",
            data: { sender: "sender", message: message }, // Modify sender as needed
            success: function() {
                console.log(message);
                $("#message").val(""); // Clear the input field
                refreshChat(); // Refresh chat to show the new message
            },
            error: function(xhr, status, error) {
                console.error("Error sending message:", error);
            }
        });
    }

    // Send a message when the "Send" button is clicked
    $("#send").click(function() {
        sendMessage();
    });

    // Auto-refresh the chat every 3 seconds
    setInterval(function() {
        refreshChat();
    }, 3000);
});



