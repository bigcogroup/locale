$(document).ready(function() {
     // Add a click event listener to the toggle button
        $("#toggleUsers").click(function() {
            // Toggle the display of the user list
            $("#userListContainer").toggle();
        });
        
        // Add click event listeners to user items (for minimizing)
        $(".user").click(function() {
            var clickedUserItem = $(this);
            $(".toggle-div").slideToggle();
                // Function to refresh the chat messages
            function refreshChat() {
                console.log("Refresh Chat called");
                // Perform an AJAX request to retrieve messages from the database
                var receiverId = clickedUserItem.data("receiver");
                console.log(receiverId);
                $.ajax({
                    url: "get-messages.php?receiver=" + receiverId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Clear the chat box
                        $("#chat-box").empty();
                        console.log(data);
                        // Iterate through the messages and append them to the chat box
                        data.forEach(function(msg) {
                            var messageDiv = $("<div class='card w-25 h-25'></div>");
                            messageDiv.addClass(msg.sender === "sender" ? "bg-light mr-auto" : "bg-primary text-light ml-auto");
                            try {
                                var msg = JSON.parse(msg);
                                // Now you can access properties of the 'msg' object
                                console.log(msg.sender);
                                console.log(msg.product_id);
                            } catch (error) {
                                console.log('Error parsing JSON:', error);
                            }
                            // Check if the message includes product information
                            if (msg.product_id != 0) {
                                // Make an AJAX request to fetch product details based on the product_id
                                $.ajax({
                                    url: "get_product_details.php", // Replace with your server-side endpoint
                                    type: "GET",
                                    data: { product_id: msg.product_id },
                                    dataType: "json",
                                    success: function(productData) {
                                        console.log(productData);
                                        // Create a card to display the product details
                                       var productCard = $("<div class='card'></div>");
                                       productCard.css("background-image", "url('" + productData.product_image + "')");
                                       
                                        var cardBody = $("<div class='card-body p-2'></div>");

                                        var productName = $("<p class='card-title m-0'></p>");
                                        productName.text(productData.product_name);

                                        var productPrice = $("<p class='card-text m-0'></p>");
                                        productPrice.text("$" + productData.price);

                                        var addToCartButton = $(`<button class='btn btn-primary btn-sm mt-2 add' data-id="${productData.product_id}">Add to Cart</button>`);
                                        cardBody.append(productName, productPrice, addToCartButton);
                                        productCard.append(cardBody);
                                        messageDiv.append(productCard);

                                        $("#chat-box").append(messageDiv);
                                        

                                        var addButtons = document.getElementsByClassName("add");

                                        for (var i = 0; i < addButtons.length; i++) {
                                            addButtons[i].addEventListener("click", function (event) {
                                                var target = event.target;
                                                var id = target.getAttribute("data-id");
                                                var xml = new XMLHttpRequest();
                                                
                                                xml.onreadystatechange = function () {
                                                    if (this.readyState == 4 && this.status == 200) {
                                                        var data = JSON.parse(this.responseText);
                                                        target.innerHTML = data.in_cart;
                                                        document.getElementById("badge").innerHTML = data.num_cart + 1;
                                                    }
                                                };
                                                
                                                xml.open("GET", "connection.php?id=" + id, true);
                                                xml.send();
                                            });
                                        }


 
                                        

                                        
                                    },
                                    error: function(xhr, status, error) {
                                        console.error("Error fetching product details:", error);
                                    }
                                });
                            } else {
                                // Render regular text messages without products
                                messageDiv.text(msg.message);
                                $("#chat-box").append(messageDiv);
                                
                            }
                            
                      
                        });
                    console.log("this is the id");
                    console.log(receiverId);
                    var product_id = 0;
                        var formHtml = `
                        <style>
                        .sticky-form {
                            position: absolute;
                            bottom: 0;
                            width: 100%; /* To make it full width of #chat-box */
                            background-color: white; /* Set background color as needed */
                            /* Other styling properties as needed */
                        }
                        </style>
                        <form id="message-form" action="send-message.php" method="post" class="sticky-form">
                        <input type="hidden" name="product_id" value="${product_id}">
                        <input type="hidden" name="receiver" value="${receiverId}">
                        <div class="form-group">
                        <input type="text" class="form-control" id="message" name="message" placeholder="Type your message">
                        <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                        </form>
                                        `;

                        $("#chat-box").append(formHtml); 
                        console.log("appending");    
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching messages:", error);
                        console.log(xhr.responseText);
                    }

                    
                });
               

                

            }

            // Initial chat refresh
            refreshChat();

            $("#userListContainer ul li").on("click", function() {
                // Get the selected product ID
                
                var productID = $(this).data("productid");

                // Define the sender and receiver
                var sender = "sender";
                var receiver = "receiver";

                // Define the message as "product"
                var message = "product";

                // Send the product ID, sender, receiver, and message to the server using AJAX
                $.ajax({
                    url: "send_message.php", // Replace with your server-side endpoint
                    type: "POST",
                    data: { product_id: productID, sender: sender, receiver: receiver, message: message },
                    dataType: "json",
                    success: function(data) {
                        // Message sent successfully, you can update the chat or perform other actions here

                        // Refresh the chat (replace this with your actual refresh function)
                        refreshChat();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error sending message:", error);
                    }
                });
            });
            // Auto-refresh the chat every 3 seconds
            //setInterval(function() {
            //    refreshChat();
            //}, 3000);

            
            // Hide the user list when an item is clicked
           // $("#userListContainer").hide();
        });

});

       


