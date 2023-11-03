<?php
require_once 'connection.php';
session_start();

echo "seen";

$receiver = $_SESSION['receiver'];
$product_id = 0;
?>

    <div class="container mt-5">
        <div id="chat-box" class="mt-1 border p-3 rounded" style="max-height: 400px; margin-top: 0px; overflow-y: scroll;">
            <!-- Messages will be displayed here -->
        </div>
        <form id="message-form" action="send-message.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="hidden" name="receiver" value="<?php echo $receiver; ?>">
            <div class="form-group">
                <input type="text" class="form-control" id="message" name="message" placeholder="Type your message">
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
    </div>

