document.addEventListener('DOMContentLoaded', function () {
    // Get elements
    var openCartButton = document.getElementById('openCart');
    var closeCartButton = document.getElementById('closeCart');
    var cartMenu = document.getElementById('cartMenu');

    // Open the cart menu
    openCartButton.addEventListener('click', function (e) {
        e.preventDefault();
        cartMenu.style.width = '250px';
    });

    // Close the cart menu
    closeCartButton.addEventListener('click', function (e) {
        e.preventDefault();
        cartMenu.style.width = '0';
    });

    // Close the cart menu if the user clicks anywhere outside of it
    window.addEventListener('click', function (e) {
        if (e.target === cartMenu) {
            cartMenu.style.width = '0';
        }
    });
});
            const menu = document.querySelector(".cart-menu")
            const dropDown = document.querySelector(".drop-down")

            dropDown.addEventListener("mouseenter", () => {
                menu.classList.remove("hidden")
            })

            menu.addEventListener("mouseleave", () => {
                menu.classList.add("hidden")
            })

            document.addEventListener('DOMContentLoaded', function () {
                // Get elements
                var openCartButton = document.getElementById('openCart');
                var closeCartButton = document.getElementById('closeCart');
                var cartMenu = document.getElementById('cartMenu');

                // Open the cart menu
                openCartButton.addEventListener('click', function (e) {
                    e.preventDefault();
                    cartMenu.style.width = '250px';
                });

                // Close the cart menu
                closeCartButton.addEventListener('click', function (e) {
                    e.preventDefault();
                    cartMenu.style.width = '0';
                });

                // Close the cart menu if the user clicks anywhere outside of it
                window.addEventListener('click', function (e) {
                    if (e.target === cartMenu) {
                        cartMenu.style.width = '0';
                    }
                });
            });
            
             // Function to load and update cart content
                function loadCartContent() {
                    var cartContentContainer = document.querySelector('#cartContentContainer');

                    // Make an AJAX request to fetch cart items
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Update the cart content container with the fetched data
                            cartContentContainer.innerHTML = xhr.responseText;
                        }
                    };

                    xhr.open('GET', 'load_cart_content.php', true); // Replace 'load_cart_content.php' with your PHP script to load cart content
                    xhr.send();
                }
                
                // Attach the function to the Close Cart button
                document.getElementById('closeCart').addEventListener('click', function () {
                    closeMenu(); // Close the sliding menu
                });

                // Call the function to load cart content when the page loads
                window.addEventListener('load', loadCartContent);


                var remove = document.getElementsByClassName("remove");
                for(var i = 0; i<remove.length; i++){
                    remove[i].addEventListener("click",function(event){
                        var target = event.target;
                        var cart_id = target.getAttribute("data-id");
                        var xml = new XMLHttpRequest();
                        xml.onreadystatechange = function(){
                            if(this.readyState == 4 && this.status == 200){
                            target.innerHTML = this.responseText;
                            target.style.opacity = .3;
                            }
                        }

                        xml.open("GET","connection.php?cart_id="+cart_id,true);
                        xml.send();
                    })
                }
                
